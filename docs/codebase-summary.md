# Codebase Summary - King Express Travel

Tóm tắt cấu trúc và các thành phần chính của dự án.

## Directory Structure

```text
kingexpresstravel/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/          # 11 Controllers quản lý (Tour, Order, Category...)
│   │   ├── Client/         # 9 Controllers frontend (Home, Tour, Checkout, Auth...)
│   │   └── Api/            # ApiBaseController (Search Suggestions)
│   ├── Models/             # 12 Models (Tour, Order, Category, Payment...)
│   ├── Services/           # Logic nghiệp vụ tách biệt
│   │   ├── Admin/          # DashboardService, TourService, OrderService...
│   │   ├── Client/         # BookingService, SearchService
│   │   └── Common/         # SlugService, FileService
│   ├── View/Components/    # Logic cho Blade Components
│   │   ├── Admin/Inputs/   # Các input form backend
│   │   └── Client/         # Header, Footer, Cards
│   └── Mail/               # OrderConfirmationMail, ResetPassword, VerifyEmail
├── resources/views/
│   ├── admin/              # Giao diện AdminLTE (Modules: tours, orders, news...)
│   ├── client/             # Giao diện Tailwind (Modules: tours, checkout, profile...)
│   └── components/         # Blade views cho Components
├── routes/
│   └── web.php             # ~60 routes được phân nhóm rõ ràng (Admin/Client/Auth)
└── public/
    └── userfiles/          # Nơi lưu trữ ảnh upload qua CKFinder
```

## Key Components

### 1. Services (Logic Core)

- **BookingService:** Xử lý logic đặt tour, tính tổng tiền, tạo Order & Payment, gửi mail xác nhận.
- **SearchService:** Xử lý bộ lọc tìm kiếm phức tạp (giá, danh mục đệ quy, điểm đến) và tạo query builder.
- **TourService:** CRUD Tour, xử lý lưu JSON lịch trình, sync quan hệ many-to-many (categories, destinations).
- **DashboardService:** Tổng hợp số liệu thống kê cho biểu đồ Chart.js.

### 2. Blade Components quan trọng

- `<x-admin.inputs.tour-schedule-array>`: Component phức tạp nhất, cho phép thêm/xóa ngày lịch trình và tích hợp CKEditor cho từng ngày.
- `<x-admin.inputs.image-link-array>`: Quản lý album ảnh, tích hợp CKFinder popup chọn nhiều ảnh.
- `<x-client.tour-search-bar>`: Thanh tìm kiếm sử dụng Alpine.js, hỗ trợ gợi ý AJAX (autocomplete).

### 3. Database Schema Highlights

- **Categories:** Cấu trúc cây (Parent-Child) với cột `type` (TOUR/NEWS).
- **Tours:** Chứa thông tin giá vé đa tầng (Adult, Child, Toddler, Infant) và dữ liệu JSON cho hình ảnh/lịch trình.
- **Orders:** Liên kết User (nullable) và Tour. Lưu trạng thái đơn hàng và lý do hủy.

## Frontend Technologies

- **Client:** Tailwind CSS v3, Alpine.js (Reactivity), Swiper (Sliders), AOS (Animation).
- **Admin:** AdminLTE 3 (Bootstrap 4), jQuery, Select2, DataTables, SortableJS (Kéo thả lịch trình/danh mục).
