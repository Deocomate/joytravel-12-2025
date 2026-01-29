# King Express Travel (v1.0.0-2026)

**Hệ thống Quản lý và Kinh doanh Tour Du lịch** - Nền tảng Fullstack Laravel hiện đại dành cho đại lý lữ hành tại Việt Nam.

## 🌟 Tổng quan

King Express Travel là một ứng dụng Hybrid Monolith mạnh mẽ:

- **Client (Frontend):** Giao diện đặt tour công khai, tối ưu SEO, trải nghiệm người dùng mượt mà với Tailwind CSS & Alpine.js.
- **Admin (Backend):** Hệ thống quản trị nội dung (CMS) và xử lý đơn hàng chuyên sâu sử dụng AdminLTE 3.

## 🛠 Tech Stack

| Layer | Công nghệ | Chi tiết |
| --- | --- | --- |
| **Core** | PHP 8.2+, Laravel 12.0 | Service Pattern, Queued Jobs |
| **Database** | MySQL / MariaDB | JSON Columns (Lịch trình, Ảnh), Enum Status |
| **Admin UI** | AdminLTE 3 | Bootstrap 4, jQuery, Select2, SortableJS |
| **Client UI** | Tailwind CSS v3 | Alpine.js, SwiperJS, AOS, Fancybox |
| **File Mgr** | CKFinder 5 | Tích hợp sâu (Popup mode), lưu đường dẫn relative |
| **Auth** | Laravel Auth | Dual Guards, Google OAuth (Socialite) |

## 🚀 Tính năng nổi bật

### Client Website

- **Tìm kiếm thông minh:** Lọc theo điểm đến, mức giá (Slider/Preset), loại hình tour.
- **Đặt tour đa đối tượng:** Tính giá tự động cho Người lớn, Trẻ em, Trẻ nhỏ, Em bé.
- **Tài khoản người dùng:** Đăng nhập Google, Quản lý lịch sử đơn hàng, Hủy tour (có điều kiện).
- **Trải nghiệm:** Gallery ảnh Swiper, Lịch trình tour dạng Accordion, Animations (AOS).

### Admin Panel

- **Dashboard:** Thống kê doanh thu, đơn hàng, khách hàng (Chart.js) theo bộ lọc thời gian.
- **Quản lý Tour:**
  - Builder lịch trình tour động (JSON).
  - Chọn nhiều ảnh thư viện qua CKFinder.
  - Công cụ gán danh mục hàng loạt cho Tour.
- **Quản lý Đơn hàng:** Quy trình xử lý trạng thái (Pending -> Confirmed -> Completed).
- **Quản lý Nội dung:** Cây danh mục đệ quy (Sortable), Tin tức, Điểm đến.

## 📂 Cấu trúc dự án

```text
kingexpresstravel/
├── app/
│   ├── Http/Controllers/   # Controllers (Slim, gọi xuống Service)
│   ├── Models/             # Eloquent Models (Casting JSON, Relations)
│   ├── Services/           # Business Logic Layer
│   │   ├── Admin/          # Logic quản trị (TourService, OrderService...)
│   │   ├── Client/         # Logic client (BookingService, SearchService...)
│   │   └── Common/         # Tiện ích chung (SlugService)
│   └── View/Components/    # Blade Components (Admin Inputs, Client Cards)
├── resources/views/
│   ├── admin/              # AdminLTE Views
│   ├── client/             # Tailwind Views
│   └── components/         # Reusable UI Blocks (x-admin.inputs.*)
└── public/userfiles/       # Kho lưu trữ ảnh (CKFinder)
```

## ⚡ Cài đặt & Triển khai

### Yêu cầu hệ thống

- PHP >= 8.2
- MySQL >= 8.0
- Composer
- Node.js (tùy chọn)

### Các bước cài đặt

1. **Clone Repository**

   ```bash
   git clone [url-repo]
   cd kingexpresstravel
   ```

2. **Cài đặt Dependencies**

   ```bash
   composer install
   npm install && npm run build
   ```

3. **Cấu hình môi trường**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   *Cấu hình DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD trong `.env`*

4. **Database & Seed Data**

   ```bash
   php artisan migrate
   php artisan db:seed
   ```

   *(Tài khoản Admin mặc định: `root@gmail.com` / `password`)*

5. **Storage Link & CKFinder**

   ```bash
   php artisan storage:link
   php artisan ckfinder:download
   ```

6. **Chạy ứng dụng**

   ```bash
   php artisan serve
   php artisan queue:listen # Để gửi email
   ```

## 📝 Quy ước phát triển (Code Standards)

Xem chi tiết tại [`docs/code-standards.md`](./docs/code-standards.md).

- **Admin Forms:** Bắt buộc dùng Blade Components (`x-admin.inputs.text`, `x-admin.inputs.editor`...).
- **Frontend:** Không dùng class Bootstrap. Sử dụng Utility classes của Tailwind.
- **Logic:** Đặt logic nghiệp vụ phức tạp trong `App\Services`.

## 🔒 Security & Middleware

- **Admin:** Route `/admin` được bảo vệ bởi `AdminAuthMiddleware` (check role).
- **Anti-Spam:** Booking form được bảo vệ bởi Honeypot field và Rate Limiting.
- **Files:** `CustomCKFinderAuth` (Dev only) cần được cấu hình lại khi lên Production.

## License

Dự án nội bộ King Express Travel.
