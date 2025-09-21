<?php
/*
Template Name: Setup Affiliate
*/

// Enable affiliate popup and set default values
echo "<!DOCTYPE html><html><head><title>Affiliate Setup</title><style>body{font-family:Arial;padding:20px;background:#f5f5f5;}.box{background:white;padding:20px;border-radius:10px;box-shadow:0 2px 10px rgba(0,0,0,0.1);}</style></head><body>";
echo "<div class='box'>";
echo "<h1>🛠️ AFFILIATE POPUP SETUP</h1>";

// Enable the popup
update_option('affiliate_popup_enabled', true);
echo "<p>✅ Enabled affiliate popup</p>";

// Set default values if not exists
if (!get_option('affiliate_popup_shopee_link')) {
    update_option('affiliate_popup_shopee_link', 'https://shopee.vn/test-affiliate-link');
    echo "<p>✅ Set default Shopee link</p>";
}

if (!get_option('affiliate_popup_tiktok_link')) {
    update_option('affiliate_popup_tiktok_link', 'https://shop.tiktok.com/test-affiliate-link');
    echo "<p>✅ Set default TikTok link</p>";
}

if (!get_option('affiliate_popup_image')) {
    update_option('affiliate_popup_image', 'https://via.placeholder.com/300x200/ff6b35/ffffff?text=SALE');
    echo "<p>✅ Set default popup image</p>";
}

if (!get_option('affiliate_popup_delay')) {
    update_option('affiliate_popup_delay', 3);
    echo "<p>✅ Set default delay (3 seconds)</p>";
}

if (!get_option('affiliate_popup_title')) {
    update_option('affiliate_popup_title', 'Ưu đãi đặc biệt!');
    echo "<p>✅ Set default title</p>";
}

if (!get_option('affiliate_popup_description')) {
    update_option('affiliate_popup_description', 'Giảm giá lớn - Chỉ hôm nay!');
    echo "<p>✅ Set default description</p>";
}

echo "<h2>📋 CURRENT SETTINGS</h2>";
echo "<ul>";
echo "<li><strong>Enabled:</strong> " . (get_option('affiliate_popup_enabled') ? 'YES' : 'NO') . "</li>";
echo "<li><strong>Shopee Link:</strong> " . get_option('affiliate_popup_shopee_link') . "</li>";
echo "<li><strong>TikTok Link:</strong> " . get_option('affiliate_popup_tiktok_link') . "</li>";
echo "<li><strong>Image:</strong> " . get_option('affiliate_popup_image') . "</li>";
echo "<li><strong>Delay:</strong> " . get_option('affiliate_popup_delay') . " seconds</li>";
echo "<li><strong>Title:</strong> " . get_option('affiliate_popup_title') . "</li>";
echo "<li><strong>Description:</strong> " . get_option('affiliate_popup_description') . "</li>";
echo "</ul>";

echo "<div style='background:#d4edda;color:#155724;padding:15px;border-radius:5px;margin:20px 0;'>";
echo "<h3>🎉 Setup Complete!</h3>";
echo "<p>Now visit your website homepage to see the popup in action. The popup will appear after 3 seconds.</p>";
echo "<p><strong>Remember:</strong> Click the X button or outside the popup to test the affiliate redirect magic!</p>";
echo "</div>";

echo "<h3>🔧 Admin Panel</h3>";
echo "<p>You can also configure these settings in WordPress Admin → Settings → Affiliate Popup</p>";

echo "</div></body></html>";
?>
