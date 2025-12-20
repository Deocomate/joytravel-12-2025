# King Express Travel

**Tour Sales Management System** - A full-stack Laravel application for Vietnamese travel agency operations.

## Overview

King Express Travel provides a complete tour booking ecosystem with:
- **Client Website**: Public-facing tour browsing, booking, and user accounts
- **Admin Panel**: Content management, order processing, and analytics

## Tech Stack

| Layer | Technology |
|-------|------------|
| Backend | PHP 8.2, Laravel 12.0 |
| Database | MySQL 8.0 |
| Admin UI | AdminLTE 3, Bootstrap 4, jQuery |
| Client UI | Tailwind CSS, Swiper.js, AOS |
| Auth | Laravel Session, Google OAuth (Socialite) |
| Rich Text | CKEditor 5 + CKFinder |
| Email | Laravel Mail (Queued) |

## Features

### Client Website
- Tour browsing with filters (destination, category, price)
- Multi-passenger booking (adult/child/toddler/infant pricing)
- User authentication (local + Google OAuth)
- Profile management & booking history
- News/Blog section, About Us, Contact pages

### Admin Panel
- Dashboard with revenue & visitor analytics
- Tour CRUD with image galleries & itinerary builder
- Order management with status workflow
- Category tree management (for Tours & News)
- User & destination management

## Project Structure

```
kingexpresstravel.com/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/      # 11 admin controllers
│   │   └── Client/     # 9 client controllers
│   ├── Models/         # 12 Eloquent models
│   ├── Mail/           # 3 queued mailables
│   └── View/Components/ # 20 Blade components
├── database/
│   ├── migrations/     # Schema definitions
│   └── seeders/        # Sample data
├── resources/views/
│   ├── admin/          # Admin panel views
│   ├── client/         # Client website views
│   └── components/     # Reusable Blade components
├── routes/
│   └── web.php         # ~55 route definitions
├── docs/               # Project documentation
└── public/             # Public assets
```

## Quick Start

### Prerequisites
- PHP 8.2+
- Composer
- MySQL 8.0+
- Node.js (optional, for asset compilation)

### Installation

```bash
# Clone repository
git clone [repository_url]
cd kingexpresstravel.com

# Install dependencies
composer install

# Environment setup
cp .env.example .env
php artisan key:generate

# Configure database in .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=king_express_travel
DB_USERNAME=root
DB_PASSWORD=your_password

# Run migrations & seeders
php artisan migrate
php artisan db:seed

# Create storage symlink
php artisan storage:link

# Start development server
php artisan serve
```

### Development Mode

```bash
# Run server, queue worker, and Vite simultaneously
composer dev
```

## Default Credentials

| Role | Email | Notes |
|------|-------|-------|
| Admin | root@gmail.com | Created by UserSeeder |

## URL Structure

| Path | Description |
|------|-------------|
| `/` | Homepage |
| `/du-lich` | Tour listings |
| `/du-lich/{slug}` | Tour details |
| `/dat-tour/{slug}` | Checkout |
| `/tin-tuc` | News/Blog |
| `/tai-khoan` | User profile |
| `/admin` | Admin dashboard |

## Database Schema

### Core Tables
- `users` - User accounts (local + OAuth)
- `tours` - Tour products with pricing tiers
- `orders` - Booking orders
- `payments` - Payment transactions
- `categories` - Hierarchical categories (TOUR/NEWS)
- `destinations` - Travel locations
- `news` - Blog articles

### Relationships
```
User ──1:N── Order ──1:1── Payment
Tour ──M:N── Category (via tour_categories)
Tour ──M:N── Destination (via tour_destinations)
Category ──1:N── News
Category ──self── Category (parent-child)
```

## Environment Variables

### Required
```ini
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=king_express_travel
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_FROM_ADDRESS=noreply@kingexpress.vn
```

### Google OAuth (Optional)
```ini
GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
```

## Documentation

Detailed documentation available in [`docs/`](./docs/):

- [`project-overview-pdr.md`](./docs/project-overview-pdr.md) - Project overview & product requirements
- [`codebase-summary.md`](./docs/codebase-summary.md) - File structure & key components
- [`code-standards.md`](./docs/code-standards.md) - Coding conventions & patterns
- [`system-architecture.md`](./docs/system-architecture.md) - System design & database schema

## Order Status Workflow

```
PENDING ──► CONFIRMED ──► COMPLETED
    │
    └──► CANCELLED (with reason)
```

## API Endpoints

### Search
- `GET /api/search-suggestions` - Tour search autocomplete
- `GET /api/destination-suggestions` - Destination autocomplete

### Rate Limits
- Checkout: 2 requests/minute
- Email verification: 1 request/5 minutes

## Testing

```bash
# Run test suite
composer test

# Or directly
php artisan test
```

## Artisan Commands

```bash
# Clear all caches
php artisan optimize:clear

# Regenerate IDE helper
php artisan ide-helper:generate

# Queue worker
php artisan queue:work
```

## Known Limitations

1. **CKFinder Auth**: Currently bypasses authentication - needs security hardening for production
2. **API Layer**: `ApiBaseController` is placeholder for future mobile app
3. **Payment Gateway**: Manual payment confirmation only - no integrated payment provider
4. **Caching**: No Redis/cache implementation for high-traffic optimization

## Contributing

1. Follow coding standards in [`docs/code-standards.md`](./docs/code-standards.md)
2. Use Vietnamese slugs for client-facing URLs
3. Write queued mailables for all email functionality
4. Use Blade components for reusable UI elements

## License

MIT License
