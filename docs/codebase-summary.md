# Codebase Summary - King Express Travel

## Directory Structure

```text
kingexpresstravel.com/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # 11 Controllers (Resource & Auth)
│   │   │   ├── Client/         # 9 Controllers (Public Logic)
│   │   │   └── Api/            # 1 Base Controller
│   │   ├── Middleware/         # Auth guards & CKFinder bypass
│   │   └── Requests/           # Form validation
│   ├── Models/                 # 11 Eloquent Models
│   ├── Mail/                   # 3 Mailables (Queue supported)
│   └── View/Components/        # Blade Components logic
│       ├── Admin/              # Inputs & Menus components
│       └── Client/             # UI components (Header, Footer, Cards)
├── config/                     # System configs (ckfinder, auth, mail)
├── database/
│   ├── migrations/             # 4 main migration files
│   └── seeders/                # Database seeders
├── public/
│   ├── client/                 # Client assets (images/cities)
│   └── userfiles/              # CKFinder storage
├── resources/
│   ├── views/
│   │   ├── admin/              # AdminLTE Views
│   │   ├── client/             # Tailwind Views
│   │   ├── components/         # Reusable UI Blocks
│   │   └── mail/               # Email Templates
├── routes/
│   ├── web.php                 # ~50+ Routes (Grouped by Admin/Client)
│   └── console.php             # Artisan commands
└── docs/                       # Project Documentation
```

## Key Components

### 1. Controllers Layout

| Namespace  | Key Controllers                     | Purpose                             |
| ---------- | ----------------------------------- | ----------------------------------- |
| **Admin**  | `TourController`, `OrderController` | Core business logic management      |
|            | `CategoryController`                | Recursive category tree (Tour/News) |
|            | `AdminBaseController`               | Dashboard analytics & Charts        |
| **Client** | `ClientTourController`              | Tour listing, filtering, detail     |
|            | `ClientCheckoutController`          | Booking process & validation        |
|            | `GoogleAuthController`              | Socialite integration               |

### 2. View Components (Blade)

The project heavily relies on Blade Components for standardized UI:

**Admin Inputs (`x-admin.inputs.*`):**

- `Text`, `Email`, `Number`, `Price`, `Time`, `Date`
- `Select`, `SelectSimple`, `SelectMultiple`
- `Editor` (CKEditor 5), `EditorArray`
- `ImageLink` (CKFinder Popup), `ImageLinkArray`
- `TourScheduleArray` (Complex JSON builder)

**Client UI (`x-client.*`):**

- `tour-card`: Displays tour thumbnail, price, rating.
- `news-card`, `news-card-horizontal`: Blog layouts.
- `tour-search-bar`: Floating search with Alpine.js.
- `modal`: Reusable Alpine.js modal.

### 3. Middleware

- `AdminAuthMiddleware`: Protects `/admin` routes, checks `role === 'admin'`.
- `ClientAuthMiddleware`: Placeholder for client-specific logic.
- `CustomCKFinderAuth`: Bypasses CKFinder auth for local dev (Should be secured in prod).

## Database & Models

**Core Models:**

- `Tour`: Uses JSON casting for `images` and `tour_schedule`.
- `Category`: Recursive parent-child relationship.
- `Order`: Links `User` and `Tour`.
- `Payment`: One-to-one with `Order`.

**Key Relationships:**

- Tour `BelongsToMany` Category.
- Tour `BelongsToMany` Destination (ordered by `position`).
- User `HasMany` Order.

## Frontend Technologies

- **Admin:** AdminLTE 3 (Bootstrap 4), jQuery, Select2, Ion.RangeSlider, SortableJS.
- **Client:** Tailwind CSS (v3 CDN), Alpine.js, SwiperJS, AOS (Animate On Scroll).
