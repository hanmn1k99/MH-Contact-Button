# 📡 MH Contact Button (IoT Endpoint V2.1)

> **[NODE STATUS: ACTIVE]** | **[LATENCY: ULTRA-LOW]** | **[FRAMEWORK: WORDPRESS]**
>
> Chào mừng đến với module điều khiển tập trung **MH Contact Button**. Tài liệu này mô tả chi tiết kiến trúc, luồng dữ liệu và cách triển khai endpoint giao tiếp siêu nhẹ (lightweight communication endpoint) cho hệ sinh thái WordPress của bạn.

---

## 🛰️ Kiến Trúc Hệ Thống (Overview)

**MH Contact Button** đóng vai trò như một *Gateway tương tác* đặt tại frontend của website. Nó thiết lập các kết nối đa luồng (multi-channel routing) tới người dùng thông qua các giao thức mạng xã hội và viễn thông (Zalo, Messenger, Telegram, Discord, Phone, Email) mà không làm tăng tải (overhead) cho máy chủ (Server).

Được phát triển bởi **MinhHan**, phiên bản 2.1 được tối ưu hóa như một vi điều khiển nhúng: loại bỏ hoàn toàn render-blocking (Zero Bloat), xử lý tác vụ bất đồng bộ cực nhanh và đạt chuẩn pixel-perfect trên mọi giao diện (Edge devices).

## 🔌 Đặc Tả Kỹ Thuật (Key Features)

- **Đa Kênh Tín Hiệu (Multi-Channel Telemetry):** Định tuyến nhanh (routing) tín hiệu giao tiếp từ người dùng thẳng đến các nền tảng: Zalo, Facebook Messenger, Telegram, Discord, Gọi điện hoặc Email.
- **Tối Ưu Tài Nguyên (Low Energy & Zero Bloat):** Mã nguồn thuần túy, không "kéo" thêm thư viện nặng (như jQuery hay FontAwesome). Tương tự việc tối ưu RAM trên thiết bị IoT, module này tiêu thụ cực ít tài nguyên băng thông.
- **Đồng Bộ Hoạt Ảnh (DOM Reflow Sync):** Sử dụng vi thao tác DOM Reflow để đồng bộ chính xác (real-time sync) các dao động sóng (Wave) và rung (Shake), tạo phản hồi xúc giác/thị giác chuẩn xác.
- **Giao Diện & Sensor (UI/UX Configuration):**
  - Định vị tọa độ tuyệt đối (Trái/Phải, kích thước 20px - 80px).
  - Tùy biến mã màu HEX cho từng "sensor" (Zalo, Messenger...) hoặc thiết lập chế độ hiển thị đơn sắc (Monochrome mode).
- **Tương Thích Firmware (Cache Compatibility):** Tích hợp cảm biến tự động quét các lớp bộ nhớ đệm (LiteSpeed, WP Rocket, W3 Total Cache...) để phát tín hiệu cảnh báo xóa cache khi có thay đổi tham số cấu hình.

## 📦 Triển Khai Module (Deployment)

Việc flash (cài đặt) module này vào hệ thống (Core) được thực hiện qua các quy trình tiêu chuẩn:

### Cách 1: Flash qua OTA (WP Admin Dashboard)
1. Truy cập vào trung tâm điều khiển (Admin Dashboard).
2. Điều hướng đến **Plugins > Add New**.
3. Upload gói firmware `.zip`.
4. Bấm **Install Now**, sau đó **Activate** để cấp nguồn cho module.

### Cách 2: Triển khai vật lý qua FTP (Direct Upload)
1. Giải nén package mã nguồn.
2. Transfer thư mục `mh-contact-button` qua giao thức FTP vào đường dẫn `/wp-content/plugins/` trên server.
3. Vào bảng điều khiển, mục **Plugins**, và chọn **Activate**.

## ⚙️ Bảng Mạch Điều Khiển (Configuration)

Truy cập vào menu **MH Contact** trên sidebar để cấu hình tham số:

1. **Hiệu Chỉnh Tín Hiệu (Appearance):**
   - Đặt tọa độ X/Y (Trái/Phải).
   - Bật/tắt Trigger chuyển động (Wave/Shake).
   - Thiết lập nhãn tín hiệu (Call-To-Action text).
2. **Cấu Hình Nguồn Phát (Channels):** Nhập các tham số định tuyến (SĐT, ID Messenger, Telegram link, Discord invite).
3. **Mã Hóa Màu Sắc (Color LED):** Tùy chỉnh màu sắc hiển thị cho từng cổng kết nối.
4. **Lưu Cấu Hình (Write to EEPROM):** Bấm lưu và tiến hành **Xóa Cache** nếu hệ thống đang sử dụng plugin lưu trữ đệm.

## 📡 Diagnostic & Support (Hỗ Trợ)

- **Kỹ Sư Trưởng:** MinhHan - System Admin / Hân Nguyễn CCTV.
- **Trạm Điều Khiển:** [minhhan.net](https://minhhan.net)

Nếu hệ thống báo lỗi hoặc có hiện tượng mất kết nối ở bất kỳ endpoint nào, vui lòng mở một issue trên repository này để gửi log dữ liệu (debug log). Chúng tôi sẽ update patch firmware trong thời gian sớm nhất.

## 📜 Giấy Phép (License)

Mã nguồn được phân phối dưới giấy phép **GPLv2** (hoặc mới hơn) - Tương thích mã nguồn mở hoàn toàn.
