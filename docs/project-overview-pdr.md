# Project Overview - King Express Travel

## Thông tin dự án

- **Tên dự án:** King Express Travel Booking System
- **Phiên bản:** v1.0.0 (Release 2026)
- **Mô hình:** Hybrid Monolith (Laravel 12 + Blade Rendering)

## Mục tiêu sản phẩm

Xây dựng nền tảng bán tour du lịch nội địa chuyên nghiệp, tối ưu hóa quy trình từ lúc khách hàng tìm kiếm tour đến khi quản trị viên xác nhận và xử lý đơn hàng.

## Tính năng cốt lõi (Core Features)

### 1. Phía Khách hàng (Client)

- **Trang chủ:** Hero slider, Tour nổi bật, Điểm đến phổ biến, Thống kê động.
- **Tìm kiếm & Đặt tour:**
  - Bộ lọc AJAX (không load lại trang) theo giá, danh mục, điểm đến.
  - Gợi ý tìm kiếm (Search Suggestions) qua API.
  - Form đặt tour chi tiết: Tính toán giá theo số lượng người lớn/trẻ em.
- **Hệ thống thành viên:**
  - Đăng ký/Đăng nhập (Local + Google OAuth).
  - Quản lý hồ sơ: Đổi avatar, đổi mật khẩu.
  - **Quản lý đơn hàng:** Xem lịch sử, Hủy đơn hàng (nếu đang ở trạng thái Chờ xử lý).
- **Nội dung:** Blog tin tức, Trang giới thiệu, Form liên hệ (gửi về Admin).

### 2. Phía Quản trị (Admin)

- **Dashboard:** Biểu đồ doanh thu/đơn hàng theo tuần/tháng/năm (Chart.js).
- **Quản lý Tour:**
  - Tạo/Sửa tour với đầy đủ thông tin SEO, giá vé, lịch trình chi tiết.
  - Công cụ "Thêm danh mục hàng loạt" cho các tour theo từ khóa tên.
- **Quản lý Đơn hàng:**
  - Xem chi tiết, cập nhật trạng thái (Xác nhận, Hoàn thành, Hủy).
  - Cập nhật trạng thái thanh toán (Thủ công).
- **CMS:** Quản lý Danh mục (kéo thả sắp xếp), Tin tức, Điểm đến, Thông tin công ty.

## Quyết định kỹ thuật (Technical Decisions)

### 1. Service Layer Pattern

Dự án tách biệt logic nghiệp vụ ra khỏi Controller. Controller chỉ đóng vai trò điều phối (nhận request -> gọi service -> trả response). Điều này giúp code dễ bảo trì và mở rộng.

### 2. JSON Storage

Sử dụng cột JSON trong MySQL để lưu trữ:

- **Album ảnh tour:** Thay vì bảng quan hệ 1-n, giúp truy xuất nhanh hơn.
- **Lịch trình tour:** Cấu trúc mảng linh động, dễ dàng render ở frontend.

### 3. CKFinder Integration

Không sử dụng `Storage::put` mặc định của Laravel cho nội dung bài viết/tour. Tích hợp CKFinder 5 để quản lý file tập trung, cho phép tái sử dụng hình ảnh và quản lý thư mục trực quan.

### 4. Frontend Architecture

Sử dụng **Alpine.js** thay vì Vue/React để giữ sự đơn giản của Blade template nhưng vẫn đảm bảo tính tương tác cao (Dropdown, Modal, Search box) mà không cần build step phức tạp.
