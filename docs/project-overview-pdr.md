# Project Overview - King Express Travel

## Product Summary

**King Express Travel** is a hybrid monolith web application for a Vietnamese travel agency. It combines a high-performance, SEO-friendly client website with a robust internal admin panel.

## Status: V1.0.0 (Development/Staging)

- **Framework**: Laravel 12
- **Last Update**: January 2026

## Core Features Implemented

### 1. Client Website (Frontend)

- **Home Page**: Hero slider, featured tours, popular destinations, stats.
- **Tour Booking**:
    - Filter by Category, Destination, Price, Duration.
    - Detail view with Image Gallery (Swiper), Itinerary (Accordion).
    - Checkout form with Multi-pax pricing (Adult/Child/Toddler/Infant).
- **User System**:
    - Register/Login (Local + Google OAuth).
    - Profile: Update info, Change password.
    - **Booking History**: View orders, Cancel order (if status is Pending).
- **News & Info**: Blog listing, Detail view, About Us, Contact form.

### 2. Admin Panel (Backend)

- **Dashboard**: Chart.js integration for Revenue & Order statistics (Filter by Week/Month/Year).
- **Tour Management**:
    - Full CRUD.
    - **Itinerary Builder**: Dynamic JSON-based schedule builder.
    - **Gallery Manager**: Multiple image selection via CKFinder.
- **Order Management**:
    - Workflow: Pending -> Confirmed -> Completed/Cancelled.
    - Payment status tracking.
- **Content Management**:
    - Category Tree (Nested Sortable).
    - Destinations, News, About Us, Contact Info.
    - Customer Care (Contact form submissions).

## Key Technical Decisions

### 1. No API-First Approach

The project uses Server-Side Rendering (Blade) for SEO benefits and rapid development. API endpoints (`/api/*`) exist only for specific AJAX features like Search Suggestions.

### 2. File Management

**CKFinder 5** is deeply integrated. Images are not stored via standard Laravel Storage `put()`, but managed through the CKFinder interface and referenced by relative URL paths in the database.

### 3. Payment Gateway

Currently, the system uses a **Manual Payment** model or **VNPAY Placeholder**.

- Users select "Office Payment" or "VNPAY".
- Orders are created with `PENDING` payment status.
- Admin manually updates payment status after verifying bank transfer or cash.

## Future Roadmap (To-Do)

1. **Payment Integration**: Implement real VNPAY/Momo IPN callback.
2. **Security**: Replace `CustomCKFinderAuth` with real Admin middleware check.
3. **Caching**: Implement Redis caching for Homepage and Tour Listing to improve performance under load.
4. **Notifications**: Real-time notifications (Pusher) for new orders.
