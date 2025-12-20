# Project Overview - King Express Travel

## Product Summary

**King Express Travel** is a tour booking and sales management system for Vietnamese travel agency. The platform consists of a public-facing client website for tour browsing/booking and an admin panel for content/order management.

## Tech Stack

| Layer | Technology |
|-------|------------|
| Backend | PHP 8.2, Laravel 12.0 |
| Database | MySQL |
| Frontend (Admin) | AdminLTE 3, Bootstrap 4, jQuery |
| Frontend (Client) | Tailwind CSS, Swiper.js, AOS |
| Auth | Laravel Session, Google OAuth (Socialite) |
| File Upload | CKFinder |
| Email | Laravel Mail (Queued) |

## Core Features

### Client Website
- **Tour Browsing**: List, filter, search tours by destination/category
- **Tour Booking**: Multi-passenger checkout with pricing tiers (adult/child/toddler/infant)
- **User Accounts**: Registration, login, Google OAuth, email verification
- **Profile Management**: View booking history, cancel orders, change password
- **Content Pages**: News/blog, About Us, Contact information

### Admin Panel
- **Dashboard**: Revenue charts, visitor analytics
- **Tour Management**: CRUD with images, schedules, pricing, slot management
- **Order Management**: View, confirm, cancel orders with reason
- **Content Management**: Categories, News, Destinations, Contact branches
- **User Management**: View customers, manage admin accounts

## Business Rules

### Pricing Model
| Passenger Type | Description |
|---------------|-------------|
| Adult | Full price |
| Child | Reduced price |
| Toddler | Lower price tier |
| Infant | Minimal/free |

### Order Status Flow
```
PENDING → CONFIRMED → COMPLETED
    ↓
CANCELLED (with reason)
```

### Payment Status Flow
```
PENDING → SUCCESS
    ↓
FAILED / CANCELLED / REFUNDED
```

## Target Users

1. **Visitors**: Browse tours, view content
2. **Registered Customers**: Book tours, manage profile, view history
3. **Admins**: Full system management access

## URL Structure

| Path | Purpose |
|------|---------|
| `/` | Homepage |
| `/du-lich` | Tour listing |
| `/du-lich/{slug}` | Tour detail |
| `/tin-tuc` | News listing |
| `/dat-tour` | Checkout |
| `/tai-khoan` | Profile |
| `/admin` | Admin dashboard |

## Key Integrations

1. **Google OAuth**: Social login via Laravel Socialite
2. **CKFinder**: File/image management for CKEditor
3. **Email Service**: Order confirmation, password reset, verification

## Rate Limits

| Action | Limit |
|--------|-------|
| Checkout | 2 requests/minute |
| Email Verification | 1 request/5 minutes |

## Deployment Requirements

- PHP 8.2+
- MySQL 8.0+
- Composer
- Node.js (for asset compilation)
- SMTP server for emails
- Google OAuth credentials

---

## Unresolved Questions

1. **CKFinder Auth**: Currently always returns true - needs proper auth implementation
2. **API Layer**: `ApiBaseController` is empty placeholder - future mobile app?
3. **Payment Integration**: Payment model exists but no gateway integration visible
4. **Slot Management**: How are `remaining_slots` decremented on booking?
