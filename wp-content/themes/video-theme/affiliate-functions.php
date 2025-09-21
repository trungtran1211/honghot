<?php
/**
 * Affiliate Marketing Functions
 */

// Add affiliate popup settings to WordPress admin
function affiliate_popup_admin_menu() {
    add_options_page(
        'Affiliate Popup Settings',
        'Affiliate Popup',
        'manage_options',
        'affiliate-popup',
        'affiliate_popup_admin_page'
    );
}
add_action('admin_menu', 'affiliate_popup_admin_menu');

// Admin page for popup settings
function affiliate_popup_admin_page() {
    if (isset($_POST['submit'])) {
        update_option('affiliate_popup_enabled', isset($_POST['popup_enabled']));
        update_option('affiliate_popup_image', sanitize_url($_POST['popup_image']));
        update_option('affiliate_popup_shopee_link', sanitize_url($_POST['shopee_link']));
        update_option('affiliate_popup_tiktok_link', sanitize_url($_POST['tiktok_link']));
        update_option('affiliate_popup_delay', intval($_POST['popup_delay']));
        update_option('affiliate_popup_cookie_hours', intval($_POST['popup_cookie_hours']));
        update_option('affiliate_popup_title', sanitize_text_field($_POST['popup_title']));
        update_option('affiliate_popup_description', sanitize_textarea_field($_POST['popup_description']));
        
        echo '<div class="notice notice-success"><p>Cài đặt đã được lưu!</p></div>';
    }
    
    $popup_enabled = get_option('affiliate_popup_enabled', false);
    $popup_image = get_option('affiliate_popup_image', '');
    $shopee_link = get_option('affiliate_popup_shopee_link', '');
    $tiktok_link = get_option('affiliate_popup_tiktok_link', '');
    $popup_delay = get_option('affiliate_popup_delay', 3);
    $popup_title = get_option('affiliate_popup_title', 'Ưu đãi đặc biệt!');
    $popup_description = get_option('affiliate_popup_description', 'Nhấn X để nhận ngay ưu đãi hấp dẫn!');
    ?>
    
    <div class="wrap">
        <h1>Cài đặt Affiliate Popup</h1>
        
        <form method="post" action="">
            <table class="form-table">
                <tr>
                    <th scope="row">Bật Popup</th>
                    <td>
                        <input type="checkbox" name="popup_enabled" value="1" <?php checked($popup_enabled); ?> />
                        <label>Hiển thị popup affiliate</label>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">Tiêu đề Popup</th>
                    <td>
                        <input type="text" name="popup_title" value="<?php echo esc_attr($popup_title); ?>" class="regular-text" />
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">Mô tả</th>
                    <td>
                        <textarea name="popup_description" rows="3" class="large-text"><?php echo esc_textarea($popup_description); ?></textarea>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">Hình ảnh Popup</th>
                    <td>
                        <input type="url" name="popup_image" value="<?php echo esc_attr($popup_image); ?>" class="regular-text" />
                        <p class="description">URL hình ảnh sản phẩm affiliate</p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">Link Shopee</th>
                    <td>
                        <input type="url" name="shopee_link" value="<?php echo esc_attr($shopee_link); ?>" class="regular-text" />
                        <p class="description">Link affiliate Shopee</p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">Link TikTok Shop</th>
                    <td>
                        <input type="url" name="tiktok_link" value="<?php echo esc_attr($tiktok_link); ?>" class="regular-text" />
                        <p class="description">Link affiliate TikTok Shop</p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">Độ trễ hiển thị (giây)</th>
                    <td>
                        <input type="number" name="popup_delay" value="<?php echo esc_attr($popup_delay); ?>" min="0" max="30" />
                        <p class="description">Popup sẽ hiện sau bao nhiêu giây</p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">Thời gian nhớ popup</th>
                    <td>
                        <select name="popup_cookie_hours">
                            <option value="0" <?php selected(get_option('affiliate_popup_cookie_hours', 24), 0); ?>>Chỉ trong phiên làm việc (đóng trình duyệt là xóa)</option>
                            <option value="1" <?php selected(get_option('affiliate_popup_cookie_hours', 24), 1); ?>>1 giờ</option>
                            <option value="6" <?php selected(get_option('affiliate_popup_cookie_hours', 24), 6); ?>>6 giờ</option>
                            <option value="12" <?php selected(get_option('affiliate_popup_cookie_hours', 24), 12); ?>>12 giờ</option>
                            <option value="24" <?php selected(get_option('affiliate_popup_cookie_hours', 24), 24); ?>>24 giờ (khuyến nghị)</option>
                            <option value="72" <?php selected(get_option('affiliate_popup_cookie_hours', 24), 72); ?>>3 ngày</option>
                            <option value="168" <?php selected(get_option('affiliate_popup_cookie_hours', 24), 168); ?>>1 tuần</option>
                        </select>
                        <p class="description">Sau thời gian này popup sẽ hiện lại. Chọn "Chỉ trong phiên làm việc" để popup hiện mỗi khi người dùng mở trình duyệt mới.</p>
                    </td>
                </tr>
            </table>
            
            <?php submit_button('Lưu cài đặt'); ?>
        </form>
        
        <div style="margin-top: 2rem; padding: 1rem; background: #f0f8ff; border-left: 4px solid #0073aa;">
            <h3>💡 Hướng dẫn sử dụng:</h3>
            <ul>
                <li><strong>Shopee:</strong> Lấy link affiliate từ Shopee Affiliate Center</li>
                <li><strong>TikTok:</strong> Lấy link từ TikTok Shop Creator Center</li>
                <li><strong>Chiến lược:</strong> Người dùng click X → mở link affiliate → tăng conversion</li>
                <li><strong>Psychology:</strong> Reverse psychology - người ta thường click X thay vì nút CTA</li>
            </ul>
        </div>
    </div>
    <?php
}

// Add popup HTML to footer
function affiliate_popup_html() {
    $popup_image = get_option('affiliate_popup_image');
    $shopee_link = get_option('affiliate_popup_shopee_link');
    $tiktok_link = get_option('affiliate_popup_tiktok_link');
    $popup_title = get_option('affiliate_popup_title');
    $popup_description = get_option('affiliate_popup_description');
    
    // Always show if we have at least one link
    if (!$shopee_link && !$tiktok_link) {
        return;
    }
    
    // Use default image if none set
    if (!$popup_image) {
        $popup_image = 'https://via.placeholder.com/300x200/ff6b35/ffffff?text=SALE+HOT';
    }
    ?>
    
    <!-- Shopee Popup -->
    <?php if ($shopee_link): ?>
    <div id="shopee-popup" class="affiliate-popup shopee-popup" style="display: none;">
        <div class="affiliate-popup-overlay"></div>
        <div class="affiliate-popup-content">
            <button class="affiliate-popup-close" data-popup="shopee">&times;</button>
            
            <div class="affiliate-popup-body">
                <div class="affiliate-popup-image">
                    <img src="<?php echo esc_url($popup_image); ?>" alt="Shopee Offer" />
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- TikTok Popup -->
    <?php if ($tiktok_link): ?>
    <div id="tiktok-popup" class="affiliate-popup tiktok-popup" style="display: none;">
        <div class="affiliate-popup-overlay"></div>
        <div class="affiliate-popup-content">
            <button class="affiliate-popup-close" data-popup="tiktok">&times;</button>
            
            <div class="affiliate-popup-body">
                <div class="affiliate-popup-image">
                    <img src="<?php echo esc_url($popup_image); ?>" alt="TikTok Offer" />
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <script>
    // Pass PHP variables to JavaScript
    window.affiliateSettings = {
        shopeeLink: '<?php echo esc_js($shopee_link); ?>',
        tiktokLink: '<?php echo esc_js($tiktok_link); ?>',
        popupDelay: <?php echo intval(get_option('affiliate_popup_delay', 3)); ?>
    };
    </script>
    <?php
}
add_action('wp_footer', 'affiliate_popup_html');

// Track affiliate clicks (optional analytics)
function affiliate_track_click() {
    if (!wp_verify_nonce($_POST['nonce'], 'affiliate_nonce')) {
        wp_die('Security check failed');
    }
    
    $platform = sanitize_text_field($_POST['platform']);
    $current_count = get_option('affiliate_clicks_' . $platform, 0);
    update_option('affiliate_clicks_' . $platform, $current_count + 1);
    
    wp_send_json_success(['clicks' => $current_count + 1]);
}
add_action('wp_ajax_affiliate_track_click', 'affiliate_track_click');
add_action('wp_ajax_nopriv_affiliate_track_click', 'affiliate_track_click');
?>
