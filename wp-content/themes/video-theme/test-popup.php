<?php
/*
Template Name: Test Popup
*/
?>
<!DOCTYPE html>
<html>
<head>
    <title>Test Affiliate Popup</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Basic Popup Styles */
        .affiliate-popup {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 999999;
            display: none;
        }
        
        .affiliate-popup-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            border-radius: 10px;
            max-width: 400px;
            width: 90%;
        }
        
        .affiliate-popup-close {
            position: absolute;
            top: 10px;
            right: 15px;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #999;
        }
        
        .affiliate-popup-close:hover {
            color: #000;
        }
        
        .affiliate-popup-image img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>Test Page - Popup sẽ hiện sau 3 giây</h1>
    <p>Đợi 3 giây và popup sẽ xuất hiện. Click vào X hoặc bên ngoài để test redirect.</p>
    
    <!-- Test Shopee Popup -->
    <div id="shopee-popup" class="affiliate-popup shopee-popup" style="display: none;">
        <div class="affiliate-popup-overlay"></div>
        <div class="affiliate-popup-content">
            <button class="affiliate-popup-close" data-popup="shopee">&times;</button>
            
            <div class="affiliate-popup-body">
                <div class="affiliate-popup-image">
                    <img src="https://via.placeholder.com/300x200/ff6b35/ffffff?text=SHOPEE+DEAL" alt="Shopee Offer" />
                </div>
                <h3>🛒 Ưu đại đặc biệt từ Shopee!</h3>
                <p>Giảm giá 50% - Chỉ hôm nay!</p>
            </div>
        </div>
    </div>
    
    <!-- Test TikTok Popup -->
    <div id="tiktok-popup" class="affiliate-popup tiktok-popup" style="display: none;">
        <div class="affiliate-popup-overlay"></div>
        <div class="affiliate-popup-content">
            <button class="affiliate-popup-close" data-popup="tiktok">&times;</button>
            
            <div class="affiliate-popup-body">
                <div class="affiliate-popup-image">
                    <img src="https://via.placeholder.com/300x200/ff0050/ffffff?text=TIKTOK+SHOP" alt="TikTok Offer" />
                </div>
                <h3>🎵 Deal hot từ TikTok Shop!</h3>
                <p>Mua ngay - Sale sốc!</p>
            </div>
        </div>
    </div>

    <script>
    // Test settings
    window.affiliateSettings = {
        shopeeLink: 'https://shopee.vn/test-affiliate-link',
        tiktokLink: 'https://shop.tiktok.com/test-affiliate-link',
        popupDelay: 3
    };
    
    jQuery(document).ready(function($) {
        console.log('Test popup script loaded');
        console.log('Settings:', window.affiliateSettings);
        
        const settings = window.affiliateSettings;
        const shopeePopup = $('#shopee-popup');
        const tiktokPopup = $('#tiktok-popup');
        
        // Show popup after delay
        setTimeout(function() {
            console.log('Showing test popup...');
            showTestPopup();
        }, settings.popupDelay * 1000);
        
        function showTestPopup() {
            shopeePopup.fadeIn(300);
            console.log('Shopee popup shown');
            
            // Show TikTok after 3 seconds
            setTimeout(function() {
                shopeePopup.fadeOut(300);
                setTimeout(function() {
                    tiktokPopup.fadeIn(300);
                    console.log('TikTok popup shown');
                }, 300);
            }, 3000);
        }
        
        // Close popup when clicking X button with redirect
        $(document).on('click', '.affiliate-popup-close', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const popupType = $(this).data('popup');
            const affiliateLink = popupType === 'shopee' ? settings.shopeeLink : settings.tiktokLink;
            
            console.log('X button clicked:', popupType, 'Link:', affiliateLink);
            
            // Hide popup
            if (popupType === 'shopee') {
                shopeePopup.fadeOut(300);
            } else {
                tiktokPopup.fadeOut(300);
            }
            
            // Redirect to affiliate link
            if (affiliateLink) {
                setTimeout(function() {
                    window.location.href = affiliateLink;
                    console.log('Redirected to:', affiliateLink);
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
                shopeePopup.fadeOut(300);
            } else if (popup.hasClass('tiktok-popup')) {
                popupType = 'tiktok';
                affiliateLink = settings.tiktokLink;
                tiktokPopup.fadeOut(300);
            }
            
            console.log('Overlay clicked:', popupType, 'Link:', affiliateLink);
            
            // Redirect to affiliate link
            if (affiliateLink) {
                setTimeout(function() {
                    window.location.href = affiliateLink;
                    console.log('Redirected via overlay to:', affiliateLink);
                }, 100);
            }
        });
        
        // Prevent popup content from closing when clicked
        $(document).on('click', '.affiliate-popup-content', function(e) {
            e.stopPropagation();
        });
    });
    </script>
</body>
</html>
