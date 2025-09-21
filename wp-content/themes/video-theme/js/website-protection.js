/**
 * Advanced Website Protection System
 * Prevents DevTools, Right-click, and Content Theft
 */

(function() {
    'use strict';
    
    console.log('🔒 Website Protection System Loading...');
    
    // Configuration - Use WordPress admin settings if available
    const defaultConfig = {
        enableRightClickBlock: true,
        enableDevToolsBlock: true,
        enableKeyboardShortcuts: true,
        enableContentProtection: true,
        enableAdvancedProtection: true,
        enableMobileProtection: true,
        enablePrintProtection: true,
        enableDebugMode: false,
        enableConsoleMessages: true,
        warningMessage: '⚠️ CẢNH BÁO: Truy cập trái phép vào mã nguồn bị cấm!',
        redirectUrl: '' // Leave empty to just show alert
    };
    
    // Merge with WordPress settings if available
    const config = typeof window.WebsiteProtectionConfig !== 'undefined' 
        ? Object.assign({}, defaultConfig, window.WebsiteProtectionConfig)
        : defaultConfig;
    
    // Log current configuration in debug mode
    if (config.enableDebugMode) {
        console.log('🔧 Protection Configuration:', config);
    }
    
    // Debug logging
    function debugLog(message) {
        if (config.enableDebugMode) {
            console.log('[Protection] ' + message);
        }
    }
    
    // ==================== DEVTOOLS DETECTION ====================
    
    let devtools = {
        open: false,
        orientation: null
    };
    
    // DevTools detection methods
    const detectDevTools = () => {
        // Method 1: Console check
        let consoleCheck = false;
        const devObject = /./;
        devObject.toString = function() {
            consoleCheck = true;
            return 'DevTools detected via console';
        };
        console.log('%c', devObject);
        
        // Method 2: Timing check
        const start = performance.now();
        debugger;
        const end = performance.now();
        const timingCheck = (end - start) > 100;
        
        // Method 3: Window size check
        const heightThreshold = window.outerHeight - window.innerHeight > 200;
        const widthThreshold = window.outerWidth - window.innerWidth > 300;
        
        return consoleCheck || timingCheck || heightThreshold || widthThreshold;
    };
    
    // Advanced DevTools detection
    const advancedDevToolsDetection = () => {
        // Check for common DevTools elements
        const devToolsElements = [
            'console-tab',
            'console-panel',
            'sources-panel',
            'network-panel',
            'elements-panel'
        ];
        
        let detected = false;
        devToolsElements.forEach(element => {
            if (document.querySelector(`[class*="${element}"]`)) {
                detected = true;
            }
        });
        
        return detected;
    };
    
    // Monitor DevTools
    function monitorDevTools() {
        if (!config.enableDevToolsBlock) return;
        
        // Continuous monitoring
        setInterval(() => {
            const isOpen = detectDevTools() || advancedDevToolsDetection();
            
            if (isOpen && !devtools.open) {
                devtools.open = true;
                debugLog('DevTools opened');
                handleDevToolsOpen();
            } else if (!isOpen && devtools.open) {
                devtools.open = false;
                debugLog('DevTools closed');
            }
        }, 500);
        
        // Additional check using resize event
        window.addEventListener('resize', () => {
            setTimeout(() => {
                if (detectDevTools()) {
                    handleDevToolsOpen();
                }
            }, 500);
        });
    }
    
    // Handle DevTools detection
    function handleDevToolsOpen() {
        console.clear();
        console.log('%c' + config.warningMessage, 'color: red; font-size: 30px; font-weight: bold;');
        
        if (config.redirectUrl) {
            window.location.href = config.redirectUrl;
        } else {
            alert('🚫 Phát hiện DevTools! Vui lòng đóng để tiếp tục sử dụng website.');
            
            // Optional: Blur the page content
            document.body.style.filter = 'blur(10px)';
            document.body.style.pointerEvents = 'none';
            
            // Restore after a delay if DevTools is closed
            setTimeout(() => {
                if (!detectDevTools()) {
                    document.body.style.filter = 'none';
                    document.body.style.pointerEvents = 'auto';
                }
            }, 3000);
        }
    }
    
    // ==================== RIGHT-CLICK PROTECTION ====================
    
    function blockRightClick() {
        if (!config.enableRightClickBlock) return;
        
        // Block context menu
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            // Show custom message
            showProtectionAlert('🚫 Chuột phải đã bị vô hiệu hóa!');
            
            return false;
        }, true);
        
        // Block right mouse button
        document.addEventListener('mousedown', function(e) {
            if (e.button === 2) {
                e.preventDefault();
                e.stopPropagation();
                return false;
            }
        }, true);
        
        // Block right mouse button up
        document.addEventListener('mouseup', function(e) {
            if (e.button === 2) {
                e.preventDefault();
                e.stopPropagation();
                return false;
            }
        }, true);
    }
    
    // ==================== KEYBOARD SHORTCUTS PROTECTION ====================
    
    function blockKeyboardShortcuts() {
        if (!config.enableKeyboardShortcuts) return;
        
        document.addEventListener('keydown', function(e) {
            // Block F12
            if (e.keyCode === 123) {
                e.preventDefault();
                e.stopPropagation();
                showProtectionAlert('🚫 F12 đã bị vô hiệu hóa!');
                return false;
            }
            
            // Block Ctrl+Shift+I (DevTools)
            if (e.ctrlKey && e.shiftKey && e.keyCode === 73) {
                e.preventDefault();
                e.stopPropagation();
                showProtectionAlert('🚫 DevTools đã bị chặn!');
                return false;
            }
            
            // Block Ctrl+Shift+C (Inspect)
            if (e.ctrlKey && e.shiftKey && e.keyCode === 67) {
                e.preventDefault();
                e.stopPropagation();
                showProtectionAlert('🚫 Inspect đã bị chặn!');
                return false;
            }
            
            // Block Ctrl+Shift+J (Console)
            if (e.ctrlKey && e.shiftKey && e.keyCode === 74) {
                e.preventDefault();
                e.stopPropagation();
                showProtectionAlert('🚫 Console đã bị chặn!');
                return false;
            }
            
            // Block Ctrl+U (View Source)
            if (e.ctrlKey && e.keyCode === 85) {
                e.preventDefault();
                e.stopPropagation();
                showProtectionAlert('🚫 View Source đã bị chặn!');
                return false;
            }
            
            // Block Ctrl+S (Save Page)
            if (e.ctrlKey && e.keyCode === 83) {
                e.preventDefault();
                e.stopPropagation();
                showProtectionAlert('🚫 Save Page đã bị chặn!');
                return false;
            }
            
            // Block Ctrl+A (Select All)
            if (e.ctrlKey && e.keyCode === 65) {
                e.preventDefault();
                e.stopPropagation();
                showProtectionAlert('🚫 Select All đã bị chặn!');
                return false;
            }
            
            // Block Ctrl+C (Copy)
            if (e.ctrlKey && e.keyCode === 67 && !e.shiftKey) {
                e.preventDefault();
                e.stopPropagation();
                showProtectionAlert('🚫 Copy đã bị chặn!');
                return false;
            }
            
            // Block Ctrl+V (Paste) - Optional
            if (e.ctrlKey && e.keyCode === 86) {
                // Allow paste in input fields
                if (!e.target.matches('input, textarea')) {
                    e.preventDefault();
                    e.stopPropagation();
                    showProtectionAlert('🚫 Paste đã bị chặn!');
                    return false;
                }
            }
            
        }, true);
    }
    
    // ==================== CONTENT PROTECTION ====================
    
    function protectContent() {
        if (!config.enableContentProtection) return;
        
        // Disable text selection
        document.addEventListener('selectstart', function(e) {
            e.preventDefault();
            return false;
        });
        
        // Disable drag and drop
        document.addEventListener('dragstart', function(e) {
            e.preventDefault();
            return false;
        });
        
        // Disable image saving
        document.addEventListener('dragstart', function(e) {
            if (e.target.tagName === 'IMG') {
                e.preventDefault();
                return false;
            }
        });
        
        // Disable print screen (limited effectiveness)
        document.addEventListener('keyup', function(e) {
            if (e.keyCode === 44) {
                showProtectionAlert('🚫 Print Screen đã bị phát hiện!');
            }
        });
        
        // Add CSS to prevent selection
        const style = document.createElement('style');
        style.textContent = `
            * {
                -webkit-user-select: none !important;
                -moz-user-select: none !important;
                -ms-user-select: none !important;
                user-select: none !important;
                -webkit-touch-callout: none !important;
                -webkit-tap-highlight-color: transparent !important;
            }
            
            input, textarea {
                -webkit-user-select: text !important;
                -moz-user-select: text !important;
                -ms-user-select: text !important;
                user-select: text !important;
            }
            
            img {
                pointer-events: none !important;
                -webkit-user-drag: none !important;
                -khtml-user-drag: none !important;
                -moz-user-drag: none !important;
                -o-user-drag: none !important;
                user-drag: none !important;
            }
            
            /* Hide scrollbars to prevent DevTools detection */
            ::-webkit-scrollbar {
                width: 0px;
                background: transparent;
            }
        `;
        document.head.appendChild(style);
    }
    
    // ==================== CONSOLE PROTECTION ====================
    
    function protectConsole() {
        if (!config.enableConsoleMessages) return;
        
        // Override console methods
        const originalLog = console.log;
        const originalWarn = console.warn;
        const originalError = console.error;
        
        console.log = function() {
            originalLog('%c🚫 CẢNH BÁO BẢO MẬT', 'color: red; font-size: 20px; font-weight: bold;');
            originalLog('%cTruy cập console đã bị ghi lại! IP của bạn đã được lưu trữ.', 'color: orange; font-size: 14px;');
        };
        
        console.warn = console.log;
        console.error = console.log;
        
        // Clear console periodically
        setInterval(() => {
            console.clear();
            console.log('%c' + config.warningMessage, 'color: red; font-size: 25px; font-weight: bold; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);');
        }, 1000);
    }
    
    // ==================== UTILITIES ====================
    
    function showProtectionAlert(message) {
        // Create custom alert that can't be easily bypassed
        const alertDiv = document.createElement('div');
        alertDiv.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, #ff4757, #ff3838);
            color: white;
            padding: 15px 20px;
            border-radius: 10px;
            font-weight: bold;
            font-size: 14px;
            z-index: 999999999;
            box-shadow: 0 4px 15px rgba(255, 71, 87, 0.4);
            animation: slideInRight 0.3s ease-out;
            max-width: 300px;
        `;
        
        // Add animation
        const animationStyle = document.createElement('style');
        animationStyle.textContent = `
            @keyframes slideInRight {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
        `;
        document.head.appendChild(animationStyle);
        
        alertDiv.textContent = message;
        document.body.appendChild(alertDiv);
        
        // Remove after 3 seconds
        setTimeout(() => {
            if (alertDiv.parentNode) {
                alertDiv.remove();
            }
        }, 3000);
    }
    
    // ==================== ADVANCED PROTECTION ====================
    
    function advancedProtection() {
        // Detect if page is being viewed in iframe
        if (window.top !== window.self) {
            window.top.location = window.self.location;
        }
        
        // Disable zoom
        document.addEventListener('wheel', function(e) {
            if (e.ctrlKey) {
                e.preventDefault();
                showProtectionAlert('🚫 Zoom đã bị vô hiệu hóa!');
            }
        }, { passive: false });
        
        // Disable zoom via keyboard
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey && (e.keyCode === 107 || e.keyCode === 109 || e.keyCode === 187 || e.keyCode === 189)) ||
                (e.ctrlKey && e.keyCode === 48)) {
                e.preventDefault();
                showProtectionAlert('🚫 Zoom đã bị vô hiệu hóa!');
            }
        });
        
        // Blur page when window loses focus (prevents screenshot tools)
        let isBlurred = false;
        window.addEventListener('blur', function() {
            if (!isBlurred) {
                document.body.style.filter = 'blur(5px)';
                isBlurred = true;
            }
        });
        
        window.addEventListener('focus', function() {
            if (isBlurred) {
                document.body.style.filter = 'none';
                isBlurred = false;
            }
        });
    }
    
    // ==================== MOBILE PROTECTION ====================
    
    function mobileProtection() {
        if (!config.enableMobileProtection) return;
        
        // Disable long press context menu on mobile
        document.addEventListener('touchstart', function(e) {
            if (e.touches.length > 1) {
                e.preventDefault(); // Disable multi-touch
            }
        });
        
        document.addEventListener('touchend', function(e) {
            e.preventDefault();
        }, { passive: false });
        
        // Disable mobile selection
        document.addEventListener('selectionchange', function() {
            if (window.getSelection) {
                window.getSelection().removeAllRanges();
            }
        });
        
        // Disable iOS callout
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
            return false;
        });
        
        // Disable touch callout
        const style = document.createElement('style');
        style.textContent += `
            * {
                -webkit-touch-callout: none !important;
                -webkit-user-select: none !important;
                -webkit-tap-highlight-color: rgba(0,0,0,0) !important;
                user-select: none !important;
            }
            
            input, textarea {
                -webkit-touch-callout: default !important;
                -webkit-user-select: text !important;
                user-select: text !important;
            }
        `;
        document.head.appendChild(style);
        
        debugLog('Mobile protection enabled');
    }
    
    // ==================== PRINT PROTECTION ====================
    
    function printProtection() {
        if (!config.enablePrintProtection) return;
        
        // Block Ctrl+P
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey && e.keyCode === 80) {
                e.preventDefault();
                e.stopPropagation();
                showProtectionAlert('🚫 In trang đã bị chặn!');
                return false;
            }
        });
        
        // Detect print screen
        window.addEventListener('beforeprint', function(e) {
            e.preventDefault();
            showProtectionAlert('🚫 In trang không được phép!');
            return false;
        });
        
        window.addEventListener('afterprint', function(e) {
            showProtectionAlert('🚫 Phát hiện hành vi in trái phép!');
        });
        
        // Override print function
        window.print = function() {
            showProtectionAlert('🚫 Chức năng in đã bị vô hiệu hóa!');
            return false;
        };
        
        debugLog('Print protection enabled');
    }
    
    // ==================== INITIALIZATION ====================
    
    function init() {
        // Wait for DOM to be ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() {
                initProtection();
            });
        } else {
            initProtection();
        }
    }
    
    function initProtection() {
        debugLog('Initializing protection systems...');
        
        try {
            blockRightClick();
            blockKeyboardShortcuts();
            protectContent();
            protectConsole();
            monitorDevTools();
            advancedProtection();
            mobileProtection();
            printProtection();
            
            debugLog('All protection systems activated');
            
            // Show initialization message (only in debug mode)
            if (config.debugMode) {
                console.log('%c🔒 Website Protection Active', 'color: green; font-size: 16px; font-weight: bold;');
            }
            
        } catch (error) {
            debugLog('Error initializing protection: ' + error.message);
        }
    }
    
    // ==================== PUBLIC API ====================
    
    window.WebsiteProtection = {
        enable: function() {
            config.enableRightClickBlock = true;
            config.enableDevToolsBlock = true;
            config.enableKeyboardShortcuts = true;
            config.enableContentProtection = true;
            initProtection();
        },
        
        disable: function() {
            config.enableRightClickBlock = false;
            config.enableDevToolsBlock = false;
            config.enableKeyboardShortcuts = false;
            config.enableContentProtection = false;
        },
        
        toggleDebug: function() {
            config.debugMode = !config.debugMode;
            console.log('Debug mode:', config.debugMode);
        },
        
        getStatus: function() {
            return {
                rightClick: config.enableRightClickBlock,
                devTools: config.enableDevToolsBlock,
                keyboard: config.enableKeyboardShortcuts,
                content: config.enableContentProtection,
                debug: config.debugMode
            };
        }
    };
    
    // Start protection
    init();
    
})();
