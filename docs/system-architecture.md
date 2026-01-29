# System Architecture - King Express Travel

## Tech Stack Overview

| Layer | Technology | Chi tiết |
| --- | --- | --- |
| **Framework** | Laravel 12 | PHP 8.2+ Core |
| **Database** | MySQL / MariaDB | Hỗ trợ JSON Column |
| **Admin UI** | AdminLTE 3 | Bootstrap 4, jQuery, CKEditor 5 |
| **Client UI** | Tailwind CSS | Alpine.js, Swiper, AOS |
| **Auth** | Session & Socialite | Dual Guards, Google Login |
| **File Mgr** | CKFinder 5 | Package `ckfinder/ckfinder-laravel-package` |

## Database Schema (ERD Highlight)

### Users & Auth

- `users`: `id`, `email`, `password`, `google_id`, `role` ('admin'|'user'), `account_type` (LOCAL/GOOGLE).

### Content Management

- `categories`: `parent_id` (Đệ quy), `type` (Enum: TOUR/NEWS), `priority`.
- `tours`:
  - `images`: JSON Array (Lưu đường dẫn ảnh).
  - `tour_schedule`: JSON Array (Cấu trúc: `[{title, content}, ...]`).
  - `price_*`: Các cột giá riêng biệt cho từng đối tượng.
- `destinations`: `name`, `slug`. Bảng trung gian `tour_destinations` có cột `position` để sắp xếp thứ tự điểm đến trong 1 tour.

### Sales & Operations

- `orders`:
  - `status`: PENDING -> CONFIRMED -> COMPLETED | CANCELLED.
  - `cancellation_reason`: Text (Bắt buộc nếu hủy).
- `payments`: Quan hệ 1-1 với Orders.
  - `status`: PENDING -> SUCCESS -> FAILED...
  - `method`: 'Thanh toán tại văn phòng' | 'VNPAY'.

## Request Life Cycle

### 1. Luồng Đặt Tour (Booking Flow)

1. **User** submit form tại `/dat-tour/{slug}`.
1. **ClientCheckoutController** gọi `BookingService`.
1. **BookingService**:

    - Validate số lượng chỗ còn trống (`remaining_slots`).
    - Tính toán tổng tiền (`total_price`).
    - DB Transaction: Tạo `Order` (Pending) -> Tạo `Payment` (Pending).
    - Gửi email: Dispatch `OrderConfirmationMail` vào Queue.

1. Redirect user về Home với thông báo thành công.

### 2. Luồng Tìm kiếm & Lọc (Search Flow)

1. **Client** thay đổi bộ lọc (Giá, Danh mục...). Alpine.js detect sự kiện.
1. **AJAX Request** gửi tới `/du-lich` với query params.
1. **ClientTourController** gọi `SearchService` để build query Eloquent.
1. **Controller** trả về JSON: `{ html: 'rendered_blade_string', next_page_url: '...' }`.
1. **Client** (JS) cập nhật DOM mà không reload trang.

## Security & Middleware

- `AdminAuthMiddleware`: Bảo vệ tất cả routes `/admin/*`. Kiểm tra `Auth::check()` và `user->role === 'admin'`.
- `throttle:2,1`: Áp dụng cho route POST `/dat-tour` để chống spam booking.
- `CustomCKFinderAuth`: Middleware (hiện tại trong Dev) bypass authentication của CKFinder. **Cần thay thế bằng logic check quyền Admin khi lên Production.**

## File Management Architecture

- Hình ảnh được lưu trong `public/userfiles`.
- Database chỉ lưu đường dẫn tương đối (ví dụ: `/userfiles/images/tour1.jpg`).
- Admin sử dụng Component `x-admin.inputs.image-link` để gọi popup CKFinder và trả URL về input field.
