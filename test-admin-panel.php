<?php
/*
 * Test file for Website Protection Admin Panel
 * File: test-admin-panel.php
 * Purpose: Test admin settings and JavaScript integration
 */
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Admin Panel - Website Protection</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
            background: #f1f1f1;
        }
        .container {
            max-width: 800px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .test-section {
            margin: 20px 0;
            padding: 15px;
            background: #f9f9f9;
            border-left: 4px solid #0073aa;
        }
        .alert {
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            background: #dff0d8;
            border: 1px solid #d6e9c6;
            color: #3c763d;
        }
        .status {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .status.enabled { background: #d4edda; color: #155724; }
        .status.disabled { background: #f8d7da; color: #721c24; }
        code {
            background: #f4f4f4;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: 'Courier New', monospace;
        }
        .test-button {
            padding: 10px 15px;
            background: #0073aa;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 5px;
        }
        .test-button:hover {
            background: #005a87;
        }
        .sensitive-test {
            padding: 20px;
            border: 2px dashed #ccc;
            text-align: center;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔒 Website Protection System Test</h1>
        
        <div class="alert">
            <strong>Hướng dẫn test:</strong>
            <ol>
                <li>Vào WordPress Admin → Settings → Website Protection</li>
                <li>Thay đổi các cài đặt protection</li>
                <li>Quay lại trang này và test các tính năng</li>
                <li>Kiểm tra console để xem debug messages</li>
            </ol>
        </div>

        <div class="test-section">
            <h2>🖱️ Right Click Protection Test</h2>
            <p>Thử click chuột phải vào đây:</p>
            <div class="sensitive-test">
                Right click here to test protection
            </div>
        </div>

        <div class="test-section">
            <h2>⌨️ Keyboard Shortcuts Test</h2>
            <p>Thử các phím tắt sau:</p>
            <ul>
                <li><code>F12</code> - DevTools</li>
                <li><code>Ctrl+Shift+I</code> - Inspector</li>
                <li><code>Ctrl+U</code> - View Source</li>
                <li><code>Ctrl+S</code> - Save Page</li>
                <li><code>Ctrl+P</code> - Print</li>
                <li><code>Ctrl+A</code> - Select All</li>
                <li><code>Ctrl+C</code> - Copy</li>
            </ul>
        </div>

        <div class="test-section">
            <h2>📱 Mobile Protection Test</h2>
            <p>Trên mobile, thử:</p>
            <ul>
                <li>Long press để mở context menu</li>
                <li>Multi-touch gestures</li>
                <li>Text selection</li>
            </ul>
        </div>

        <div class="test-section">
            <h2>🖼️ Content Protection Test</h2>
            <p>Thử kéo thả hoặc save các element sau:</p>
            <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='200' height='100'%3E%3Crect width='200' height='100' fill='%23f0f0f0'/%3E%3Ctext x='50%25' y='50%25' text-anchor='middle' dy='.3em' font-family='Arial'%3ETest Image%3C/text%3E%3C/svg%3E" alt="Test Image" style="border: 1px solid #ccc;">
            
            <div class="sensitive-test">
                <p>This is protected text content</p>
                <span>Try to select and copy this text</span>
            </div>
        </div>

        <div class="test-section">
            <h2>🛠️ Debug & Console Test</h2>
            <button class="test-button" onclick="testConsole()">Test Console Output</button>
            <button class="test-button" onclick="testConfig()">Show Config</button>
            <button class="test-button" onclick="testProtectionStatus()">Check Protection Status</button>
        </div>

        <div class="test-section">
            <h2>📄 Current Protection Status</h2>
            <div id="protection-status">
                <p>Loading protection status...</p>
            </div>
        </div>
    </div>

    <!-- Load WordPress protection script -->
    <script>
        // Simulate WordPress config for testing
        window.WebsiteProtectionConfig = {
            enableRightClickBlock: true,
            enableDevToolsBlock: true,
            enableKeyboardShortcuts: true,
            enableContentProtection: true,
            enableAdvancedProtection: true,
            enableDebugMode: true,
            enableMobileProtection: true,
            enablePrintProtection: true,
            enableConsoleMessages: true
        };
    </script>
    <script src="wp-content/themes/video-theme/js/website-protection.js"></script>
    
    <script>
        // Test functions
        function testConsole() {
            console.log('🧪 Test console message');
            alert('Check console for debug messages');
        }
        
        function testConfig() {
            console.log('📋 Current Config:', window.WebsiteProtectionConfig);
            alert('Check console for current configuration');
        }
        
        function testProtectionStatus() {
            const status = document.getElementById('protection-status');
            const config = window.WebsiteProtectionConfig || {};
            
            let html = '<h3>Protection Features Status:</h3><ul>';
            
            const features = [
                { key: 'enableRightClickBlock', name: 'Right Click Protection' },
                { key: 'enableDevToolsBlock', name: 'DevTools Protection' },
                { key: 'enableKeyboardShortcuts', name: 'Keyboard Shortcuts Block' },
                { key: 'enableContentProtection', name: 'Content Protection' },
                { key: 'enableAdvancedProtection', name: 'Advanced Protection' },
                { key: 'enableMobileProtection', name: 'Mobile Protection' },
                { key: 'enablePrintProtection', name: 'Print Protection' },
                { key: 'enableDebugMode', name: 'Debug Mode' },
                { key: 'enableConsoleMessages', name: 'Console Messages' }
            ];
            
            features.forEach(feature => {
                const enabled = config[feature.key] || false;
                const statusClass = enabled ? 'enabled' : 'disabled';
                const statusText = enabled ? 'ON' : 'OFF';
                html += `<li>${feature.name}: <span class="status ${statusClass}">${statusText}</span></li>`;
            });
            
            html += '</ul>';
            status.innerHTML = html;
        }
        
        // Auto-load status when page loads
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(testProtectionStatus, 1000);
        });
        
        // Test DevTools detection
        let devtools = { open: false, orientation: null };
        setInterval(function() {
            if (window.outerHeight - window.innerHeight > 100 || window.outerWidth - window.innerWidth > 100) {
                if (!devtools.open) {
                    devtools.open = true;
                    console.log('🔍 DevTools opened detected in test');
                }
            } else {
                if (devtools.open) {
                    devtools.open = false;
                    console.log('🔍 DevTools closed detected in test');
                }
            }
        }, 500);
    </script>
</body>
</html>
