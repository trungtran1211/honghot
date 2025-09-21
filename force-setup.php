<?php
// FORCE SETUP AFFILIATE POPUP - Chạy file này 1 lần để setup
require_once('./wp-config.php');

echo "<h1>🔧 FORCE SETUP AFFILIATE POPUP</h1>";

// Force reset
delete_option('affiliate_auto_setup_done');
echo "<p>✅ Reset auto setup flag</p>";

// Force enable
update_option('affiliate_popup_enabled', true);
echo "<p>✅ Force enabled popup</p>";

// Set default links (THAY ĐỔI LINKS NÀY THÀNH LINKS THẬT CỦA BẠN)
update_option('affiliate_popup_shopee_link', 'https://shopee.vn/ma-giam-gia-shopee-freeship-hoahongaz-i.33267090.7933843818');
update_option('affiliate_popup_tiktok_link', 'https://vt.tiktok.com/ZSFJ8L6Qs/');

echo "<p>✅ Set affiliate links</p>";

// Set image
update_option('affiliate_popup_image', 'https://cf.shopee.vn/file/c3f3edfaa9f6dafc4825b77d8449999d');
echo "<p>✅ Set popup image</p>";

// Set timing
update_option('affiliate_popup_delay', 2);
echo "<p>✅ Set delay: 2 seconds</p>";

// Set cookie duration
update_option('affiliate_popup_cookie_hours', 24);
echo "<p>✅ Set cookie duration: 24 hours</p>";

// Set content
update_option('affiliate_popup_title', '🔥 SALE SHOCK - GIẢM 90%');
update_option('affiliate_popup_description', 'Cơ hội vàng chỉ có hôm nay!');
echo "<p>✅ Set popup content</p>";

// Clear any caches
if (function_exists('wp_cache_flush')) {
    wp_cache_flush();
    echo "<p>✅ Cleared cache</p>";
}

echo "<hr>";
echo "<h2>📋 CURRENT SETTINGS:</h2>";
echo "<ul>";
echo "<li><strong>Enabled:</strong> " . (get_option('affiliate_popup_enabled') ? 'YES' : 'NO') . "</li>";
echo "<li><strong>Shopee Link:</strong> " . get_option('affiliate_popup_shopee_link') . "</li>";
echo "<li><strong>TikTok Link:</strong> " . get_option('affiliate_popup_tiktok_link') . "</li>";
echo "<li><strong>Image:</strong> " . get_option('affiliate_popup_image') . "</li>";
echo "<li><strong>Delay:</strong> " . get_option('affiliate_popup_delay') . " seconds</li>";
echo "<li><strong>Cookie Duration:</strong> " . get_option('affiliate_popup_cookie_hours') . " hours</li>";
echo "<li><strong>Title:</strong> " . get_option('affiliate_popup_title') . "</li>";
echo "<li><strong>Description:</strong> " . get_option('affiliate_popup_description') . "</li>";
echo "</ul>";

echo "<div style='background:#d4edda;color:#155724;padding:20px;border-radius:10px;margin:20px 0;'>";
echo "<h2>🎉 SETUP HOÀN TẤT!</h2>";
echo "<p><strong>Hãy làm theo:</strong></p>";
echo "<ol>";
echo "<li>Xóa file này sau khi chạy (bảo mật)</li>";
echo "<li>Vào trang chủ website của bạn</li>";
echo "<li>Đợi 2 giây - popup sẽ xuất hiện</li>";
echo "<li>Test click vào dấu X hoặc bên ngoài popup</li>";
echo "<li>Sẽ chuyển hướng đến link affiliate</li>";
echo "</ol>";
echo "<p><strong>Nếu vẫn không hoạt động:</strong></p>";
echo "<ul>";
echo "<li>Kiểm tra Console (F12) có lỗi JavaScript không</li>";
echo "<li>Kiểm tra file affiliate-popup.js có tồn tại không</li>";
echo "<li>Clear cache trình duyệt (Ctrl+F5)</li>";
echo "</ul>";
echo "</div>";

echo "<div style='background:#fff3cd;color:#856404;padding:15px;border-radius:5px;margin:20px 0;'>";
echo "<h3>🔧 ĐÃ SỬA LỖI CACHE 304!</h3>";
echo "<p>Tôi đã chuyển JavaScript từ file riêng sang inline để tránh cache.</p>";
echo "<p><strong>Bây giờ hãy:</strong></p>";
echo "<ul>";
echo "<li>Hard refresh trang chủ (Ctrl+Shift+R)</li>";
echo "<li>Hoặc clear cache trình duyệt hoàn toàn</li>";
echo "<li>Mở Developer Tools (F12) để xem console log</li>";
echo "</ul>";
echo "</div>";

// Auto redirect after 10 seconds
echo "<script>setTimeout(function(){ window.location.href = '" . home_url() . "'; }, 10000);</script>";
echo "<p>Tự động chuyển về trang chủ sau 10 giây...</p>";
?>
