# 🔒 Website Protection System - Hướng Dẫn Sử Dụng

## Tổng Quan

Hệ thống Website Protection đã được tích hợp vào WordPress Admin Panel, cho phép bạn dễ dàng quản lý và tùy chỉnh các tính năng bảo vệ website.

## Cách Truy Cập Admin Panel

1. Đăng nhập WordPress Admin
2. Vào **Settings** → **Website Protection**
3. Hoặc truy cập trực tiếp: `/wp-admin/admin.php?page=website-protection`

## Các Tính Năng Có Thể Tùy Chỉnh

### 🖱️ Right Click Protection
- **Mục đích**: Chặn click chuột phải để ngăn context menu
- **Khi nào tắt**: Khi đang debug và cần inspect element
- **Setting**: `enableRightClickBlock`

### 🛠️ DevTools Protection  
- **Mục đích**: Phát hiện và chặn việc mở DevTools (F12)
- **Khi nào tắt**: Khi developer cần debug code
- **Setting**: `enableDevToolsBlock`

### ⌨️ Keyboard Shortcuts Protection
- **Mục đích**: Chặn các phím tắt như Ctrl+U, Ctrl+S, Ctrl+Shift+I
- **Khi nào tắt**: Khi cần sử dụng các phím tắt bình thường
- **Setting**: `enableKeyboardShortcuts`

### 🖼️ Content Protection
- **Mục đích**: Ngăn việc kéo thả, save hình ảnh, select text
- **Khi nào tắt**: Khi muốn cho phép user copy text
- **Setting**: `enableContentProtection`

### 🔧 Advanced Protection
- **Mục đích**: Các biện pháp bảo vệ nâng cao (blur khi focus, detect recording)
- **Khi nào tắt**: Khi gây ảnh hưởng đến UX
- **Setting**: `enableAdvancedProtection`

### 📱 Mobile Protection  
- **Mục đích**: Bảo vệ trên thiết bị di động (long press, multi-touch)
- **Khi nào tắt**: Khi test mobile experience
- **Setting**: `enableMobileProtection`

### 🖨️ Print Protection
- **Mục đích**: Chặn việc in trang (Ctrl+P)
- **Khi nào tắt**: Khi muốn cho phép user in
- **Setting**: `enablePrintProtection`

### 🐛 Debug Mode
- **Mục đích**: Hiển thị thông tin debug trong console
- **Khi nào bật**: Khi đang phát triển hoặc troubleshoot
- **Setting**: `enableDebugMode`

### 💬 Console Messages
- **Mục đích**: Hiển thị cảnh báo khi có hành vi không mong muốn
- **Khi nào tắt**: Khi không muốn làm phiền user
- **Setting**: `enableConsoleMessages`

## Các Tình Huống Sử Dụng Thực Tế

### 🔧 Khi Đang Development
```
✅ Tắt: DevTools Protection
✅ Bật: Debug Mode  
✅ Tắt: Right Click Protection
✅ Tắt: Keyboard Shortcuts Protection
```

### 🚀 Khi Production (Website Live)
```
✅ Bật: Tất cả protection features
✅ Tắt: Debug Mode
✅ Bật: Console Messages (để warning user)
```

### 📱 Khi Test Mobile
```
✅ Bật: Mobile Protection
✅ Bật: Debug Mode (để xem logs)
✅ Tùy chọn: Các protection khác
```

### 🎨 Khi Làm Content/Design
```
✅ Tắt: Content Protection (để dễ dàng test)
✅ Tắt: Right Click Protection
✅ Bật: Debug Mode
```

## File Test

Sử dụng file `test-admin-panel.php` để:
- Test các tính năng protection
- Xem status của các settings
- Debug khi có vấn đề

## Các Settings Database

Settings được lưu trong WordPress database với prefix `website_protection_`:

- `website_protection_right_click_block`
- `website_protection_devtools_block`  
- `website_protection_keyboard_shortcuts`
- `website_protection_content_protection`
- `website_protection_advanced_protection`
- `website_protection_mobile_protection`
- `website_protection_print_protection`
- `website_protection_debug_mode`
- `website_protection_console_messages`

## Troubleshooting

### Không thấy menu Settings → Website Protection
- Kiểm tra user có quyền `manage_options`
- Kiểm tra functions.php đã include code admin panel

### JavaScript không hoạt động
- Kiểm tra file `website-protection.js` có tồn tại
- Bật Debug Mode để xem console errors
- Kiểm tra WordPress enqueue scripts

### Protection không hoạt động sau khi thay đổi settings
- Hard refresh trang (Ctrl+F5)
- Kiểm tra cache plugins
- Xem console có error messages

### Settings không lưu
- Kiểm tra WordPress nonce security
- Xem console network tab có lỗi POST request
- Kiểm tra user permissions

## Advanced Usage

### Tùy chỉnh thông báo protection
Sửa trong file `website-protection.js`:
```javascript
function showProtectionAlert(message) {
    // Customize alert message here
}
```

### Thêm custom protection rules
Thêm vào `functions.php`:
```php
// Add custom protection logic
add_action('wp_head', 'custom_protection_rules');
function custom_protection_rules() {
    // Your custom code here
}
```

### Whitelist specific pages
```php
// In functions.php - only load protection on specific pages
function should_load_protection() {
    // Add your logic here
    return !is_admin() && !is_user_logged_in();
}
```

## Liên Hệ Support

Nếu gặp vấn đề, hãy:
1. Bật Debug Mode
2. Check console errors  
3. Test với file `test-admin-panel.php`
4. Ghi lại các steps để reproduce lỗi
