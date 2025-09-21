# Hướng dẫn sử dụng HTML5 Video với Poster

## Cách thêm video HTML5 với poster image

### Bước 1: Tạo Video Post mới
1. Vào **WordPress Admin** > **Videos** > **Add New Video**
2. Điền tiêu đề video

### Bước 2: Cấu hình Video Details
Trong phần **Video Details**, điền các thông tin sau:

#### Video URL:
```
https://cdn.anh.moe/s11/i3EmgCit.mp4
```
*Đây là link trực tiếp đến file video MP4*

#### Video Poster (Thumbnail URL):
```
https://cdn.anh.moe/s11/i3EmgCit.fr.jpeg
```
*Đây là link đến ảnh thumbnail sẽ hiển thị trước khi phát video*

#### Video Type:
Chọn **"HTML5 Video với Poster"**

#### Duration:
Nhập thời lượng video (tính bằng phút)

### Kết quả
Theme sẽ tự động tạo ra mã HTML như sau:
```html
<video src="https://cdn.anh.moe/s11/i3EmgCit.mp4" 
       controls 
       poster="https://cdn.anh.moe/s11/i3EmgCit.fr.jpeg" 
       width="100%" 
       height="500" 
       preload="metadata">
    Your browser does not support the video tag.
</video>
```

## Tính năng của HTML5 Video

### ✅ Ưu điểm:
- **Tải nhanh**: Video được tải trực tiếp, không qua bên thứ 3
- **Poster image**: Hiển thị ảnh thumbnail đẹp mắt
- **Controls tùy chỉnh**: Người dùng có thể điều khiển video
- **Preload metadata**: Tải sẵn thông tin video để phát nhanh
- **Responsive**: Tự động thích ứng với mọi thiết bị

### 🎨 Giao diện:
- Video player có border radius đẹp mắt
- Poster image hiển thị khi chưa phát
- Controls được style đẹp với CSS

### 📱 Tương thích:
- Chrome, Firefox, Safari, Edge
- Mobile browsers
- Tablet và Desktop

## Các loại Video được hỗ trợ

### 1. HTML5 Video với Poster (Mới)
```
Video URL: https://cdn.anh.moe/s11/video.mp4
Poster URL: https://cdn.anh.moe/s11/poster.jpeg
Type: HTML5 Video với Poster
```

### 2. YouTube
```
Video URL: https://www.youtube.com/watch?v=VIDEO_ID
Type: YouTube
```

### 3. Vimeo
```
Video URL: https://vimeo.com/VIDEO_ID
Type: Vimeo
```

### 4. Direct MP4 (Không có poster)
```
Video URL: https://example.com/video.mp4
Type: Direct Link (MP4)
```

## Lưu ý quan trọng

### 🔗 URL Requirements:
- **Video URL**: Phải là link trực tiếp đến file .mp4, .webm, .ogg
- **Poster URL**: Phải là link trực tiếp đến file ảnh (.jpg, .jpeg, .png, .webp)
- Cả hai URL phải accessible từ internet

### 📐 Kích thước khuyến nghị:
- **Video**: 1920x1080 (Full HD) hoặc 1280x720 (HD)
- **Poster**: Cùng tỷ lệ với video (16:9)

### ⚡ Performance:
- Sử dụng `preload="metadata"` để tải nhanh
- Video sẽ chỉ tải khi người dùng click play
- Poster image hiển thị ngay lập tức

## Troubleshooting

### Video không phát:
1. Kiểm tra URL video có đúng không
2. Đảm bảo server host video hỗ trợ CORS
3. Thử format video khác (.mp4, .webm)

### Poster không hiển thị:
1. Kiểm tra URL poster image
2. Đảm bảo file ảnh accessible
3. Thử format ảnh khác (.jpg, .png)

### Video lag hoặc tải chậm:
1. Tối ưu file video (compress)
2. Sử dụng CDN cho video
3. Kiểm tra bandwidth server
