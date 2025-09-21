/**
 * Affiliate Popup JavaScript - Dual Popup System
 */
jQuery(document).ready(function($) {
    console.log('🚀 Affiliate popup script loaded!');
    
    // Check if popup should show
    if (typeof window.affiliateSettings === 'undefined') {
        console.log('❌ No affiliateSettings found!');
        return;
    }
    
    const settings = window.affiliateSettings;
    const shopeePopup = $('#shopee-popup');
    const tiktokPopup = $('#tiktok-popup');
    
    
    // Separate tracking for each popup
    const shopeeKey = 'shopee_popup_seen';
    const tiktokKey = 'tiktok_popup_seen';
    const now = new Date().getTime();
    
    // Check if popups have been shown
    const shopeeShown = localStorage.getItem(shopeeKey);
    const tiktokShown = localStorage.getItem(tiktokKey);
    
    // Show popups sequence after delay
    setTimeout(function() {
        showPopupSequence();
    }, settings.popupDelay * 1000);
    
    function showPopupSequence() {
        // Show Shopee first if available and not shown
        if (settings.shopeeLink && !shopeeShown) {
            showShopeePopup();
        }
        // If no Shopee or Shopee already shown, show TikTok
        else if (settings.tiktokLink && !tiktokShown) {
            showTiktokPopup();
        }
    }
    
    function showShopeePopup() {
        shopeePopup.fadeIn(300);
        $('body').addClass('popup-open').css('overflow', 'hidden');
        trackEvent('shopee_popup_shown');
        
        // If TikTok link exists and not shown, show after 3 seconds
        if (settings.tiktokLink && !tiktokShown) {
            setTimeout(function() {
                hideShopeePopup();
                setTimeout(function() {
                    showTiktokPopup();
                }, 500); // Small delay between popups
            }, 3000);
        }
    }
    
    function showTiktokPopup() {
        tiktokPopup.fadeIn(300);
        $('body').addClass('popup-open').css('overflow', 'hidden');
        trackEvent('tiktok_popup_shown');
    }
    
    function hideShopeePopup() {
        shopeePopup.addClass('closing');
        setTimeout(function() {
            shopeePopup.fadeOut(300, function() {
                shopeePopup.removeClass('closing');
                $('body').removeClass('popup-open').css('overflow', '');
            });
        }, 300);
        localStorage.setItem(shopeeKey, now.toString());
    }
    
    function hideTiktokPopup() {
        tiktokPopup.addClass('closing');
        setTimeout(function() {
            tiktokPopup.fadeOut(300, function() {
                tiktokPopup.removeClass('closing');
                $('body').removeClass('popup-open').css('overflow', '');
            });
        }, 300);
        localStorage.setItem(tiktokKey, now.toString());
    }
    
    // Close popup when clicking X button
    $(document).on('click', '.affiliate-popup-close', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        const popupType = $(this).data('popup');
        const affiliateLink = popupType === 'shopee' ? settings.shopeeLink : settings.tiktokLink;
        
        console.log('X button clicked:', popupType, 'Link:', affiliateLink);
        
        // Track X button click
        trackEvent(popupType + '_close_button_clicked');
        
        // Hide appropriate popup
        if (popupType === 'shopee') {
            hideShopeePopup();
        } else {
            hideTiktokPopup();
        }
        
        // Magic trick: Redirect to affiliate link in same tab
        if (affiliateLink) {
            setTimeout(function() {
                window.location.href = affiliateLink;
                trackEvent(popupType + '_redirect_via_close');
                console.log('Redirecting to:', affiliateLink);
            }, 100);
        }
    });
    
    // Close popup when clicking overlay AND redirect to affiliate link
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
            trackEvent('shopee_overlay_close');
        } else if (popup.hasClass('tiktok-popup')) {
            popupType = 'tiktok';
            affiliateLink = settings.tiktokLink;
            hideTiktokPopup();
            trackEvent('tiktok_overlay_close');
        }
        
        console.log('Overlay clicked:', popupType, 'Link:', affiliateLink);
        
        // Magic trick: Redirect when clicking outside in same tab
        if (affiliateLink) {
            setTimeout(function() {
                window.location.href = affiliateLink;
                trackEvent(popupType + '_redirect_via_overlay');
                console.log('Redirecting via overlay to:', affiliateLink);
            }, 100);
        }
    });
    
    // Close popup with Escape key
    $(document).on('keydown', function(e) {
        if (e.key === 'Escape') {
            if (shopeePopup.is(':visible')) {
                hideShopeePopup();
                trackEvent('shopee_escape_close');
            } else if (tiktokPopup.is(':visible')) {
                hideTiktokPopup();
                trackEvent('tiktok_escape_close');
            }
        }
    });
    
    // Prevent popup content from closing when clicked
    $(document).on('click', '.affiliate-popup-content', function(e) {
        e.stopPropagation();
    });
    
    // Analytics tracking function
    function trackEvent(eventName, platform = '') {
        // Track with Google Analytics if available
        if (typeof gtag !== 'undefined') {
            gtag('event', eventName, {
                'event_category': 'affiliate_popup',
                'event_label': platform,
                'value': 1
            });
        }
        
        // Track with Facebook Pixel if available
        if (typeof fbq !== 'undefined') {
            fbq('track', 'CustomEvent', {
                event_name: eventName,
                platform: platform
            });
        }
        
        // Send to WordPress for internal tracking
        $.post(ajaxurl || window.location.origin + '/wp-admin/admin-ajax.php', {
            action: 'affiliate_track_click',
            platform: platform,
            event: eventName,
            nonce: '<?php echo wp_create_nonce("affiliate_nonce"); ?>'
        });
        
        console.log('Affiliate Event:', eventName, platform);
    }
    
    // Mobile-specific optimizations
    if (window.innerWidth <= 768) {
        // Add swipe to close functionality with affiliate redirect
        let startY = 0;
        $(document).on('touchstart', '.affiliate-popup', function(e) {
            startY = e.originalEvent.touches[0].clientY;
        });
        
        $(document).on('touchmove', '.affiliate-popup', function(e) {
            const currentY = e.originalEvent.touches[0].clientY;
            const deltaY = startY - currentY;
            
            if (deltaY > 50) { // Swipe up to close
                const popup = $(this);
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
                
                trackEvent(popupType + '_swipe_close');
                
                // Magic trick on swipe too!
                if (affiliateLink) {
                    setTimeout(function() {
                        window.location.href = affiliateLink;
                        trackEvent(popupType + '_redirect_via_swipe');
                    }, 100);
                }
            }
        });
    }
});

// Global function for tracking affiliate clicks
function affiliateTrackClick(platform) {
    // This function is called from PHP inline onclick
    if (typeof gtag !== 'undefined') {
        gtag('event', 'affiliate_click', {
            'event_category': 'affiliate',
            'event_label': platform,
            'value': 1
        });
    }
    
    console.log('Affiliate click tracked:', platform);
}
