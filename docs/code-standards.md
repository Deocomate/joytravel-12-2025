# Code Standards - King Express Travel

Tài liệu quy định các chuẩn mực lập trình cho dự án King Express Travel (Laravel 12).

## 1. Kiến trúc chung (Architecture)

### Service Layer Pattern

Logic nghiệp vụ **KHÔNG** được đặt trong Controller. Hãy sử dụng Service classes.

- **Vị trí:** `App\Services\{Module}\{Name}Service.php`
- **Ví dụ:**
  - `App\Services\Admin\TourService`: Xử lý tạo/sửa tour, sync danh mục.
  - `App\Services\Client\BookingService`: Xử lý tính toán giá, tạo đơn hàng, gửi mail.

### Dependency Injection

Sử dụng Constructor Injection để gọi Service hoặc Repository vào Controller.

```php
// ✅ ĐÚNG
public function __construct(private TourService $tourService) {}

// ❌ SAI
$tourService = new TourService();
```

## 2. Admin Development (AdminLTE)

### Blade Components cho Form

Tuyệt đối **KHÔNG** viết thẻ HTML `<input>` thô trong các file view Admin. Phải sử dụng bộ components đã định nghĩa tại `resources/views/components/admin/inputs/`.

| Component | Mục đích | Ví dụ sử dụng |
| --- | --- | --- |
| `x-admin.inputs.text` | Input text cơ bản | `<x-admin.inputs.text name="name" label="Tên" />` |
| `x-admin.inputs.editor` | CKEditor 5 | `<x-admin.inputs.editor name="content" />` |
| `x-admin.inputs.image-link` | CKFinder Popup (1 ảnh) | `<x-admin.inputs.image-link name="thumbnail" />` |
| `x-admin.inputs.tour-schedule-array` | Builder lịch trình tour | `<x-admin.inputs.tour-schedule-array name="tour_schedule" />` |

### Javascript trong Admin

- Sử dụng **jQuery** (đã tích hợp sẵn).
- Đẩy script xuống cuối trang bằng `@push('scripts')`.

## 3. Client Development (Tailwind CSS)

### Styling

- Sử dụng **Tailwind CSS** utility classes.
- Cấu hình màu sắc chính (`primary`, `primary-dark`) nằm trong `app.blade.php` (script config Tailwind).
- **Cấm:** Sử dụng class Bootstrap (`btn`, `row`, `col-...`) trong thư mục `views/client`.

### Interactivity (Alpine.js)

Sử dụng Alpine.js cho các tương tác UI (Dropdown, Modal, Toggle).

```html
<div x-data="{ open: false }">
    <button @click="open = !open">Menu</button>
    <div x-show="open">Content</div>
</div>
```

### AJAX Filtering

Khi lọc danh sách (Tour/News), Controller trả về JSON chứa HTML partial đã render, Frontend append vào DOM. Không reload trang nếu không cần thiết.

## 4. Database & Models

### JSON Casting

Các trường lưu trữ dữ liệu phức tạp phải được cast sang Array/Object trong Model.

```php
protected $casts = [
    'images' => 'array',
    'tour_schedule' => 'array',
    'is_active' => 'boolean',
];
```

### Slug Generation

Sử dụng `App\Services\Common\SlugService` để tạo slug. Không tự viết logic tạo slug trong Controller. Dịch vụ này đảm bảo slug là duy nhất (thêm suffix -1, -2...).

## 5. Naming Conventions

- **Route Name:** `admin.tours.index`, `client.checkout.store` (kebab-case URL, dot-notation name).
- **View Path:** `admin.tours.createOrEdit` (camelCase cho file blade action).
- **Variables:** `$tour`, `$newsItems` (camelCase).
