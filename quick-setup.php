<?php
// Quick setup - Add this to any WordPress page temporarily
if (current_user_can('administrator')) {
    
    // Enable popup
    update_option('affiliate_popup_enabled', true);
    
    // Set your real affiliate links here
    update_option('affiliate_popup_shopee_link', 'YOUR_SHOPEE_AFFILIATE_LINK_HERE');
    update_option('affiliate_popup_tiktok_link', 'YOUR_TIKTOK_AFFILIATE_LINK_HERE');
    update_option('affiliate_popup_image', 'https://via.placeholder.com/300x200/ff6b35/ffffff?text=SALE');
    update_option('affiliate_popup_delay', 3);
    
    echo '<div style="background:#d4edda;color:#155724;padding:15px;border-radius:5px;margin:20px;">';
    echo '<h3>✅ Affiliate Popup Activated!</h3>';
    echo '<p>Popup is now enabled on your website. Visit homepage to test.</p>';
    echo '<p><strong>Don\'t forget to:</strong></p>';
    echo '<ul>';
    echo '<li>Replace YOUR_SHOPEE_AFFILIATE_LINK_HERE with real Shopee link</li>';
    echo '<li>Replace YOUR_TIKTOK_AFFILIATE_LINK_HERE with real TikTok link</li>';
    echo '<li>Upload your product image</li>';
    echo '</ul>';
    echo '</div>';
}
?>
