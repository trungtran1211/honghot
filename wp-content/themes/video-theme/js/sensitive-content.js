/**
 * Advanced Sensitive Content Blur System
 * Supports both global blur (checkbox) and specific shortcode-based blur
 */

jQuery(document).ready(function($) {
    console.log('🔒 Advanced Sensitive Content System Loading...');
    
    // Configuration
    const config = {
        blurAmount: '20px',
        animationDuration: 300,
        warningText: 'Hình ảnh nhạy cảm, muốn xem thì nhấn vào?',
        buttonText: 'Nhấn để xem',
        selectors: {
            images: '.post-content img, .post-description img',
            videos: '.post-content video, .post-description video, .post-content iframe[src*="youtube"], .post-content iframe[src*="vimeo"]',
            shortcodeContainers: '.sensitive-shortcode-container'
        }
    };
    
    // First, handle shortcode-based sensitive content (always active)
    handleShortcodeSensitiveContent();
    
    // Then, handle global sensitive content if enabled
    if (typeof window.hasSensitiveContent !== 'undefined' && window.hasSensitiveContent) {
        console.log('⚠️ Global sensitive content detected, applying blur to all media...');
        handleGlobalSensitiveContent();
    } else {
        console.log('ℹ️ No global sensitive content, only shortcode-based content will be processed');
    }
    
    // Setup universal event handlers
    setupEventHandlers();
    
    console.log('✅ Advanced Sensitive Content System Loaded Successfully');
    
    /**
     * Handle shortcode-based sensitive content
     */
    function handleShortcodeSensitiveContent() {
        const shortcodeContainers = $(config.selectors.shortcodeContainers);
        
        if (shortcodeContainers.length === 0) {
            console.log('📝 No shortcode-based sensitive content found');
            return;
        }
        
        console.log(`📝 Found ${shortcodeContainers.length} shortcode-based sensitive items`);
        
        shortcodeContainers.each(function() {
            const $container = $(this);
            
            // Skip if already processed
            if ($container.hasClass('processed')) {
                return;
            }
            
            // Mark as processed
            $container.addClass('processed');
            
            const mediaType = $container.data('media-type');
            const mediaId = $container.data('media-id');
            
            console.log(`🔒 Processing shortcode ${mediaType}: ${mediaId}`);
            
            // Shortcodes are already properly structured, just ensure event handlers work
            initializeContainer($container);
        });
    }
    
    /**
     * Handle global sensitive content (when checkbox is checked)
     */
    function handleGlobalSensitiveContent() {
        // Find all media elements that need to be blurred (excluding shortcode ones)
        const mediaElements = $(config.selectors.images + ', ' + config.selectors.videos)
            .not('.sensitive-shortcode-media'); // Exclude shortcode media
        
        if (mediaElements.length === 0) {
            console.log('📷 No global media elements found to blur');
            return;
        }
        
        console.log(`📷 Found ${mediaElements.length} global media elements to blur`);
        
        // Process each media element
        mediaElements.each(function(index) {
            const $media = $(this);
            const mediaType = $media.is('img') ? 'image' : 'video';
            const mediaId = 'sensitive-global-' + index;
            
            console.log(`🔒 Processing global ${mediaType} #${index}`);
            
            // Skip if already processed or inside a shortcode container
            if ($media.closest('.sensitive-media-container').length > 0) {
                return;
            }
            
            // Create container
            const $container = $('<div>', {
                'class': 'sensitive-media-container global-sensitive-container',
                'data-media-type': mediaType,
                'data-media-id': mediaId
            });
            
            // Create blur overlay
            const $overlay = $('<div>', {
                'class': 'sensitive-overlay',
                'data-media-id': mediaId
            });
            
            // Create warning content
            const $warningContent = $('<div>', {
                'class': 'sensitive-warning',
                'html': `
                    <div class="warning-icon">⚠️</div>
                    <div class="warning-text">${config.warningText}</div>
                    <button class="reveal-button" data-media-id="${mediaId}">
                        <span class="button-icon">👁️</span>
                        <span class="button-text">${config.buttonText}</span>
                    </button>
                `
            });
            
            // Wrap media element
            $media.wrap($container);
            $container = $media.parent(); // Get the actual wrapped container
            
            // Add blur effect to media
            $media.addClass('blurred-media');
            
            // Add overlay and warning
            $container.append($overlay);
            $overlay.append($warningContent);
            
            // Initialize container
            initializeContainer($container);
        });
    }
    
    /**
     * Initialize a sensitive container with proper styling and behavior
     */
    function initializeContainer($container) {
        const mediaType = $container.data('media-type');
        
        // Add specific styling based on media type
        if (mediaType === 'video') {
            $container.find('.warning-icon').text('🎥');
        }
        
        // Ensure proper blur effect is applied
        const $media = $container.find('.blurred-media');
        if ($media.length && !$media.hasClass('blurred-media')) {
            $media.addClass('blurred-media');
        }
    }
    
    /**
     * Setup universal event handlers for all sensitive content
     */
    function setupEventHandlers() {
        // Add click handler to reveal content (universal for all containers)
        $(document).on('click', '.reveal-button, .sensitive-overlay', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const mediaId = $(this).data('media-id');
            console.log(`👁️ Revealing media: ${mediaId}`);
            
            // Find the container for this media
            const $targetContainer = $(`.sensitive-media-container[data-media-id="${mediaId}"]`);
            const $targetMedia = $targetContainer.find('.blurred-media, .sensitive-video-wrapper');
            const $targetOverlay = $targetContainer.find('.sensitive-overlay');
            
            // Add revealing class for animation
            $targetContainer.addClass('revealing');
            
            // Fade out overlay
            $targetOverlay.fadeOut(config.animationDuration, function() {
                // Remove blur from media
                $targetMedia.removeClass('blurred-media').addClass('revealed-media');
                $targetContainer.addClass('revealed');
                
                console.log(`✅ Media revealed: ${mediaId}`);
                
                // Track analytics
                trackRevealEvent($targetContainer.data('media-type'), mediaId);
            });
        });
        
        // Prevent media click when blurred (universal)
        $(document).on('click', '.blurred-media', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            console.log('🚫 Blocked click on blurred media, triggering reveal instead');
            
            // Trigger reveal instead
            $(this).closest('.sensitive-media-container').find('.reveal-button').first().click();
        });
        
        // Add keyboard support (Enter/Space on focused reveal buttons)
        $(document).on('keydown', '.reveal-button', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                $(this).click();
            }
        });
    }
    
    /**
     * Track reveal events for analytics
     */
    function trackRevealEvent(mediaType, mediaId) {
        console.log(`📊 Analytics: Sensitive ${mediaType} revealed - ${mediaId}`);
        
        // You can add Google Analytics or other tracking here
        // gtag('event', 'sensitive_content_revealed', {
        //     'media_type': mediaType,
        //     'media_id': mediaId,
        //     'post_id': window.postId || 'unknown'
        // });
    }
    
    // Add keyboard support (Enter/Space on focused reveal buttons)
    $(document).on('keydown', '.reveal-button', function(e) {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            $(this).click();
        }
    });
    
    // Analytics tracking (optional)
    $(document).on('click', '.reveal-button', function() {
        const mediaType = $(this).closest('.sensitive-media-container').data('media-type');
        console.log(`📊 Analytics: Sensitive ${mediaType} revealed`);
        
        // You can add Google Analytics or other tracking here
        // gtag('event', 'sensitive_content_revealed', {
        //     'media_type': mediaType,
        //     'post_id': window.postId || 'unknown'
        // });
    });
    
    console.log('✅ Sensitive Content System Loaded Successfully');
});

// Admin test functions for debugging
window.sensitiveContentDebug = {
    revealAll: function() {
        jQuery('.reveal-button').click();
        console.log('🔓 All sensitive content revealed');
    },
    
    blurAll: function() {
        jQuery('.revealed-media').removeClass('revealed-media').addClass('blurred-media');
        jQuery('.sensitive-media-container').removeClass('revealed revealing');
        jQuery('.sensitive-overlay').fadeIn(300);
        console.log('🔒 All content blurred again');
    },
    
    getStats: function() {
        const total = jQuery('.sensitive-media-container').length;
        const revealed = jQuery('.sensitive-media-container.revealed').length;
        const blurred = total - revealed;
        
        console.log('📊 Sensitive Content Stats:');
        console.log(`   Total: ${total}`);
        console.log(`   Revealed: ${revealed}`);
        console.log(`   Still Blurred: ${blurred}`);
        
        return { total, revealed, blurred };
    }
};
