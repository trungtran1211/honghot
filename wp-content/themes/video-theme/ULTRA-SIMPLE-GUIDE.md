# Video Theme - Ultra Simple Version

## 🎯 Mục tiêu
Theme đã được tối giản tối đa, chỉ giữ lại:
- ✅ Tiêu đề bài viết
- ✅ Nội dung/Description
- ❌ Ngày đăng
- ❌ Tác giả
- ❌ Bình luận
- ❌ Video liên quan
- ❌ Tags
- ❌ Social sharing

## 📱 Giao diện

### Trang chủ (index.php):
```
┌─────────────────────────────────┐
│  [Thumbnail]                    │
│                                 │
│  Tiêu đề bài viết               │
│  Excerpt...                     │
└─────────────────────────────────┘
```

### Trang bài viết (single.php):
```
┌─────────────────────────────────┐
│           TIÊU ĐỀ               │
│                                 │
│  [Featured Image - nếu có]      │
│                                 │
│  Nội dung bài viết...           │
│  <video controls>...            │
│  Tiếp tục nội dung...           │
└─────────────────────────────────┘
```

## 🚀 Cách sử dụng

### 1. Tạo bài viết mới:
- Vào **Posts > Add New**
- Nhập **tiêu đề**
- Thêm **nội dung** (text + video)
- Upload **Featured Image** (optional)
- **Publish**

### 2. Thêm video vào nội dung:
```html
<!-- Cách 1: HTML5 Video với poster -->
<video src="https://cdn.anh.moe/s11/video.mp4" 
       controls 
       poster="https://cdn.anh.moe/s11/poster.jpg"
       style="width: 100%; border-radius: 10px;">
</video>

<!-- Cách 2: YouTube embed -->
<iframe width="100%" height="400" 
        src="https://www.youtube.com/embed/VIDEO_ID"
        frameborder="0" allowfullscreen
        style="border-radius: 10px;">
</iframe>

<!-- Cách 3: Sử dụng WordPress Video Block -->
Chỉ cần thêm Video Block và paste URL hoặc upload file
```

## 🎨 Template Files

### Sử dụng:
- `index.php` - Danh sách bài viết
- `single.php` - Bài viết đơn lẻ  
- `search.php` - Tìm kiếm
- `archive.php` - Archive pages
- `404.php` - Page not found

### Không sử dụng:
- `single-video.php` (đã xóa)
- `archive-video.php` (đã xóa)

## 🎯 CSS Classes

### Grid Layout:
- `.post-grid` - Container danh sách bài viết
- `.post-card` - Card cho mỗi bài viết
- `.post-thumbnail` - Ảnh thumbnail
- `.post-info` - Thông tin bài viết
- `.post-title` - Tiêu đề
- `.post-excerpt` - Excerpt

### Single Post:
- `.single-post` - Container trang single
- `.post-content` - Content wrapper
- `.post-header` - Header với title
- `.post-description` - Nội dung chính

## 💡 Ví dụ bài viết

### Input (Editor):
```
Title: Hướng dẫn làm bánh pizza

Content:
Hôm nay mình sẽ hướng dẫn các bạn cách làm bánh pizza tại nhà một cách đơn giản.

<video src="https://cdn.example.com/pizza-tutorial.mp4" 
       controls 
       poster="https://cdn.example.com/pizza-thumb.jpg"
       style="width: 100%; border-radius: 10px;">
</video>

Bước 1: Chuẩn bị nguyên liệu...
Bước 2: Nhào bột...
```

### Output (Website):
```
┌─────────────────────────────────┐
│     Hướng dẫn làm bánh pizza    │
│                                 │
│  Hôm nay mình sẽ hướng dẫn...   │
│                                 │
│  [████ VIDEO PLAYER ████]       │
│                                 │
│  Bước 1: Chuẩn bị nguyên liệu.. │
│  Bước 2: Nhào bột...            │
└─────────────────────────────────┘
```

## 🔧 Customization

### Thay đổi màu sắc:
```css
/* Trong style.css */
:root {
    --primary-color: #667eea;    /* Màu chính */
    --secondary-color: #764ba2;  /* Màu phụ */
    --text-color: #333;          /* Màu chữ */
    --bg-color: #f8f9fa;         /* Màu nền */
}
```

### Thay đổi kích thước grid:
```css
.post-grid {
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); /* Tăng từ 300px */
    gap: 3rem; /* Tăng từ 2rem */
}
```

## ✨ Tính năng còn lại

### ✅ Có:
- Responsive design
- Grid layout đẹp mắt
- Video tự động responsive
- Search functionality
- Pagination
- Clean typography

### ❌ Không có:
- Comments system
- Post metadata (date, author)
- Related posts
- Social sharing
- Tags/Categories display
- Custom fields UI

## 🎊 Kết luận

Theme giờ đây cực kỳ đơn giản và tập trung vào nội dung chính:
- **Tiêu đề**: Rõ ràng, dễ đọc
- **Nội dung**: Video + text, không phần tử phân tâm
- **Giao diện**: Clean, minimal, professional

Perfect cho content creators muốn focus vào chất lượng nội dung!
