<?php
// Enable affiliate popup and set default values
define('WP_USE_THEMES', false);
require_once('./wp-config.php');

echo "=== AFFILIATE POPUP SETUP ===\n";

// Enable the popup
update_option('affiliate_popup_enabled', true);
echo "✅ Enabled affiliate popup\n";

// Set default values if not exists
if (!get_option('affiliate_popup_shopee_link')) {
    update_option('affiliate_popup_shopee_link', 'https://shopee.vn/test-affiliate-link');
    echo "✅ Set default Shopee link\n";
}

if (!get_option('affiliate_popup_tiktok_link')) {
    update_option('affiliate_popup_tiktok_link', 'https://shop.tiktok.com/test-affiliate-link');
    echo "✅ Set default TikTok link\n";
}

if (!get_option('affiliate_popup_image')) {
    update_option('affiliate_popup_image', 'https://via.placeholder.com/300x200/ff6b35/ffffff?text=SALE');
    echo "✅ Set default popup image\n";
}

if (!get_option('affiliate_popup_delay')) {
    update_option('affiliate_popup_delay', 3);
    echo "✅ Set default delay (3 seconds)\n";
}

if (!get_option('affiliate_popup_title')) {
    update_option('affiliate_popup_title', 'Ưu đãi đặc biệt!');
    echo "✅ Set default title\n";
}

if (!get_option('affiliate_popup_description')) {
    update_option('affiliate_popup_description', 'Giảm giá lớn - Chỉ hôm nay!');
    echo "✅ Set default description\n";
}

echo "\n=== CURRENT SETTINGS ===\n";
echo "Enabled: " . (get_option('affiliate_popup_enabled') ? 'YES' : 'NO') . "\n";
echo "Shopee Link: " . get_option('affiliate_popup_shopee_link') . "\n";
echo "TikTok Link: " . get_option('affiliate_popup_tiktok_link') . "\n";
echo "Image: " . get_option('affiliate_popup_image') . "\n";
echo "Delay: " . get_option('affiliate_popup_delay') . " seconds\n";
echo "Title: " . get_option('affiliate_popup_title') . "\n";
echo "Description: " . get_option('affiliate_popup_description') . "\n";

echo "\n✅ Setup complete! Now visit your website to see the popup.\n";
?>
