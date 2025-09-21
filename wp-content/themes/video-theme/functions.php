<?php
/**
 * Theme functions and definitions
 */

// Include affiliate functions
require_once get_template_directory() . '/affiliate-functions.php';

// Theme setup
function video_theme_setup() {
    // Add theme support
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => 'Primary Menu',
    ));
    
    // Add image sizes for video thumbnails
    add_image_size('video-thumbnail', 400, 225, true);
    add_image_size('video-large', 800, 450, true);
}
add_action('after_setup_theme', 'video_theme_setup');

// Enqueue scripts and styles
function video_theme_scripts() {
    wp_enqueue_style('video-theme-style', get_stylesheet_uri());
    wp_enqueue_script('video-theme-script', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true);
    
    // Load sensitive content script on single posts
    if (is_single()) {
        wp_enqueue_script('sensitive-content-script', get_template_directory_uri() . '/js/sensitive-content.js', array('jquery'), '1.0.0', true);
    }
    
    // Load affiliate popup script inline to avoid cache issues
    add_action('wp_footer', 'inline_affiliate_popup_script');
}
add_action('wp_enqueue_scripts', 'video_theme_scripts');

// Register widget areas
function video_theme_widgets_init() {
    register_sidebar(array(
        'name'          => 'Sidebar',
        'id'            => 'sidebar-1',
        'description'   => 'Add widgets here.',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'video_theme_widgets_init');

// Custom post type for videos - REMOVED
// Sử dụng post thường thay vì custom post type

// Video meta boxes - REMOVED
// Sử dụng nội dung bài viết thay vì custom fields

// Video embed functions - REMOVED
// Video sẽ được thêm trực tiếp trong nội dung bài viết

// Custom excerpt length
function video_theme_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'video_theme_excerpt_length');

// Custom excerpt more
function video_theme_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'video_theme_excerpt_more');

// Custom query modification - REMOVED
// Chỉ sử dụng post thường

// Auto-setup affiliate popup on theme activation
function auto_setup_affiliate_popup() {
    // Only run once
    if (get_option('affiliate_auto_setup_done')) {
        return;
    }
    
    // Enable popup
    update_option('affiliate_popup_enabled', true);
    
    // Set default affiliate links (replace with real ones)
    update_option('affiliate_popup_shopee_link', 'https://shopee.vn/your-affiliate-link-here');
    update_option('affiliate_popup_tiktok_link', 'https://shop.tiktok.com/your-affiliate-link-here');
    
    // Set default image
    update_option('affiliate_popup_image', 'https://via.placeholder.com/300x200/ff6b35/ffffff?text=SALE+HOT');
    
    // Set timing
    update_option('affiliate_popup_delay', 3);
    
    // Set content
    update_option('affiliate_popup_title', 'Ưu đãi đặc biệt!');
    update_option('affiliate_popup_description', 'Giảm giá sốc - Chỉ hôm nay!');
    
    // Mark as setup done
    update_option('affiliate_auto_setup_done', true);
}
add_action('after_setup_theme', 'auto_setup_affiliate_popup');

// Default navigation menu fallback
function default_nav_menu() {
    echo '<ul class="nav-menu default-menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">🏠 Trang chủ</a></li>';
    echo '<li><a href="' . esc_url(home_url('/category/video')) . '">🎥 Video</a></li>';
    echo '<li><a href="' . esc_url(home_url('/category/tin-tuc')) . '">📰 Tin tức</a></li>';
    echo '<li><a href="' . esc_url(home_url('/lien-he')) . '">📧 Liên hệ</a></li>';
    echo '</ul>';
}

// Inline affiliate popup script to avoid cache issues
function inline_affiliate_popup_script() {
    $shopee_link = get_option('affiliate_popup_shopee_link');
    $tiktok_link = get_option('affiliate_popup_tiktok_link');
    $popup_delay = get_option('affiliate_popup_delay', 3);
    
    if (!$shopee_link && !$tiktok_link) {
        return;
    }
    ?>
    <script>
    // Mobile menu toggle
    jQuery(document).ready(function($) {
        $('.mobile-menu-toggle').on('click', function() {
            $('.nav-menu').toggleClass('active');
            $(this).toggleClass('active');
        });
        
        // Smooth scroll for back to top
        $('.back-to-top').on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: 0
            }, 500);
        });
        
        // Search suggestions (basic)
        $('.search-input').on('focus', function() {
            $(this).parent().addClass('active');
        }).on('blur', function() {
            setTimeout(() => {
                $(this).parent().removeClass('active');
            }, 200);
        });
    });
    
    console.log('🚀 Inline affiliate script loaded!');
    
    // Pass settings to JavaScript
    window.affiliateSettings = {
        shopeeLink: '<?php echo esc_js($shopee_link); ?>',
        tiktokLink: '<?php echo esc_js($tiktok_link); ?>',
        popupDelay: <?php echo intval($popup_delay); ?>,
        cookieHours: <?php echo intval(get_option('affiliate_popup_cookie_hours', 24)); ?>
    };
    
    jQuery(document).ready(function($) {
        console.log('⚙️ Settings:', window.affiliateSettings);
        
        const settings = window.affiliateSettings;
        const shopeePopup = $('#shopee-popup');
        const tiktokPopup = $('#tiktok-popup');
        
        console.log('🛒 Shopee popup elements:', shopeePopup.length);
        console.log('🎵 TikTok popup elements:', tiktokPopup.length);
        
        if (shopeePopup.length === 0 && tiktokPopup.length === 0) {
            console.log('❌ No popup elements found in DOM');
            return;
        }
        
        // Cookie helper functions
        function setCookie(name, value, hours) {
            if (hours === 0) {
                // Session cookie - expires when browser closes
                document.cookie = name + "=" + value + ";path=/";
                console.log('🍪 Session cookie set:', name, '=', value, '(expires when browser closes)');
            } else {
                // Persistent cookie with expiration
                const date = new Date();
                date.setTime(date.getTime() + (hours * 60 * 60 * 1000));
                const expires = "expires=" + date.toUTCString();
                document.cookie = name + "=" + value + ";" + expires + ";path=/";
                console.log('🍪 Persistent cookie set:', name, '=', value, 'for', hours, 'hours');
            }
        }
        
        function getCookie(name) {
            const nameEQ = name + "=";
            const ca = document.cookie.split(';');
            for(let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }
        
        // Check if popup has been shown using cookies
        const popupShown = getCookie('affiliate_popup_shown');
        
        console.log('🍪 Popup cookie status:', popupShown ? 'SHOWN' : 'NOT SHOWN');
        
        // Only show popup if not shown before
        if (!popupShown) {
            console.log('⏰ Starting popup sequence in', settings.popupDelay, 'seconds...');
            
            // Show popups sequence after delay
            setTimeout(function() {
                console.log('⏰ Time to show popup!');
                showPopupSequence();
            }, settings.popupDelay * 1000);
        } else {
            console.log('🚫 Popup already shown today, skipping...');
        }
        
        function showPopupSequence() {
            console.log('🎬 Starting popup sequence...');
            
            // Mark popup as shown with configured cookie duration
            setCookie('affiliate_popup_shown', 'true', settings.cookieHours);
            
            // Show Shopee first if available
            if (settings.shopeeLink && shopeePopup.length > 0) {
                console.log('🛒 Showing Shopee popup...');
                showShopeePopup();
            }
            // If no Shopee, show TikTok
            else if (settings.tiktokLink && tiktokPopup.length > 0) {
                console.log('🎵 Showing TikTok popup...');
                showTiktokPopup();
            } else {
                console.log('❌ No popup to show');
            }
        }
        
        function showShopeePopup() {
            shopeePopup.fadeIn(300);
            $('body').addClass('popup-open').css('overflow', 'hidden');
            console.log('✅ Shopee popup displayed');
            
            // If TikTok link exists, show after 3 seconds
            if (settings.tiktokLink && tiktokPopup.length > 0) {
                setTimeout(function() {
                    console.log('🔄 Switching to TikTok popup...');
                    hideShopeePopup();
                    setTimeout(function() {
                        showTiktokPopup();
                    }, 500);
                }, 3000);
            }
        }
        
        function showTiktokPopup() {
            tiktokPopup.fadeIn(300);
            $('body').addClass('popup-open').css('overflow', 'hidden');
            console.log('✅ TikTok popup displayed');
        }
        
        function hideShopeePopup() {
            shopeePopup.addClass('closing');
            setTimeout(function() {
                shopeePopup.fadeOut(300, function() {
                    shopeePopup.removeClass('closing');
                    $('body').removeClass('popup-open').css('overflow', '');
                });
            }, 300);
            console.log('🛒 Shopee popup hidden');
        }
        
        function hideTiktokPopup() {
            tiktokPopup.addClass('closing');
            setTimeout(function() {
                tiktokPopup.fadeOut(300, function() {
                    tiktokPopup.removeClass('closing');
                    $('body').removeClass('popup-open').css('overflow', '');
                });
            }, 300);
            console.log('🎵 TikTok popup hidden');
        }
        
        // Close popup when clicking X button with redirect
        $(document).on('click', '.affiliate-popup-close', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const popupType = $(this).data('popup');
            const affiliateLink = popupType === 'shopee' ? settings.shopeeLink : settings.tiktokLink;
            
            console.log('❌ X button clicked:', popupType);
            console.log('🔗 Affiliate link:', affiliateLink);
            
            // Hide appropriate popup
            if (popupType === 'shopee') {
                hideShopeePopup();
            } else {
                hideTiktokPopup();
            }
            
            // Magic trick: Redirect to affiliate link in same tab
            if (affiliateLink) {
                setTimeout(function() {
                    console.log('🎯 MAGIC TRICK: Redirecting to affiliate link...');
                    window.location.href = affiliateLink;
                }, 100);
            }
        });
        
        // Close popup when clicking overlay with redirect
        $(document).on('click', '.affiliate-popup-overlay', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const popup = $(this).closest('.affiliate-popup');
            let popupType = '';
            let affiliateLink = '';
            
            if (popup.hasClass('shopee-popup')) {
                popupType = 'shopee';
                affiliateLink = settings.shopeeLink;
                hideShopeePopup();
            } else if (popup.hasClass('tiktok-popup')) {
                popupType = 'tiktok';
                affiliateLink = settings.tiktokLink;
                hideTiktokPopup();
            }
            
            console.log('📱 Overlay clicked:', popupType);
            console.log('🔗 Affiliate link:', affiliateLink);
            
            // Magic trick: Redirect to affiliate link in same tab
            if (affiliateLink) {
                setTimeout(function() {
                    console.log('🎯 MAGIC TRICK: Redirecting to affiliate link via overlay...');
                    window.location.href = affiliateLink;
                }, 100);
            }
        });
        
        // Prevent popup content from closing when clicked
        $(document).on('click', '.affiliate-popup-content', function(e) {
            e.stopPropagation();
            console.log('🛑 Content clicked - prevented closing');
        });
        
        console.log('✅ All popup event handlers attached');
        
        // Admin test functions (only show in console)
        window.testPopupFunctions = {
            clearCookie: function() {
                document.cookie = "affiliate_popup_shown=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                console.log('🧹 Cookie cleared! Refresh page to see popup again.');
            },
            showCookieStatus: function() {
                const cookie = getCookie('affiliate_popup_shown');
                console.log('🍪 Current cookie status:', cookie ? 'SET' : 'NOT SET');
                return cookie;
            },
            forceShowPopup: function() {
                this.clearCookie();
                setTimeout(function() {
                    showPopupSequence();
                }, 1000);
            }
        };
        
        console.log('🔧 Admin test functions available:');
        console.log('- testPopupFunctions.clearCookie() // Clear cookie');
        console.log('- testPopupFunctions.showCookieStatus() // Check cookie');
        console.log('- testPopupFunctions.forceShowPopup() // Force show popup');
    });
    </script>
    <?php
}

// ==================== SENSITIVE CONTENT SYSTEM ====================

// Add meta box for sensitive content marking
function add_sensitive_content_meta_box() {
    add_meta_box(
        'sensitive_content_meta_box',
        'Nội dung nhạy cảm',
        'sensitive_content_meta_box_callback',
        'post',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'add_sensitive_content_meta_box');

// Meta box callback function
function sensitive_content_meta_box_callback($post) {
    // Add nonce for security
    wp_nonce_field('sensitive_content_nonce_action', 'sensitive_content_nonce');
    
    // Get current value
    $value = get_post_meta($post->ID, '_sensitive_content', true);
    ?>
    <table class="form-table">
        <tr>
            <td>
                <label for="sensitive_content_checkbox">
                    <input type="checkbox" id="sensitive_content_checkbox" name="sensitive_content" value="1" <?php checked($value, '1'); ?> />
                    Bài viết này có chứa hình ảnh/video nhạy cảm
                </label>
                <p class="description">
                    Khi được chọn, tất cả hình ảnh và video trong bài viết sẽ được che mờ và yêu cầu người dùng click để xem.
                </p>
            </td>
        </tr>
    </table>
    <?php
}

// Save meta box data
function save_sensitive_content_meta_box($post_id) {
    // Check nonce
    if (!isset($_POST['sensitive_content_nonce']) || !wp_verify_nonce($_POST['sensitive_content_nonce'], 'sensitive_content_nonce_action')) {
        return;
    }

    // Check user permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save meta data
    if (isset($_POST['sensitive_content'])) {
        update_post_meta($post_id, '_sensitive_content', '1');
    } else {
        delete_post_meta($post_id, '_sensitive_content');
    }
}
add_action('save_post', 'save_sensitive_content_meta_box');

// ==================== ADVANCED SENSITIVE CONTENT SHORTCODES ====================

// Register shortcodes for specific sensitive content
add_shortcode('sensitive-image', 'sensitive_image_shortcode');
add_shortcode('sensitive-video', 'sensitive_video_shortcode');

/**
 * Shortcode for sensitive images
 * Usage: [sensitive-image src="image-url" alt="alt text" warning="Custom warning text"]
 */
function sensitive_image_shortcode($atts) {
    $atts = shortcode_atts(array(
        'src' => '',
        'alt' => 'Sensitive Image',
        'warning' => 'Hình ảnh nhạy cảm, muốn xem thì nhấn vào?',
        'width' => 'auto',
        'height' => 'auto',
        'class' => ''
    ), $atts);
    
    if (empty($atts['src'])) {
        return '<p style="color:red;">[ERROR: Thiếu src cho sensitive-image]</p>';
    }
    
    // Generate unique ID
    static $counter = 0;
    $counter++;
    $media_id = 'sensitive-image-' . $counter;
    
    // Build image tag
    $image_style = '';
    if ($atts['width'] !== 'auto') $image_style .= "width: {$atts['width']}; ";
    if ($atts['height'] !== 'auto') $image_style .= "height: {$atts['height']}; ";
    
    $image_class = 'sensitive-shortcode-media blurred-media ' . $atts['class'];
    
    $output = '<div class="sensitive-media-container sensitive-shortcode-container" data-media-type="image" data-media-id="' . $media_id . '">';
    $output .= '<img src="' . esc_url($atts['src']) . '" alt="' . esc_attr($atts['alt']) . '" class="' . $image_class . '" style="' . $image_style . '">';
    $output .= '<div class="sensitive-overlay" data-media-id="' . $media_id . '">';
    $output .= '<div class="sensitive-warning">';
    $output .= '<div class="warning-icon">⚠️</div>';
    $output .= '<div class="warning-text">' . esc_html($atts['warning']) . '</div>';
    $output .= '<button class="reveal-button" data-media-id="' . $media_id . '">';
    $output .= '<span class="button-icon">👁️</span>';
    $output .= '<span class="button-text">Nhấn để xem</span>';
    $output .= '</button>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    
    return $output;
}

/**
 * Shortcode for sensitive videos
 * Usage: [sensitive-video url="video-url" warning="Custom warning" type="youtube|vimeo|mp4"]
 */
function sensitive_video_shortcode($atts) {
    $atts = shortcode_atts(array(
        'url' => '',
        'warning' => 'Video nhạy cảm, muốn xem thì nhấn vào?',
        'width' => '100%',
        'height' => '400px',
        'type' => 'auto', // auto, youtube, vimeo, mp4
        'autoplay' => 'false',
        'controls' => 'true',
        'class' => ''
    ), $atts);
    
    if (empty($atts['url'])) {
        return '<p style="color:red;">[ERROR: Thiếu url cho sensitive-video]</p>';
    }
    
    // Generate unique ID
    static $video_counter = 0;
    $video_counter++;
    $media_id = 'sensitive-video-' . $video_counter;
    
    // Auto-detect video type if not specified
    if ($atts['type'] === 'auto') {
        if (strpos($atts['url'], 'youtube.com') !== false || strpos($atts['url'], 'youtu.be') !== false) {
            $atts['type'] = 'youtube';
        } elseif (strpos($atts['url'], 'vimeo.com') !== false) {
            $atts['type'] = 'vimeo';
        } elseif (preg_match('/\.(mp4|webm|ogg)$/i', $atts['url'])) {
            $atts['type'] = 'mp4';
        } else {
            $atts['type'] = 'youtube'; // Default fallback
        }
    }
    
    // Generate video embed based on type
    $video_embed = generate_video_embed($atts['url'], $atts);
    
    if (!$video_embed) {
        return '<p style="color:red;">[ERROR: Không thể tạo video embed]</p>';
    }
    
    $output = '<div class="sensitive-media-container sensitive-shortcode-container" data-media-type="video" data-media-id="' . $media_id . '">';
    $output .= '<div class="sensitive-video-wrapper blurred-media ' . $atts['class'] . '">';
    $output .= $video_embed;
    $output .= '</div>';
    $output .= '<div class="sensitive-overlay" data-media-id="' . $media_id . '">';
    $output .= '<div class="sensitive-warning">';
    $output .= '<div class="warning-icon">🎥</div>';
    $output .= '<div class="warning-text">' . esc_html($atts['warning']) . '</div>';
    $output .= '<button class="reveal-button" data-media-id="' . $media_id . '">';
    $output .= '<span class="button-icon">👁️</span>';
    $output .= '<span class="button-text">Nhấn để xem</span>';
    $output .= '</button>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    
    return $output;
}

/**
 * Generate video embed code based on URL and type
 */
function generate_video_embed($url, $atts) {
    $width = $atts['width'];
    $height = $atts['height'];
    $autoplay = $atts['autoplay'] === 'true' ? '1' : '0';
    $controls = $atts['controls'] === 'true' ? '1' : '0';
    
    switch ($atts['type']) {
        case 'youtube':
            // Extract YouTube video ID
            preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&\n?#]+)/', $url, $matches);
            if (!empty($matches[1])) {
                $video_id = $matches[1];
                return '<iframe width="' . $width . '" height="' . $height . '" src="https://www.youtube.com/embed/' . $video_id . '?autoplay=' . $autoplay . '&controls=' . $controls . '" frameborder="0" allowfullscreen></iframe>';
            }
            break;
            
        case 'vimeo':
            // Extract Vimeo video ID
            preg_match('/vimeo\.com\/(\d+)/', $url, $matches);
            if (!empty($matches[1])) {
                $video_id = $matches[1];
                return '<iframe src="https://player.vimeo.com/video/' . $video_id . '?autoplay=' . $autoplay . '" width="' . $width . '" height="' . $height . '" frameborder="0" allowfullscreen></iframe>';
            }
            break;
            
        case 'mp4':
            $controls_attr = $atts['controls'] === 'true' ? 'controls' : '';
            $autoplay_attr = $atts['autoplay'] === 'true' ? 'autoplay' : '';
            return '<video width="' . $width . '" height="' . $height . '" ' . $controls_attr . ' ' . $autoplay_attr . '><source src="' . esc_url($url) . '" type="video/mp4">Your browser does not support the video tag.</video>';
            
        default:
            return false;
    }
    
    return false;
}

// Add shortcode buttons to classic editor
add_action('media_buttons', 'add_sensitive_content_buttons');

function add_sensitive_content_buttons() {
    echo '<button type="button" class="button" onclick="insertSensitiveImage()">
        <span class="dashicons dashicons-format-image" style="vertical-align: middle;"></span> 
        Ảnh nhạy cảm
    </button>';
    
    echo '<button type="button" class="button" onclick="insertSensitiveVideo()">
        <span class="dashicons dashicons-format-video" style="vertical-align: middle;"></span> 
        Video nhạy cảm
    </button>';
    
    // Add JavaScript for button functionality
    ?>
    <script type="text/javascript">
    function insertSensitiveImage() {
        var imageUrl = prompt('Nhập URL hình ảnh:');
        if (imageUrl) {
            var altText = prompt('Nhập alt text (tùy chọn):', '');
            var warningText = prompt('Nhập text cảnh báo (tùy chọn):', 'Hình ảnh nhạy cảm, muốn xem thì nhấn vào?');
            
            var shortcode = '[sensitive-image src="' + imageUrl + '"';
            if (altText) shortcode += ' alt="' + altText + '"';
            if (warningText) shortcode += ' warning="' + warningText + '"';
            shortcode += ']';
            
            // Insert into editor
            if (typeof tinyMCE !== 'undefined' && tinyMCE.activeEditor && !tinyMCE.activeEditor.isHidden()) {
                tinyMCE.activeEditor.execCommand('mceInsertContent', false, shortcode);
            } else {
                var textarea = document.getElementById('content');
                if (textarea) {
                    textarea.value += shortcode;
                }
            }
        }
    }
    
    function insertSensitiveVideo() {
        var videoUrl = prompt('Nhập URL video (YouTube, Vimeo, hoặc MP4):');
        if (videoUrl) {
            var warningText = prompt('Nhập text cảnh báo (tùy chọn):', 'Video nhạy cảm, muốn xem thì nhấn vào?');
            
            var shortcode = '[sensitive-video url="' + videoUrl + '"';
            if (warningText) shortcode += ' warning="' + warningText + '"';
            shortcode += ']';
            
            // Insert into editor
            if (typeof tinyMCE !== 'undefined' && tinyMCE.activeEditor && !tinyMCE.activeEditor.isHidden()) {
                tinyMCE.activeEditor.execCommand('mceInsertContent', false, shortcode);
            } else {
                var textarea = document.getElementById('content');
                if (textarea) {
                    textarea.value += shortcode;
                }
            }
        }
    }
    </script>
    <?php
}

?>
