# System Architecture - King Express Travel

## Tech Stack Overview

| Layer         | Technology          | Details                                             |
| ------------- | ------------------- | --------------------------------------------------- |
| **Framework** | Laravel 12          | PHP 8.2+ Core                                       |
| **Database**  | MySQL / MariaDB     | JSON Column Support                                 |
| **Admin UI**  | AdminLTE 3          | Bootstrap 4, jQuery, CKEditor 5                     |
| **Client UI** | Tailwind CSS        | Alpine.js, Swiper, AOS                              |
| **Auth**      | Session & Socialite | Dual Guards (Web/Admin logic), Google Login         |
| **File Mgr**  | CKFinder 5          | Integration via `ckfinder/ckfinder-laravel-package` |

## Database Schema (ERD)

### Users & Auth

- **users**: `id`, `email`, `password`, `google_id`, `role` ('admin'|'user'), `account_type` (LOCAL/GOOGLE).

### Content Management

- **categories**: Recursive tree (`parent_id`), `type` ('TOUR'|'NEWS').
- **tours**: Core product.
    - `images`: JSON Array.
    - `tour_schedule`: JSON Array of objects `{title, content}`.
    - `price_*`: Multiple pricing tiers (Adult, Child, Toddler, Infant).
- **destinations**: Locations (`name`, `slug`).
- **news**: Blog posts linked to categories.

### Sales & Operations

- **orders**:
    - Status: `PENDING` -> `CONFIRMED` -> `COMPLETED` | `CANCELLED`.
    - `cancellation_reason`: Text (required if cancelled).
- **payments**:
    - Status: `PENDING` -> `SUCCESS` -> `REFUNDED`...
    - `method`: 'Thanh toán tại văn phòng' | 'VNPAY'.

## Request Life Cycle

### 1. Booking Flow

1. **User** visits `/dat-tour/{slug}`.
2. **ClientCheckoutController@store**:
    - Validates input (Anti-bot check via hidden field).
    - Checks `remaining_slots`.
    - Creates `Order` (Pending).
    - Creates `Payment` (Pending).
    - Dispatches `OrderConfirmationMail` to Queue.
3. **System** redirects to Home with Success Flash.

### 2. Admin Processing Flow

1. **Admin** views Order Detail.
2. **Admin** updates Status (`PENDING` -> `CONFIRMED`).
3. **Admin** updates Payment (Manual Transaction ID entry).

### 3. Search & Filter Flow

- **Client Side**: Alpine.js watches inputs.
- **AJAX**: Calls `/du-lich` with query params (`price_from`, `category`, `sort`).
- **Controller**: Returns JSON with rendered Blade partial (`client.tours.partials.tour_list`).
- **Client Side**: Appends HTML to DOM.

## Security & Middleware

| Middleware            | Route         | Function                                                      |
| --------------------- | ------------- | ------------------------------------------------------------- |
| `AdminAuthMiddleware` | `/admin/*`    | Enforces Auth check AND `role === 'admin'`.                   |
| `throttle:2,1`        | `/dat-tour`   | Prevents booking spam (2 requests/min).                       |
| `CustomCKFinderAuth`  | `/ckfinder/*` | **DEV ONLY**: Always returns true. Needs replacement in Prod. |

## File Management Architecture

- Images are stored in `public/userfiles`.
- Paths in DB are relative (e.g., `/userfiles/images/tour1.jpg`).
- Admin uses `x-admin.inputs.image-link` to trigger CKFinder popup and return URL to input field.
