# 📡 MH Contact Button (IoT Endpoint V2.1)

> 🟢 **NODE STATUS: ACTIVE** | ⚡ **LATENCY: ULTRA-LOW** | ⚙️ **FRAMEWORK: WORDPRESS**
>
> Chào mừng đến với module điều khiển tập trung **MH Contact Button**. Tài liệu này mô tả chi tiết kiến trúc, luồng dữ liệu và cách triển khai endpoint giao tiếp siêu nhẹ (lightweight communication endpoint) cho hệ sinh thái WordPress của bạn.

---

## 🛰️ Tổng quan Hệ thống (System Architecture)

**MH Contact Button** đóng vai trò như một *Gateway tương tác* đặt tại frontend của website. Plugin thiết lập các kết nối đa luồng (multi-channel routing) tới người dùng thông qua các giao thức mạng xã hội và viễn thông (Zalo, Messenger, Telegram, Discord, Phone, Email) mà không làm tăng tải (overhead) cho máy chủ (Server).

Phiên bản 2.1 được tối ưu hóa với hiệu năng tương đương một vi điều khiển nhúng: loại bỏ hoàn toàn render-blocking (Zero Bloat), xử lý tác vụ bất đồng bộ cực nhanh và đảm bảo hiển thị chuẩn xác (pixel-perfect) trên mọi thiết bị.

## 🔌 Đặc tả Kỹ thuật (Key Technical Features)

- 📡 **Đa kênh Tín hiệu (Multi-Channel Routing):** Điều hướng nhanh các tín hiệu giao tiếp từ người dùng thẳng đến các nền tảng Zalo, Facebook Messenger, Telegram, Discord, Gọi điện hoặc Email.
- 🔋 **Tối ưu Tài nguyên (Low Footprint):** Mã nguồn thuần túy, không phụ thuộc vào các thư viện bên ngoài (như jQuery hay FontAwesome). Module tiêu thụ cực ít tài nguyên băng thông và CPU của trình duyệt.
- 🔄 **Đồng bộ Hoạt ảnh (DOM Reflow Sync):** Sử dụng kỹ thuật DOM Reflow để đồng bộ chính xác thời gian thực (real-time sync) các hiệu ứng chuyển động (Wave và Shake), mang lại trải nghiệm mượt mà.
- 🎛️ **Giao diện & Tham số (UI/UX Configuration):**
  - Cấu hình vị trí hiển thị (Góc trái hoặc góc phải màn hình) và tùy chỉnh kích thước từ 20px đến 80px.
  - Tùy biến mã màu HEX cho từng kênh liên hệ hoặc thiết lập chế độ hiển thị đơn sắc (Monochrome mode).
- 💾 **Tương thích Bộ nhớ đệm (Cache Compatibility):** Tích hợp module tự động quét các lớp bộ nhớ đệm (LiteSpeed, WP Rocket, W3 Total Cache...) để phát tín hiệu cảnh báo xóa cache khi có thay đổi tham số cấu hình.

## 📦 Triển khai Module (Deployment)

Quá trình flash (cài đặt) module vào hệ thống Core WordPress được thực hiện qua các quy trình tiêu chuẩn:

### ☁️ Phương thức 1: Qua OTA (WP Admin Dashboard)
1. Truy cập vào trung tâm điều khiển (Admin Dashboard).
2. Điều hướng đến **Plugins > Cài đặt mới (Add New)**.
3. Upload gói firmware `.zip` của plugin.
4. Bấm **Cài đặt ngay (Install Now)**, sau đó **Kích hoạt (Activate)** để khởi động module.

### 🛠️ Phương thức 2: Triển khai vật lý qua FTP
1. Giải nén package mã nguồn `mh-contact-button.zip`.
2. Truyền tải thư mục qua giao thức FTP vào đường dẫn `/wp-content/plugins/` trên server.
3. Vào bảng điều khiển, mục **Plugins**, và chọn **Kích hoạt (Activate)**.

## ⚙️ Bảng mạch Điều khiển (Configuration)

Truy cập vào menu **MH Contact** trên thanh bên (sidebar) để cấu hình các tham số:

1. 🎨 **Hiệu chỉnh Tín hiệu (Appearance):**
   - Thiết lập vị trí hiển thị (Trái/Phải) và kích thước.
   - Kích hoạt/Vô hiệu hóa hiệu ứng chuyển động (Wave/Shake).
   - Thiết lập nhãn kêu gọi hành động (Call-To-Action text).
2. 🔗 **Cấu hình Nguồn phát (Channels):** Nhập các tham số định tuyến: Số điện thoại, Email, Số Zalo, ID Messenger, Telegram link, Discord invite.
3. 🌈 **Mã hóa Màu sắc (Color LED):** Tùy chỉnh màu sắc hiển thị cho từng cổng kết nối.
4. 💾 **Lưu Cấu hình (Write to EEPROM):** Bấm lưu và tiến hành **Xóa Cache** nếu hệ thống đang sử dụng plugin lưu trữ đệm.

## 📡 Hỗ trợ Kỹ thuật (Diagnostic & Support)

Nếu hệ thống báo lỗi hoặc có hiện tượng mất kết nối ở bất kỳ endpoint nào, vui lòng mở một "Issue" trên repository này để gửi log dữ liệu (debug log). Các bản vá (patch) sẽ được phát hành trong thời gian sớm nhất.

## 📜 Giấy phép (License)

Mã nguồn được phân phối dưới giấy phép **GPLv2** (hoặc mới hơn) - Tương thích mã nguồn mở hoàn toàn với hệ sinh thái WordPress.
