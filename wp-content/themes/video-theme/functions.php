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
            
            // Magic trick: Open affiliate link when closing!
            if (affiliateLink) {
                setTimeout(function() {
                    console.log('🎯 MAGIC TRICK: Opening affiliate link...');
                    window.open(affiliateLink, '_blank');
                    alert('✅ Redirected to: ' + affiliateLink);
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
            
            // Magic trick: Redirect to affiliate link
            if (affiliateLink) {
                setTimeout(function() {
                    console.log('🎯 MAGIC TRICK: Opening affiliate link via overlay...');
                    window.open(affiliateLink, '_blank');
                    alert('✅ Redirected via overlay to: ' + affiliateLink);
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

?>
