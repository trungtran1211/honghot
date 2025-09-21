jQuery(document).ready(function($) {
    // Smooth scrolling for anchor links
    $('a[href*="#"]').on('click', function(e) {
        if (this.hash !== "") {
            e.preventDefault();
            var hash = this.hash;
            $('html, body').animate({
                scrollTop: $(hash).offset().top - 80
            }, 800);
        }
    });
    
    // Post card hover effects
    $('.post-card').hover(
        function() {
            $(this).addClass('hover-effect');
        },
        function() {
            $(this).removeClass('hover-effect');
        }
    );
    
    // Lazy loading for images
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }
    
    // Search form enhancement
    $('.search-form input[type="search"]').on('focus', function() {
        $(this).parent().addClass('focused');
    }).on('blur', function() {
        $(this).parent().removeClass('focused');
    });
    
    // Post view counter (removed - not needed for simple posts)
    
    // Mobile menu toggle (if needed)
    $('.menu-toggle').on('click', function() {
        $('.nav-menu').toggleClass('toggled');
        $(this).toggleClass('toggled');
    });
    
    // Post card animation on scroll
    $(window).scroll(function() {
        $('.post-card').each(function() {
            var elementTop = $(this).offset().top;
            var elementBottom = elementTop + $(this).outerHeight();
            var viewportTop = $(window).scrollTop();
            var viewportBottom = viewportTop + $(window).height();
            
            if (elementBottom > viewportTop && elementTop < viewportBottom) {
                $(this).addClass('in-view');
            }
        });
    });
    
    // Initial check for visible elements
    $(window).trigger('scroll');
});

// Add pulse animation class
jQuery(document).ready(function($) {
    $('<style>')
        .prop('type', 'text/css')
        .html(`
            .play-button.pulse {
                animation: pulse 1s infinite;
            }
            
            @keyframes pulse {
                0% { transform: translate(-50%, -50%) scale(1); }
                50% { transform: translate(-50%, -50%) scale(1.1); }
                100% { transform: translate(-50%, -50%) scale(1); }
            }
            
            .post-card {
                opacity: 0;
                transform: translateY(20px);
                transition: opacity 0.6s ease, transform 0.6s ease;
            }
            
            .post-card.in-view {
                opacity: 1;
                transform: translateY(0);
            }
            
            .search-form.focused {
                transform: scale(1.02);
                transition: transform 0.3s ease;
            }
        `)
        .appendTo('head');
});
