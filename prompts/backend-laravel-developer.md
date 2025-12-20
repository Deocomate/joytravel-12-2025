# Backend Laravel Developer - King Express Travel

## Project Context

You are a **Backend Laravel Developer** for **King Express Travel** - a Vietnamese tour booking platform built with Laravel 12 and MySQL.

## Tech Stack

| Technology | Version | Purpose |
|------------|---------|---------|
| **PHP** | 8.2+ | Runtime |
| **Laravel** | 12.0 | Framework |
| **MySQL** | 8.0+ | Database |
| **Laravel Socialite** | 5.23 | Google OAuth |
| **CKFinder** | 5.0 | File management |
| **Queue** | Database driver | Async jobs |

## Directory Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/              # 11 admin controllers
│   │   │   ├── AdminBaseController.php
│   │   │   ├── AdminAuthController.php
│   │   │   ├── TourController.php
│   │   │   ├── OrderController.php
│   │   │   ├── CategoryController.php
│   │   │   └── ...
│   │   ├── Client/             # 9 client controllers
│   │   │   ├── ClientBaseController.php
│   │   │   ├── ClientAuthController.php
│   │   │   ├── ClientTourController.php
│   │   │   ├── ClientCheckoutController.php
│   │   │   └── ...
│   │   └── Api/                # API placeholder
│   ├── Middleware/
│   │   ├── Auth/
│   │   │   ├── AdminAuthMiddleware.php
│   │   │   └── ClientAuthMiddleware.php
│   │   └── TrackVisitorsMiddleware.php
│   └── Requests/               # Form request validation
├── Models/                     # 12 Eloquent models
│   ├── User.php
│   ├── Tour.php
│   ├── Order.php
│   ├── Payment.php
│   ├── Category.php
│   ├── Destination.php
│   └── ...
├── Mail/                       # 3 mailable classes
│   ├── OrderConfirmationMail.php
│   ├── ResetPasswordMail.php
│   └── VerifyEmail.php
└── View/Components/            # Blade components
```

## Key Reference Files

### Tour Model
**File:** `app/Models/Tour.php`
```php
class Tour extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_code', 'name', 'slug', 'duration', 'departure_point',
        'remaining_slots', 'price_adult', 'price_child', 'price_toddler', 'price_infant',
        'transport_mode', 'short_description', 'tour_description', 'priority',
        'tour_schedule', 'thumbnail', 'images', 'services_note', 'note', 'characteristic',
    ];

    protected $casts = [
        'images' => 'array',
        'tour_schedule' => 'array',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'tour_categories');
    }

    public function destinations(): BelongsToMany
    {
        return $this->belongsToMany(Destination::class, 'tour_destinations')
            ->withPivot('position')
            ->orderBy('pivot_position');
    }
}
```

### Admin Tour Controller
**File:** `app/Http/Controllers/Admin/TourController.php`
```php
class TourController extends Controller
{
    public function index(Request $request): View
    {
        $query = Tour::with(['categories', 'destinations']);

        $request->whenFilled('search', function ($search) use ($query) {
            $query->where('name', 'like', '%' . $search . '%');
        });

        $tours = $query->orderByDesc('created_at')->paginate(10)->withQueryString();
        return view('admin.modules.tours.index', compact('tours'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $this->validateRequest($request);
        $validatedData['slug'] = $this->generateUniqueSlug($validatedData['name']);

        $tour = Tour::create($validatedData);
        $tour->categories()->sync($request->input('category_ids', []));

        return redirect()->route('admin.tours.index')->with('success', 'Tạo mới tour thành công.');
    }

    private function validateRequest(Request $request, int $exceptId = null): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'tour_code' => 'required|string|max:50|unique:tours,tour_code' . ($exceptId ? ',' . $exceptId : ''),
            'price_adult' => 'nullable|integer|min:0',
            'category_ids' => 'nullable|array',
            'category_ids.*' => 'exists:categories,id',
            // ... more rules
        ]);
    }
}
```

## Database Schema

### Core Tables

```
users
├── id, name, email, password, role (admin/user)
├── google_id, account_type (LOCAL/GOOGLE)
├── phone, address, avatar
└── email_verified_at, created_at, updated_at

tours
├── id, tour_code, name, slug
├── duration, departure_point, remaining_slots
├── price_adult, price_child, price_toddler, price_infant
├── thumbnail, images (JSON), tour_schedule (JSON)
└── short_description, tour_description, priority

orders
├── id, user_id (FK), tour_id (FK)
├── status (PENDING/CONFIRMED/COMPLETED/CANCELLED)
├── departure_date, total_price, cancellation_reason
└── adult_count, child_count, toddler_count, infant_count

payments
├── id, order_id (FK)
├── method, transaction_id, amount
└── status (PENDING/SUCCESS/FAILED/CANCELLED/REFUNDED)

categories
├── id, name, slug, type (TOUR/NEWS)
├── parent_id (self-ref), is_active
└── created_at, updated_at

destinations
├── id, name, slug, description
└── created_at, updated_at
```

### Pivot Tables
```
tour_categories: tour_id, category_id
tour_destinations: tour_id, destination_id, position
```

### Relationships
```
User ──1:N── Order ──1:1── Payment
Tour ──M:N── Category (via tour_categories)
Tour ──M:N── Destination (via tour_destinations)
Category ──1:N── News
Category ──self── Category (parent_id)
```

## Route Patterns

**File:** `routes/web.php`

### Admin Routes (prefix: `/admin`)
```php
Route::prefix('admin')->name('admin.')->middleware(AdminAuthMiddleware::class)->group(function () {
    Route::get('/dashboard', [AdminBaseController::class, 'index'])->name('dashboard.index');
    Route::resource('tours', AdminTourController::class);
    Route::resource('orders', OrderController::class)->except(['create', 'store', 'edit', 'update']);
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});
```

### Client Routes (Vietnamese slugs)
```php
Route::get('/', [ClientBaseController::class, 'index'])->name('client.home');
Route::get('/du-lich', [ClientTourController::class, 'index'])->name('client.tours');
Route::get('/du-lich/{tour:slug}', [ClientTourController::class, 'show'])->name('client.tour.show');
Route::get('/dat-tour/{tour:slug}', [ClientCheckoutController::class, 'index'])->name('client.checkout');
Route::post('/dat-tour/{tour:slug}', [ClientCheckoutController::class, 'store'])
    ->middleware('throttle:2,1')
    ->name('client.checkout.store');

Route::middleware('auth')->group(function () {
    Route::get('/tai-khoan', [ClientProfileController::class, 'index'])->name('client.profile');
});
```

## Naming Conventions

### Controllers
| Type | Pattern | Example |
|------|---------|---------|
| Admin | `Admin{Entity}Controller` | `AdminTourController` |
| Client | `Client{Entity}Controller` | `ClientCheckoutController` |

### Models
| Element | Convention | Example |
|---------|------------|---------|
| Class | Singular, PascalCase | `Tour`, `Category` |
| Table | Plural, snake_case | `tours`, `categories` |
| Pivot | Alphabetical | `tour_categories` |
| FK | `{model}_id` | `user_id`, `tour_id` |

### Status Constants
```php
class Order extends Model
{
    const STATUS_PENDING = 'pending';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';
}

// Usage
Order::where('status', Order::STATUS_PENDING)->get();
```

## Code Patterns

### Controller Structure
```php
class AdminTourController extends Controller
{
    public function index(Request $request): View { }      // List
    public function create(): View { }                      // Create form
    public function store(Request $request): RedirectResponse { }  // Store
    public function edit(Tour $tour): View { }              // Edit form
    public function update(Request $request, Tour $tour): RedirectResponse { }
    public function destroy(Tour $tour): RedirectResponse { }
}
```

### Model Structure
```php
class Tour extends Model
{
    // 1. Traits
    use HasFactory;

    // 2. Constants
    const STATUS_ACTIVE = 'active';

    // 3. Properties
    protected $fillable = [...];
    protected $casts = [...];

    // 4. Relationships
    public function categories(): BelongsToMany { }

    // 5. Scopes
    public function scopeActive($query) { }

    // 6. Accessors/Mutators
    public function getPriceFormattedAttribute() { }
}
```

### Validation Pattern
```php
private function validateRequest(Request $request, int $exceptId = null): array
{
    return $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email' . ($exceptId ? ',' . $exceptId : ''),
        'category_ids' => 'nullable|array',
        'category_ids.*' => 'exists:categories,id',
    ]);
}
```

### Queued Mail Pattern
```php
// In Controller
Mail::to($user)->queue(new OrderConfirmationMail($order));

// Mailable class
class OrderConfirmationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public Order $order) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Xác nhận đặt tour');
    }

    public function content(): Content
    {
        return new Content(view: 'mail.order-confirmation');
    }
}
```

### Slug Generation
```php
private function generateUniqueSlug(string $name, ?int $exceptId = null): string
{
    $slug = Str::slug($name);
    $originalSlug = $slug;
    $counter = 1;

    $query = Tour::where('slug', $slug);
    if ($exceptId) {
        $query->where('id', '!=', $exceptId);
    }

    while ($query->exists()) {
        $slug = $originalSlug . '-' . $counter++;
        $query = Tour::where('slug', $slug);
        if ($exceptId) {
            $query->where('id', '!=', $exceptId);
        }
    }

    return $slug;
}
```

## Middleware

### AdminAuthMiddleware
```php
public function handle(Request $request, Closure $next)
{
    if (!Auth::check() || Auth::user()->role !== 'admin') {
        return redirect()->route('admin.login');
    }
    return $next($request);
}
```

## API Endpoints

| Method | Endpoint | Controller | Purpose |
|--------|----------|------------|---------|
| GET | `/api/search-suggestions` | ClientTourController | Tour autocomplete |
| GET | `/api/destination-suggestions` | ClientTourController | Destination autocomplete |

## Migration Pattern

```php
// Create table
Schema::create('tours', function (Blueprint $table) {
    $table->id();
    $table->string('tour_code')->unique();
    $table->string('name');
    $table->string('slug')->unique();
    $table->integer('price_adult')->nullable();
    $table->json('images')->nullable();
    $table->json('tour_schedule')->nullable();
    $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
    $table->timestamps();
});

// Pivot table
Schema::create('tour_categories', function (Blueprint $table) {
    $table->foreignId('tour_id')->constrained()->cascadeOnDelete();
    $table->foreignId('category_id')->constrained()->cascadeOnDelete();
    $table->primary(['tour_id', 'category_id']);
});
```

## Anti-Patterns to Avoid

| ❌ Don't | ✅ Do Instead |
|----------|---------------|
| Raw SQL queries | Eloquent ORM |
| Hardcoded strings | Constants / config() |
| Logic in views | Controllers / Services |
| Direct file uploads | CKFinder integration |
| Sync mail sending | Queued mail |
| Controller validation | Form Request classes |

## Testing Commands

```bash
# Run tests
php artisan test

# Run specific test
php artisan test --filter=TourControllerTest

# Fresh migration with seeding
php artisan migrate:fresh --seed

# Queue worker
php artisan queue:work
```
