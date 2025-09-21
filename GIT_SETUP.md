# 🔧 Hướng dẫn Setup Git Repository

## 1. 📋 Các bước chuẩn bị

### Kiểm tra Git đã cài đặt chưa:
```bash
git --version
```

### Nếu chưa có Git, tải về tại: https://git-scm.com/

## 2. 🚀 Setup Repository

### Khởi tạo Git repository:
```bash
cd "c:\Users\ADMIN\Local Sites\honghot\app\public"
git init
```

### Thêm remote repository:
```bash
git remote add origin https://github.com/trungtran1211/honghot.git
```

### Kiểm tra status:
```bash
git status
```

## 3. 🔒 Bảo vệ file nhạy cảm

### File .gitignore đã được tạo để bảo vệ:
- ✅ `wp-config.php` - Thông tin database
- ✅ `*.log` - Log files
- ✅ `wp-content/uploads/` - Media files
- ✅ `force-setup.php` - Development files

### Kiểm tra file nào sẽ được commit:
```bash
git add .
git status
```

## 4. 📤 Commit và Push lần đầu

### Add và commit:
```bash
git add .
git commit -m "🎬 Initial commit: Video Theme with Affiliate Popup System

✨ Features:
- Modern WordPress theme for video content
- Affiliate popup system with reverse psychology
- Cookie-based popup management
- Responsive design
- Modern header/footer/search

🔒 Security:
- wp-config.php protected
- Development files excluded
- Logs and cache ignored"
```

### Push lên GitHub:
```bash
git push -u origin main
```

## 5. 🔄 Workflow thường xuyên

### Sau khi thay đổi code:
```bash
# Kiểm tra thay đổi
git status

# Add các file mới/thay đổi
git add .

# Hoặc add từng file cụ thể
git add wp-content/themes/video-theme/style.css

# Commit với message rõ ràng
git commit -m "🎨 Improve header design and mobile responsive"

# Push lên GitHub
git push origin main
```

## 6. 🌟 Best Practices

### Commit Messages tốt:
```bash
git commit -m "🐛 Fix affiliate popup cookie expiration"
git commit -m "✨ Add mobile menu toggle functionality"
git commit -m "📱 Improve mobile responsive design"
git commit -m "🔧 Update affiliate popup settings panel"
git commit -m "🎨 Enhance footer design with social links"
```

### Emojis cho commit:
- ✨ `:sparkles:` - New feature
- 🐛 `:bug:` - Bug fix
- 🎨 `:art:` - Improve design/UI
- 📱 `:iphone:` - Mobile responsive
- 🔧 `:wrench:` - Configuration
- 📝 `:memo:` - Documentation
- 🚀 `:rocket:` - Performance
- 🔒 `:lock:` - Security

## 7. ⚠️ Lưu ý quan trọng

### KHÔNG BAO GIỜ commit những file này:
- `wp-config.php` - Chứa thông tin database
- `*.log` - Log files
- `force-setup.php` - Development files
- `.env` - Environment variables

### Nếu đã commit nhầm wp-config.php:
```bash
# Xóa khỏi Git nhưng giữ file local
git rm --cached wp-config.php
git commit -m "🔒 Remove wp-config.php from repository"
git push origin main
```

## 8. 👥 Collaboration

### Clone repository:
```bash
git clone https://github.com/trungtran1211/honghot.git
cd honghot
```

### Pull latest changes:
```bash
git pull origin main
```

### Create feature branch:
```bash
git checkout -b feature/new-popup-design
# Make changes...
git add .
git commit -m "✨ Add new popup design"
git push origin feature/new-popup-design
```

## 9. 🆘 Troubleshooting

### Nếu có conflict:
```bash
git pull origin main
# Resolve conflicts in files
git add .
git commit -m "🔀 Resolve merge conflicts"
git push origin main
```

### Reset về commit trước:
```bash
git log --oneline  # Xem history
git reset --hard <commit-id>  # Reset về commit cụ thể
```

### Xem lịch sử thay đổi:
```bash
git log --oneline --graph
```

---

## 🎯 Quick Commands Cheat Sheet

```bash
# Setup
git init
git remote add origin <repo-url>

# Daily workflow
git status
git add .
git commit -m "message"
git push origin main

# Pull updates
git pull origin main

# Branch work
git checkout -b feature/name
git push origin feature/name

# Emergency
git stash        # Save current work
git stash pop    # Restore saved work
```
