# System Architecture - King Express Travel

## High-Level Architecture

```
┌─────────────────────────────────────────────────────────────┐
│                        CLIENTS                              │
├─────────────────────────┬───────────────────────────────────┤
│   Client Website        │         Admin Panel               │
│   (Tailwind CSS)        │         (AdminLTE 3)              │
└───────────┬─────────────┴───────────────┬───────────────────┘
            │                             │
            ▼                             ▼
┌─────────────────────────────────────────────────────────────┐
│                    Laravel 12 Application                   │
├─────────────────────────────────────────────────────────────┤
│  Routes → Middleware → Controllers → Models → Views         │
├─────────────────────────────────────────────────────────────┤
│  Session Auth │ Google OAuth │ Queued Emails │ CKFinder     │
└───────────────────────────┬─────────────────────────────────┘
                            │
                            ▼
┌─────────────────────────────────────────────────────────────┐
│                        MySQL Database                       │
│  Users │ Tours │ Orders │ Payments │ Categories │ News      │
└─────────────────────────────────────────────────────────────┘
```

## Database Schema

### Entity Relationship Diagram

```
┌──────────────┐     ┌──────────────┐     ┌──────────────┐
│    users     │     │    tours     │     │  categories  │
├──────────────┤     ├──────────────┤     ├──────────────┤
│ id           │     │ id           │     │ id           │
│ name         │     │ tour_code    │     │ name         │
│ email        │     │ name         │     │ slug         │
│ password     │     │ slug         │     │ type (ENUM)  │
│ role         │◄────│ duration     │     │ parent_id    │──┐
│ google_id    │     │ price_adult  │     │ is_active    │  │
│ account_type │     │ price_child  │     └──────────────┘  │
└──────┬───────┘     │ remaining    │            ▲          │
       │             │ images (JSON)│            │          │
       │             │ schedule(JSON)│           │ self-ref │
       │             └──────┬───────┘            └──────────┘
       │                    │
       │    ┌───────────────┼───────────────┐
       │    │               │               │
       │    ▼               ▼               ▼
       │ ┌────────────┐ ┌────────────┐ ┌────────────────┐
       │ │tour_categories│ │tour_destinations│ │ destinations │
       │ ├────────────┤ ├────────────┤ ├────────────────┤
       │ │ tour_id    │ │ tour_id    │ │ id             │
       │ │ category_id│ │ destination│ │ name           │
       │ └────────────┘ │ position   │ │ slug           │
       │                └────────────┘ └────────────────┘
       │
       ▼
┌──────────────┐     ┌──────────────┐
│    orders    │     │   payments   │
├──────────────┤     ├──────────────┤
│ id           │     │ id           │
│ user_id      │────►│ order_id     │
│ tour_id      │     │ method       │
│ departure    │     │ transaction  │
│ status       │     │ amount       │
│ total_price  │     │ status       │
│ cancel_reason│     └──────────────┘
└──────────────┘
```

### Status Enumerations

```
Order Status:    PENDING → CONFIRMED → COMPLETED
                    │
                    └─→ CANCELLED

Payment Status:  PENDING → SUCCESS
                    │
                    ├─→ FAILED
                    ├─→ CANCELLED
                    └─→ REFUNDED

Category Type:   TOUR | NEWS
```

## Authentication Flow

### Session-Based Auth (Default)

```
┌────────┐    POST /login     ┌────────────┐
│ Client │ ─────────────────► │ AuthController │
└────────┘                    └──────┬─────┘
                                     │
                              validate credentials
                                     │
                                     ▼
                              ┌──────────────┐
                              │ Create Session │
                              └──────┬───────┘
                                     │
                              ┌──────▼───────┐
    Set session cookie ◄───── │ Redirect Home │
                              └──────────────┘
```

### Google OAuth Flow

```
┌────────┐   /auth/google    ┌──────────────┐   redirect   ┌────────┐
│ Client │ ────────────────► │ GoogleAuth   │ ───────────► │ Google │
└────────┘                   │ Controller   │              │ OAuth  │
                             └──────────────┘              └───┬────┘
                                    ▲                          │
                                    │ callback                 │
                                    └──────────────────────────┘
                                              │
                                    ┌─────────▼─────────┐
                                    │ Find/Create User  │
                                    │ (by google_id)    │
                                    └─────────┬─────────┘
                                              │
                                    ┌─────────▼─────────┐
                                    │ Auth::login()     │
                                    └───────────────────┘
```

### Admin Authorization

```
Request → AdminAuthMiddleware
              │
              ├── Not authenticated? → Redirect /login
              │
              ├── Auth but role != admin? → Abort 403
              │
              └── Auth + admin role → Continue to Controller
```

## API Structure

### Public Endpoints

| Method | Endpoint | Purpose |
|--------|----------|---------|
| GET | `/api/search` | Tour search |
| GET | `/api/filter` | Tour filter |
| GET | `/du-lich` | Tour listing |
| GET | `/du-lich/{slug}` | Tour detail |
| GET | `/tin-tuc` | News listing |

### Protected Endpoints (Client)

| Method | Endpoint | Auth | Purpose |
|--------|----------|------|---------|
| POST | `/dat-tour` | ✓ | Create booking |
| GET | `/tai-khoan` | ✓ | User profile |
| GET | `/lich-su-dat-tour` | ✓ | Booking history |
| POST | `/huy-dat-tour/{id}` | ✓ | Cancel order |

### Admin Endpoints

| Method | Endpoint | Purpose |
|--------|----------|---------|
| GET | `/admin` | Dashboard |
| GET | `/admin/tours` | Tour list |
| POST | `/admin/tours` | Create tour |
| PUT | `/admin/tours/{id}` | Update tour |
| DELETE | `/admin/tours/{id}` | Delete tour |
| POST | `/admin/orders/{id}/status` | Update order status |

## Request/Response Flow

### Booking Flow

```
1. User browses /du-lich
   └─► ClientTourController@index → Tour list view

2. User views /du-lich/{slug}
   └─► ClientTourController@show → Tour detail view

3. User submits booking
   └─► ClientCheckoutController@store
       ├─► Validate input (rate limit: 2/min)
       ├─► Create Order (status: PENDING)
       ├─► Create Payment (status: PENDING)
       ├─► Queue OrderConfirmationMail
       └─► Redirect with success message

4. Admin confirms order
   └─► AdminOrderController@updateStatus
       └─► Update Order (status: CONFIRMED)
```

## Middleware Stack

```
Global Middleware
    │
    ├── TrackVisitorsMiddleware (client routes)
    │       └── Log IP, User-Agent, URL
    │
    ├── Web Middleware Group
    │       ├── EncryptCookies
    │       ├── Session
    │       ├── VerifyCsrfToken
    │       └── SubstituteBindings
    │
    ├── Auth Middleware (protected routes)
    │
    └── AdminAuthMiddleware (admin routes)
            └── Check auth + role=admin
```

## Email Queue Architecture

```
┌──────────────┐    dispatch    ┌─────────────┐    process    ┌──────────┐
│ Controller   │ ─────────────► │ Queue (DB)  │ ─────────────► │ Mail     │
│              │                │             │                │ Driver   │
└──────────────┘                └─────────────┘                └──────────┘
                                      │
                                      ▼
                              ┌───────────────┐
                              │ jobs table    │
                              └───────────────┘

Mailable Classes:
├── OrderConfirmationMail (ShouldQueue)
├── ResetPasswordMail (ShouldQueue)
└── VerifyEmail (ShouldQueue)
```

---

## Unresolved Questions

1. **Payment Gateway**: No external payment integration visible - manual confirmation only?
2. **Slot Decrement**: When/how does `remaining_slots` decrease after booking?
3. **CKFinder Security**: Auth middleware always returns true - production risk
4. **API Authentication**: Empty API controller - future JWT/Sanctum implementation?
5. **Caching Strategy**: No Redis/cache implementation visible for high-traffic pages
