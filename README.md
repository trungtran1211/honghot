# 🎬 Video Theme - WordPress

Theme chuyên dụng cho website video với hệ thống affiliate popup thông minh.

## 🚀 Tính năng chính

- **Modern Design**: Header, Footer và Search form hiện đại
- **Affiliate Popup System**: Hệ thống popup với reverse psychology
- **Cookie Management**: Quản lý hiển thị popup bằng cookie
- **Responsive Design**: Tối ưu cho mọi thiết bị
- **Fast Performance**: Tối ưu tốc độ loading

## 📋 Cài đặt

1. **Clone repository:**
```bash
git clone https://github.com/trungtran1211/honghot.git
cd honghot
```

2. **Cấu hình WordPress:**
   - Copy `wp-config-sample.php` thành `wp-config.php`
   - Cập nhật thông tin database trong `wp-config.php`

3. **Kích hoạt theme:**
   - Vào WordPress Admin → Appearance → Themes
   - Kích hoạt "Video Theme"

## ⚙️ Cấu hình Affiliate Popup

1. **Vào WordPress Admin:**
   - Settings → Affiliate Popup

2. **Cấu hình:**
   - **Shopee Link**: Link affiliate Shopee của bạn
   - **TikTok Link**: Link affiliate TikTok của bạn
   - **Popup Image**: URL hình ảnh sản phẩm
   - **Cookie Duration**: Thời gian nhớ popup (24h khuyến nghị)

## 🍪 Cookie System

- **Session Cookie**: Popup hiện mỗi khi mở trình duyệt mới
- **Persistent Cookie**: Từ 1 giờ đến 1 tuần
- **Reverse Psychology**: Click X button → Redirect affiliate link

## 🎨 Customization

### Colors
Chỉnh sửa trong `style.css`:
```css
/* Main gradient */
background: linear-gradient(135deg, #2c3e50 0%, #3498db 50%, #9b59b6 100%);

/* Accent color */
color: #ffd700;
```

### Popup Timing
```javascript
popupDelay: 3, // seconds
cookieHours: 24 // hours
```

## 📁 Cấu trúc thư mục

```
wp-content/themes/video-theme/
├── style.css                 # Main stylesheet
├── functions.php            # Theme functions
├── header.php              # Header template
├── footer.php              # Footer template
├── index.php               # Homepage template
├── single.php              # Single post template
├── searchform.php          # Search form
├── affiliate-functions.php # Affiliate popup system
└── js/
    └── main.js            # JavaScript functions
```

## 🔒 Security

**QUAN TRỌNG**: File `.gitignore` đã được cấu hình để:
- ✅ **Không commit** `wp-config.php`
- ✅ **Bảo vệ** database và backup files
- ✅ **Loại trừ** logs và temporary files
- ✅ **Bỏ qua** WordPress core files

## 🐛 Debug

### Console Commands (F12):
```javascript
// Clear popup cookie
testPopupFunctions.clearCookie()

// Check cookie status
testPopupFunctions.showCookieStatus()

// Force show popup
testPopupFunctions.forceShowPopup()
```

### Admin Test Pages:
- `/force-setup.php` - Setup tự động
- `/test-popup.html` - Test popup standalone

## 📝 Changelog

### v1.0.0
- ✅ Initial release
- ✅ Basic video theme
- ✅ Affiliate popup system
- ✅ Modern header/footer design
- ✅ Cookie-based popup management
- ✅ Mobile responsive

## 🤝 Contributing

1. Fork repository
2. Tạo feature branch: `git checkout -b feature/amazing-feature`
3. Commit changes: `git commit -m 'Add amazing feature'`
4. Push to branch: `git push origin feature/amazing-feature`
5. Open Pull Request

## 📜 License

Distributed under the MIT License. See `LICENSE` for more information.

## 📞 Contact

- **Author**: HongHot Video
- **GitHub**: [@trungtran1211](https://github.com/trungtran1211)
- **Project Link**: [https://github.com/trungtran1211/honghot](https://github.com/trungtran1211/honghot)

---
*Made with ❤️ in Vietnam*
