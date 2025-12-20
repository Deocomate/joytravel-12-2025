# Code Standards - King Express Travel

## Language & Comments

- **Code**: English (PHP/Laravel conventions)
- **Comments**: Vietnamese allowed for business logic explanations
- **Documentation**: English

## Naming Conventions

### Controllers

| Pattern | Example |
|---------|---------|
| Admin controllers | `Admin{Entity}Controller` |
| Client controllers | `Client{Entity}Controller` |
| Resource methods | index, create, store, show, edit, update, destroy |

```php
// ✓ Good
class AdminTourController extends Controller
class ClientCheckoutController extends Controller

// ✗ Bad
class TourAdminController extends Controller
class CheckoutCtrl extends Controller
```

### Models

| Element | Convention | Example |
|---------|------------|---------|
| Class name | Singular, PascalCase | `Tour`, `Category` |
| Table name | Plural, snake_case | `tours`, `categories` |
| Pivot tables | Alphabetical order | `tour_categories` |
| Foreign keys | `{model}_id` | `user_id`, `tour_id` |

### Routes

| Type | Pattern | Example |
|------|---------|---------|
| Vietnamese slugs | SEO-friendly | `/du-lich`, `/tin-tuc` |
| Admin routes | English | `/admin/tours`, `/admin/orders` |
| API routes | RESTful | `/api/search`, `/api/filter` |

## Code Patterns

### Controller Structure

```php
class AdminTourController extends Controller
{
    // 1. List/Index
    public function index() { }

    // 2. Create form
    public function create() { }

    // 3. Store new record
    public function store(Request $request) { }

    // 4. Edit form
    public function edit($id) { }

    // 5. Update record
    public function update(Request $request, $id) { }

    // 6. Delete record
    public function destroy($id) { }
}
```

### Model Conventions

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
    public function categories() { }
    public function destinations() { }

    // 5. Scopes
    public function scopeActive($query) { }

    // 6. Accessors/Mutators
    public function getPriceFormattedAttribute() { }
}
```

### Status Constants Pattern

```php
// In Model
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

## Blade Components

### Input Component Pattern

```php
// Component class
class Text extends Component
{
    public function __construct(
        public string $name,
        public string $label,
        public ?string $value = null,
        public bool $required = false
    ) {}
}
```

```blade
{{-- Usage --}}
<x-admin.input.text
    name="tour_name"
    label="Tên tour"
    :value="$tour->name"
    required
/>
```

## Database Standards

### Migration Naming

```
{timestamp}_create_{table}_table.php
{timestamp}_add_{column}_to_{table}_table.php
{timestamp}_create_{table1}_{table2}_table.php  // Pivots
```

### Column Conventions

| Type | Convention |
|------|------------|
| Primary key | `id` (auto) |
| Foreign key | `{model}_id` |
| Boolean | `is_{adjective}` (is_active, is_featured) |
| Timestamps | `created_at`, `updated_at` |
| Soft delete | `deleted_at` |
| Status | ENUM or string constants |

### JSON Columns

```php
// Migration
$table->json('images')->nullable();
$table->json('schedule')->nullable();

// Model cast
protected $casts = [
    'images' => 'array',
    'schedule' => 'array',
];
```

## View Organization

```
resources/views/
├── admin/
│   ├── layouts/
│   │   └── app.blade.php       # Admin layout
│   ├── tours/
│   │   ├── index.blade.php
│   │   ├── create.blade.php
│   │   └── edit.blade.php
│   └── partials/
├── client/
│   ├── layouts/
│   │   └── app.blade.php       # Client layout
│   ├── pages/
│   └── partials/
└── components/
    ├── admin/input/            # Admin form components
    └── client/                 # Client UI components
```

## Route Grouping

```php
// Admin routes
Route::prefix('admin')
    ->middleware(['auth', AdminAuthMiddleware::class])
    ->group(function () {
        // Protected admin routes
    });

// Client auth routes
Route::middleware('auth')
    ->group(function () {
        // Authenticated client routes
    });

// Public routes
Route::get('/du-lich', [ClientTourController::class, 'index']);
```

## Error Handling

```php
// Controller validation
$request->validate([
    'email' => 'required|email|unique:users',
    'password' => 'required|min:8',
]);

// Try-catch for external services
try {
    Mail::to($user)->queue(new OrderConfirmationMail($order));
} catch (\Exception $e) {
    Log::error('Email failed: ' . $e->getMessage());
}
```

---

## Anti-Patterns to Avoid

| ✗ Don't | ✓ Do Instead |
|---------|--------------|
| Raw SQL queries | Eloquent ORM |
| Hardcoded strings | Constants/config |
| Logic in views | Controllers/Services |
| Inline styles | Tailwind/CSS classes |
| Direct file uploads | CKFinder integration |
