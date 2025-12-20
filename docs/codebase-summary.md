# Codebase Summary - King Express Travel

## Directory Structure

```
kingexpresstravel.com/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # 11 admin controllers
│   │   │   ├── Client/         # 9 client controllers
│   │   │   └── Api/            # API placeholder
│   │   ├── Middleware/         # 4 custom middleware
│   │   └── Requests/           # Form request validation
│   ├── Models/                 # 12 Eloquent models
│   ├── Mail/                   # 3 mailable classes
│   └── View/Components/        # 20 Blade components
├── config/                     # Laravel + custom configs
├── database/
│   ├── migrations/             # Schema definitions
│   └── seeders/                # Sample data
├── resources/
│   ├── views/
│   │   ├── admin/              # Admin panel views
│   │   ├── client/             # Client website views
│   │   ├── components/         # Blade components
│   │   └── mail/               # Email templates
│   ├── css/                    # Stylesheets
│   └── js/                     # JavaScript
├── routes/
│   ├── web.php                 # All web routes (~55)
│   └── api.php                 # API routes
├── public/                     # Public assets
└── docs/                       # Documentation
```

## Key Files by Layer

### Controllers

| Controller | Purpose | Methods |
|------------|---------|---------|
| **Admin** |||
| `AdminBaseController` | Dashboard | index, revenueChart, visitorChart |
| `AdminAuthController` | Auth | login, authenticate, logout |
| `TourController` | Tour CRUD | index, create, store, edit, update, destroy |
| `OrderController` | Order mgmt | index, show, updateStatus, cancel |
| **Client** |||
| `ClientTourController` | Tours | index, show, filter, search |
| `ClientCheckoutController` | Booking | index, store, sendConfirmation |
| `ClientProfileController` | Profile | index, history, update, cancelOrder |
| `GoogleAuthController` | OAuth | redirect, callback |

### Models & Relationships

```
User ──┬── hasMany ──→ Order
       └── via google_id ──→ Google OAuth

Tour ──┬── belongsToMany ──→ Category (pivot: tour_categories)
       └── belongsToMany ──→ Destination (pivot: tour_destinations)

Order ──┬── belongsTo ──→ User
        ├── belongsTo ──→ Tour
        └── hasOne ──→ Payment

Category ──┬── hasMany ──→ News
           └── belongsTo ──→ Category (self-referential parent)
```

### Middleware Pipeline

| Middleware | Applied To | Function |
|------------|-----------|----------|
| `AdminAuthMiddleware` | `/admin/*` | Auth + role=admin check |
| `ClientAuthMiddleware` | Protected client routes | Placeholder (pass-through) |
| `TrackVisitorsMiddleware` | All client routes | Log visitor IP/UA |
| `CustomCKFinderAuth` | CKFinder | Auth bypass (⚠️ insecure) |

### View Components

**Input Components** (18):
- `Text`, `TextArea`, `Select`, `Checkbox`, `Hidden`
- `Editor` (CKEditor integration)
- `ImageLink`, `ImageLinkArray`
- `TourScheduleArray`, `SelectCategory`, `SelectDestination`
- `MenuBar`, `MenuItem`

**Client Components** (5):
- `tour-card`, `tour-search-bar`, `news-card`, `modal`

## Configuration Files

| File | Purpose |
|------|---------|
| `config/ckfinder.php` | CKFinder file browser settings |
| `config/services.php` | Google OAuth credentials |
| `config/mail.php` | SMTP settings |

## Database Seeders

Run order for fresh install:
```bash
php artisan db:seed --class=UserSeeder      # Admin account
php artisan db:seed --class=CategorySeeder  # 5 categories
php artisan db:seed --class=DestinationSeeder # 20 destinations
php artisan db:seed --class=NewsSeeder
php artisan db:seed --class=AboutUsSeeder
php artisan db:seed --class=ContactSeeder
```

Default admin: `root@gmail.com`

## Frontend Assets

### Admin Panel (AdminLTE)
- DataTables for listing pages
- Select2 for dropdowns
- CKEditor 5 for rich text
- Chart.js for dashboard charts
- SortableJS for drag-drop ordering

### Client Website (Tailwind)
- Swiper.js for carousels
- AOS for scroll animations
- SweetAlert2 for modals
- Axios for AJAX requests
- Primary color: `#f59e0b` (amber)

## Email Templates

| Template | Trigger |
|----------|---------|
| `order-confirmation` | After successful booking |
| `email-verification` | New user registration |
| `reset-password` | Password reset request |

---

## File Count Summary

| Directory | Count |
|-----------|-------|
| Controllers | 20 |
| Models | 12 |
| Migrations | ~17 |
| Views | ~50+ |
| Components | 20 |
| Routes | ~55 |
