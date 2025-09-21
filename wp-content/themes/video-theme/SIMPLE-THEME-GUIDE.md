# Video Theme - Phiên bản đơn giản

## Mô tả
Theme đã được đơn giản hóa để sử dụng với post thường của WordPress thay vì custom post type. Video sẽ được thêm trực tiếp vào nội dung bài viết.

## Tính năng đã xóa

### ❌ Đã loại bỏ:
- Custom post type "Video"
- Meta box "Video Details"
- Các nút chia sẻ social media (Facebook, Twitter, LinkedIn)
- Các thông tin video metadata (duration, views)
- Play button overlay trên thumbnail

### ✅ Còn lại:
- Giao diện đẹp mắt với post cards
- Responsive design
- Tính năng tìm kiếm
- Comments system
- Tags system

## Cách sử dụng

### 1. Tạo bài viết thường
- Vào **Posts > Add New**
- Điền tiêu đề và nội dung
- Upload Featured Image làm thumbnail

### 2. Thêm video vào nội dung
Trong editor, bạn có thể thêm video bằng nhiều cách:

#### Cách 1: HTML5 Video trực tiếp
```html
<video src="https://cdn.anh.moe/s11/i3EmgCit.mp4" 
       controls 
       poster="https://cdn.anh.moe/s11/i3EmgCit.fr.jpeg" 
       style="width: 100%; border-radius: 10px;">
</video>
```

#### Cách 2: YouTube Embed
```html
<iframe width="100%" height="400" 
        src="https://www.youtube.com/embed/VIDEO_ID" 
        frameborder="0" 
        allowfullscreen
        style="border-radius: 10px;">
</iframe>
```

#### Cách 3: Sử dụng WordPress Block Editor
- Thêm **Video Block**
- Upload video file hoặc paste URL
- WordPress sẽ tự động tạo embed code

### 3. Styling tự động
Theme sẽ tự động style các video trong nội dung:
- Video HTML5 và iframe có border-radius đẹp
- Responsive tự động
- Margin phù hợp

## Cấu trúc Theme

### Templates chính:
- `index.php` - Hiển thị danh sách bài viết
- `single.php` - Hiển thị bài viết đơn lẻ
- `search.php` - Kết quả tìm kiếm
- `archive.php` - Trang archive
- `404.php` - Trang lỗi

### Removed files:
- `single-video.php` (không cần thiết)
- `archive-video.php` (không cần thiết)

## CSS Classes

### Post Cards:
- `.post-grid` - Container cho danh sách bài viết
- `.post-card` - Card cho mỗi bài viết
- `.post-thumbnail` - Thumbnail image
- `.post-info` - Thông tin bài viết
- `.post-title` - Tiêu đề bài viết
- `.post-meta` - Metadata (ngày, tác giả)
- `.post-excerpt` - Excerpt

### Single Post:
- `.single-post` - Container trang single
- `.post-content` - Nội dung chính
- `.post-header` - Header với title và meta
- `.post-description` - Nội dung bài viết
- `.post-tags` - Tags

## Ví dụ sử dụng

### Bài viết với video:
1. **Title**: "Hướng dẫn sử dụng WordPress"
2. **Featured Image**: Upload ảnh thumbnail
3. **Content**: 
   ```
   Đây là hướng dẫn chi tiết về WordPress...
   
   <video src="https://example.com/tutorial.mp4" controls poster="https://example.com/thumb.jpg" style="width: 100%; border-radius: 10px;"></video>
   
   Trong video trên, chúng ta đã học...
   ```

### Kết quả:
- Trang chủ: Hiển thị card với thumbnail và excerpt
- Single post: Hiển thị đầy đủ nội dung + video embed
- Video tự động responsive và đẹp mắt

## Lưu ý

### 📝 Content Strategy:
- Sử dụng Featured Image làm thumbnail chính
- Video được nhúng trong nội dung bài viết
- Có thể kết hợp text + video + images

### 🎨 Styling:
- Video trong content tự động có border-radius
- Iframe và video đều responsive
- Không cần custom fields phức tạp

### 🔍 SEO:
- Sử dụng post title và excerpt cho SEO
- Video trong content được index tốt hơn
- Tags hỗ trợ categorization

Theme này giờ đây đơn giản hơn nhiều và dễ sử dụng hơn cho người dùng thông thường!
