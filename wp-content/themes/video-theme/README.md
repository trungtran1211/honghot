# Video Theme - WordPress Theme

## Mô tả
Video Theme là một theme WordPress được thiết kế chuyên dụng cho việc xem và quản lý video. Theme có giao diện đơn giản, thân thiện với người dùng và tối ưu cho trải nghiệm xem video.

## Tính năng chính

### 🎬 Hỗ trợ đa dạng loại video
- **YouTube**: Tích hợp trực tiếp video YouTube
- **Vimeo**: Hỗ trợ video Vimeo
- **Direct Link**: Video MP4 trực tiếp

### 🎨 Giao diện đẹp mắt
- Thiết kế hiện đại với gradient màu sắc
- Responsive design cho mọi thiết bị
- Hiệu ứng hover và animation mượt mà
- Grid layout linh hoạt

### 📱 Tối ưu di động
- Responsive design hoàn toàn
- Touch-friendly interface
- Tối ưu tốc độ tải trang

### 🔍 Tính năng tìm kiếm
- Tìm kiếm video nhanh chóng
- Giao diện tìm kiếm đẹp mắt
- Kết quả tìm kiếm chi tiết

## Cài đặt

1. Copy thư mục `video-theme` vào `/wp-content/themes/`
2. Vào WordPress Admin > Appearance > Themes
3. Kích hoạt "Video Theme"

## Sử dụng

### 1. Tạo Video Post
- Vào Admin > Videos > Add New Video
- Điền thông tin video:
  - **Title**: Tiêu đề video
  - **Content**: Mô tả chi tiết
  - **Featured Image**: Ảnh thumbnail
  - **Video URL**: Link video (YouTube, Vimeo hoặc MP4)
  - **Duration**: Thời lượng (phút)
  - **Video Type**: Loại video

### 2. Cấu hình Menu
- Vào Appearance > Menus
- Tạo menu mới và gán cho "Primary Menu"

### 3. Tùy chỉnh Logo
- Vào Appearance > Customize > Site Identity
- Upload logo của bạn

## Cấu trúc Files

```
video-theme/
├── style.css              # CSS chính
├── functions.php          # Functions và hooks
├── index.php             # Trang chủ
├── header.php            # Header
├── footer.php            # Footer
├── single.php            # Single post
├── single-video.php      # Single video
├── archive.php           # Archive pages
├── archive-video.php     # Video archive
├── search.php            # Search results
├── searchform.php        # Search form
├── 404.php              # 404 page
└── js/
    └── main.js          # JavaScript
```

## Custom Fields

Theme tự động tạo các custom fields cho video:
- `_video_url`: URL của video
- `_video_duration`: Thời lượng (phút)
- `_video_type`: Loại video (youtube/vimeo/direct)

## Tối ưu hóa

### SEO
- Hỗ trợ title tag tự động
- Meta description từ excerpt
- Schema markup cho video

### Performance
- CSS và JS được tối ưu
- Lazy loading cho images
- Tối ưu database queries

## Tùy chỉnh CSS

Để tùy chỉnh giao diện, bạn có thể:

1. **Sử dụng WordPress Customizer**
   - Vào Appearance > Customize > Additional CSS

2. **Chỉnh sửa trực tiếp style.css**
   - Sửa file `/wp-content/themes/video-theme/style.css`

### Các CSS Variables chính:
```css
:root {
    --primary-color: #667eea;
    --secondary-color: #764ba2;
    --text-color: #333;
    --bg-color: #f8f9fa;
}
```

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers

## Yêu cầu hệ thống

- WordPress 5.0+
- PHP 7.4+
- MySQL 5.6+

## Changelog

### Version 1.0
- Phát hành ban đầu
- Hỗ trợ YouTube, Vimeo, Direct video
- Responsive design
- Custom post type cho video
- Tính năng tìm kiếm

## Hỗ trợ

Nếu có vấn đề khi sử dụng theme, hãy:
1. Kiểm tra console browser để xem lỗi JavaScript
2. Đảm bảo WordPress và PHP được cập nhật
3. Deactivate các plugin conflict

## Lưu ý

- Để video hiển thị tốt nhất, nên upload thumbnail cho mỗi video
- YouTube và Vimeo URLs sẽ được tự động convert thành embed code
- Theme tối ưu cho việc xem video, không phù hợp cho blog text-heavy

## License

Theme này được phát hành dưới GPL v2 license.
