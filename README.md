# MH Contact Button - Phiên bản 2.1

> **Chào mừng bạn đến với tài liệu hướng dẫn của MH Contact Button.** Hướng dẫn này cung cấp cho bạn mọi thông tin cần thiết để cài đặt, cấu hình và khai thác tối đa tiềm năng của plugin MH Contact Button cho hệ sinh thái WordPress của bạn.

---

## 📌 Tổng quan

**MH Contact Button** là một plugin nút liên hệ nổi (floating contact button) nhẹ, tối ưu hoá cao và vô cùng linh hoạt dành riêng cho WordPress, được phát triển bởi **MinhHan**. Với phiên bản 2.1, plugin mang đến trải nghiệm UI/UX hoàn hảo với khả năng đồng bộ hiệu ứng tuyệt đối (DOM Reflow), căn chỉnh trục dọc pixel-perfect, và giao diện chuẩn xác trên thiết bị di động. 

Mục tiêu cốt lõi của plugin là thúc đẩy tương tác khách hàng mà không làm ảnh hưởng đến tốc độ tải trang của hệ thống.

## 🚀 Các tính năng nổi bật

- **Tích hợp Đa Kênh Toàn Diện**: Dễ dàng điều hướng người dùng qua Zalo, Facebook Messenger, Telegram, Discord, Gọi điện trực tiếp (Phone) hoặc Gửi Email.
- **Tối ưu Hiệu Năng (Zero Bloat)**: Không sử dụng thư viện bên ngoài nặng nề. Mã nguồn hoàn toàn tối giản, loại bỏ hoàn toàn render-blocking (chặn hiển thị).
- **Đồng Bộ Hiệu Ứng Tuyệt Đối (DOM Reflow)**: Các hiệu ứng chuyển động (Sóng - Wave, Rung - Shake) được đồng bộ nhịp nhàng một cách hoàn hảo nhờ kỹ thuật xử lý DOM Reflow tiên tiến.
- **Tuỳ Biến Giao Diện Linh Hoạt**: 
  - Chọn vị trí hiển thị (Trái / Phải).
  - Tinh chỉnh kích thước chính xác từ 20px đến 80px.
  - Tuỳ chỉnh màu sắc theo 3 cấp độ: Mặc định, Tối giản (1 màu đồng nhất), hoặc Tuỳ chỉnh riêng biệt cho từng mạng xã hội.
- **Tương Thích Cache Plugin**: Tự động phát hiện và cảnh báo khi hệ thống sử dụng các plugin Cache (LiteSpeed, WP Rocket, W3 Total Cache...) để đảm bảo cập nhật cài đặt mượt mà.

## ⚙️ Hướng dẫn Cài đặt

Để triển khai MH Contact Button vào môi trường WordPress của bạn, vui lòng thực hiện theo các bước tiêu chuẩn sau:

### Phương pháp 1: Qua Bảng điều khiển (Admin Dashboard)
1. Tải về file mã nguồn của plugin dưới định dạng `.zip`.
2. Đăng nhập vào trang quản trị WordPress (Admin Dashboard).
3. Điều hướng tới **Plugins (Gói mở rộng) > Add New (Thêm mới)**.
4. Chọn **Upload Plugin (Tải plugin lên)** và chọn file `.zip` bạn vừa tải về.
5. Bấm **Install Now (Cài đặt ngay)**, sau đó chọn **Activate (Kích hoạt)**.

### Phương pháp 2: Cài đặt Thủ công qua FTP
1. Giải nén file `.zip` của plugin.
2. Tải thư mục chứa mã nguồn (ví dụ: `mh-contact-button`) lên thư mục `/wp-content/plugins/` trên máy chủ của bạn thông qua phần mềm FTP (FileZilla, WinSCP...).
3. Truy cập **Plugins > Installed Plugins (Plugin đã cài đặt)** trong WordPress và chọn **Activate (Kích hoạt)**.

## 🛠️ Cấu hình & Sử dụng

Sau khi kích hoạt, bạn có thể thiết lập các kênh liên hệ của mình như sau:

1. Tìm menu **MH Contact** ở thanh bên trái của bảng quản trị WordPress.
2. **Tùy biến Màu sắc**: Chọn chế độ màu mong muốn (Mặc định, Tối giản, Tuỳ chỉnh).
3. **Giao diện & Hiệu ứng**:
   - Tuỳ chỉnh vị trí (Trái/Phải) và Kích thước nút.
   - Bật/tắt hiệu ứng rung (Shake & Wave).
   - Thiết lập câu kêu gọi hành động (Call-To-Action) như "Liên hệ ngay!".
4. **Cấu hình Liên Hệ**: Nhập thông tin cho các kênh bạn muốn sử dụng:
   - Số điện thoại, Email.
   - Zalo (Nhập SĐT).
   - Messenger (Nhập ID hoặc Username trang).
   - Telegram (Username hoặc đường dẫn).
   - Discord (Đường dẫn mời tham gia server).
5. Nhấp **Lưu Cấu Hình**.
> ⚠️ **Lưu ý Quan trọng:** Nếu bạn đang sử dụng plugin tạo cache, hệ thống sẽ tự động hiển thị thông báo. Hãy nhớ **Xóa Cache (Purge Cache)** sau khi lưu để các thay đổi có hiệu lực ngay lập tức.

## 🤝 Hỗ trợ và Phản hồi

- **Tác giả:** MinhHan - Giảng viên, System Admin & Nhà sáng lập Hân Nguyễn CCTV.
- **Trang chủ:** [minhhan.net](https://minhhan.net)

Nếu bạn gặp bất kỳ vấn đề nào hoặc có đóng góp để cải thiện plugin, vui lòng liên hệ trực tiếp qua trang chủ hoặc mở một issue trên kho lưu trữ GitHub này. Chúng tôi luôn cam kết liên tục cải tiến và nâng cấp chất lượng.

## 📄 Giấy phép (License)

Dự án này được cấp phép theo tiêu chuẩn **GPLv2** (hoặc mới hơn) - tuân thủ hoàn toàn các tiêu chuẩn mã nguồn mở của hệ sinh thái WordPress.
