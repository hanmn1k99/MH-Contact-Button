# MH Contact Button

**MH Contact Button** là một plugin liên hệ đa kênh chuyên nghiệp dành cho WordPress, được thiết kế với tiêu chí tối giản, hiệu năng cao và hoàn toàn không gây cản trở quá trình hiển thị trang (zero render-blocking).

Plugin giúp bạn dễ dàng tạo các nút liên hệ nổi (floating buttons) tích hợp với các nền tảng phổ biến như Zalo, Messenger, Telegram, Discord, Email và Gọi điện thoại trực tiếp.

---

## Tính năng nổi bật

- **Tích hợp Đa Kênh:** Hỗ trợ điều hướng người dùng qua Zalo, Messenger, Telegram, Discord, Phone và Email.
- **Tối ưu Hiệu năng Tuyệt đối:** Mã nguồn nhẹ, không phụ thuộc vào các thư viện bên ngoài như jQuery hay FontAwesome. Đảm bảo tốc độ tải trang nhanh nhất.
- **Hiệu ứng Chuyển động Mượt mà:** Sử dụng kỹ thuật xử lý DOM (DOM Reflow) để đồng bộ chính xác các hiệu ứng chuyển động (Wave, Shake) ở mức pixel-perfect.
- **Tuỳ biến Giao diện Linh hoạt:**
  - Lựa chọn vị trí hiển thị (Góc trái hoặc góc phải màn hình).
  - Tuỳ chỉnh kích thước nút từ 20px đến 80px.
  - Tuỳ biến màu sắc theo 3 chế độ: Mặc định, Tối giản (đồng màu) hoặc Tuỳ chỉnh màu riêng biệt cho từng mạng xã hội.
  - Hỗ trợ thêm tiêu đề kêu gọi hành động (Call-To-Action text).
- **Tương thích hoàn hảo với Plugin Cache:** Tự động phát hiện và cảnh báo xóa cache đối với các plugin lưu trữ đệm phổ biến (LiteSpeed, WP Rocket, W3 Total Cache, v.v.) để đảm bảo cấu hình mới được cập nhật lập tức.

## Hướng dẫn cài đặt

### Cài đặt qua giao diện WordPress
1. Đăng nhập vào trang quản trị WordPress (Admin Dashboard).
2. Chuyển đến **Plugins > Cài đặt mới (Add New)**.
3. Nhấp vào **Tải plugin lên (Upload Plugin)** và chọn file mã nguồn `mh-contact-button.zip` mà bạn đã tải về.
4. Bấm **Cài đặt ngay (Install Now)**, sau đó chọn **Kích hoạt (Activate)**.

### Cài đặt thủ công qua FTP
1. Giải nén file `mh-contact-button.zip`.
2. Tải thư mục chứa mã nguồn lên thư mục `/wp-content/plugins/` trên máy chủ của bạn thông qua phần mềm FTP (FileZilla, WinSCP, v.v.).
3. Truy cập mục **Plugins** trong trang quản trị WordPress và chọn **Kích hoạt (Activate)**.

## Hướng dẫn cấu hình

Sau khi kích hoạt plugin, bạn có thể thiết lập các thông số tại menu **MH Contact** ở thanh bên trái của trang quản trị:

1. **Tuỳ biến Màu sắc:** Lựa chọn chế độ hiển thị màu sắc phù hợp với nhận diện thương hiệu của website.
2. **Giao diện & Hiệu ứng:** Cài đặt vị trí hiển thị, kích thước nút, kích hoạt các hiệu ứng rung và điền đoạn văn bản kêu gọi hành động (Call-To-Action).
3. **Thông tin Liên hệ:** Nhập chính xác các thông tin cho các kênh bạn muốn sử dụng:
   - Số điện thoại, Email.
   - SĐT cho Zalo.
   - ID/Username cho Messenger.
   - Username hoặc đường dẫn Telegram.
   - Đường dẫn lời mời Discord.
4. Nhấp **Lưu cấu hình** để hoàn tất.

> **Lưu ý quan trọng:** Nếu trang web của bạn đang sử dụng plugin tạo cache (như LiteSpeed Cache, WP Rocket,...), vui lòng thực hiện thao tác xóa cache (Purge/Clear Cache) sau khi lưu cấu hình để các thay đổi có hiệu lực ngay lập tức.

## Hỗ trợ và Đóng góp

Nếu bạn có bất kỳ câu hỏi nào hoặc phát hiện lỗi trong quá trình sử dụng, vui lòng mở một "Issue" trên kho lưu trữ GitHub. Các ý kiến đóng góp luôn được trân trọng để không ngừng cải thiện chất lượng plugin.

## Giấy phép (License)

Dự án này được cấp phép theo tiêu chuẩn **GPLv2** (hoặc mới hơn), tuân thủ và tương thích hoàn toàn với hệ sinh thái mã nguồn mở của WordPress.
