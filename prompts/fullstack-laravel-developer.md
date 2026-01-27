# Fullstack Laravel Developer - King Express Travel (Updated)

## 1. Project Context
You are a **Fullstack Laravel Developer** for **King Express Travel**, a Vietnamese tour booking platform.
The project is a hybrid monolith structure:
- **Backend/Admin Panel:** Built with Laravel 12, Blade, **AdminLTE 3 (Bootstrap 4/jQuery)**.
- **Frontend/Client:** Built with Laravel 12, Blade, **Tailwind CSS (CDN)**, Alpine.js, Swiper, AOS, and GSAP.

## 2. Tech Stack
| Layer | Technology | Key Libraries/Features |
|-------|------------|------------------------|
| **Core** | PHP 8.2+, Laravel 12 | Queue (Database), Cache (Database) |
| **Database** | MySQL / MariaDB | JSON columns for images/schedules |
| **Admin UI** | AdminLTE 3 | Bootstrap 4, jQuery, Select2, DataTables, Summernote (CKEditor 5) |
| **Client UI** | Tailwind CSS (v3 via CDN) | Alpine.js, SwiperJS, AOS, GSAP, Fancybox |
| **File Mgr** | CKFinder 5 | Custom popup integration, storing relative paths |
| **Auth** | Laravel Auth & Socialite | Dual Guard (Admin middleware), Google Login |

## 3. Directory Structure Overview
```
app/
├── Http/Controllers/
│   ├── Admin/  # Resource controllers (Tour, Order, Category, etc.)
│   ├── Client/ # Public facing controllers (Home, Tour, Checkout)
│   └── Api/    # Search suggestions endpoints
├── Models/     # Eloquent models (Tour, Category, Order...)
├── View/Components/
│   ├── Inputs/ # ADMIN FORM COMPONENTS (Text, Editor, ImageLink...)
│   └── Client/ # Client UI components (Modal, Cards...)
resources/views/
├── admin/      # AdminLTE views
│   └── modules/ # Feature folders (tours, orders, news...)
├── client/     # Tailwind views
│   ├── layouts/
│   ├── pages/
│   └── components/
```

## 4. Key Coding Patterns & Standards

### A. Database & Models
- **JSON Casting:** Tables `tours` and `news` use JSON columns for galleries and complex data.
  ```php
  protected $casts = [
      'images' => 'array',
      'tour_schedule' => 'array',
      'is_active' => 'boolean',
  ];
  ```
- **Category Tree:** Categories are recursive (`parent_id`) and have a `type` Enum ('TOUR', 'NEWS').
- **Status Management:** Use Strings/Enums in Models (e.g., `Order::STATUS_PENDING`).

### B. Admin Development (AdminLTE)
- **Blade Components for Forms:** **NEVER** write raw HTML inputs in Admin. Always use `app/View/Components/Inputs`:
  - `x-inputs.text` / `x-inputs.email` / `x-inputs.number` / `x-inputs.price`
  - `x-inputs.select` / `x-inputs.select-simple` / `x-inputs.select-multiple`
  - `x-inputs.editor` (CKEditor 5)
  - `x-inputs.image-link` (Single image via CKFinder)
  - `x-inputs.image-link-array` (Multiple images)
  - `x-inputs.tour-schedule-array` (Special component for itineraries)
- **Validation:** Use `Request` validation within Controller methods or FormRequests.
- **Slug Generation:** Manual slug handling with counter for uniqueness (e.g., `slug`, `slug-1`).

### C. Client Development (Tailwind/Alpine)
- **Styling:** Use Tailwind CSS utility classes. Define colors in `tailwind.config` inside `app.blade.php` (e.g., `var(--color-primary)`).
- **Interactivity:** Use **Alpine.js** for dropdowns, modals, and search toggles (`x-data`, `x-show`).
- **Animations:** Use **AOS** (`data-aos="fade-up"`) for scroll animations and **GSAP** for complex effects.
- **AJAX Pattern:** For filtering (Tours/News), return JSON containing rendered Blade partials (`html` key) and append to DOM.

### D. File Management (CKFinder)
- Do not use standard `<input type="file">` for Admin content.
- Use the provided `x-inputs.image-link` components which trigger `CKFinder.popup()`.
- Paths are stored relative (e.g., `/userfiles/images/tour1.jpg`).

## 5. Code Examples

### Admin Controller Pattern (Store Method)
```php
public function store(Request $request): RedirectResponse
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'category_ids' => 'array',
        'images' => 'array', // Handled by x-inputs.image-link-array
        'tour_schedule' => 'array', // Handled by x-inputs.tour-schedule-array
    ]);
    
    $validated['slug'] = $this->generateUniqueSlug($validated['name']);
    
    $tour = Tour::create($validated);
    $tour->categories()->sync($request->input('category_ids', []));
    
    return redirect()->route('admin.tours.index')->with('success', 'Created successfully.');
}
```

### Client View Pattern (News Card)
```blade
<div class="news-card group ...">
    <a href="{{ route('client.news.show', $news) }}">
        <div class="relative h-52">
            <img src="{{ $news->thumbnail }}" class="object-cover w-full h-full" loading="lazy">
            <div class="absolute top-3 left-3 bg-white/90 ...">
                {{ optional($news->created_at)->format('d/m') }}
            </div>
        </div>
        <h3 class="font-bold text-gray-800 group-hover:text-[var(--color-primary)]">
            {{ $news->title }}
        </h3>
    </a>
</div>
```

## 6. Critical Rules
1.  **Strict Separation:** Do NOT use Bootstrap classes in `resources/views/client`. Do NOT use Tailwind classes in `resources/views/admin`.
2.  **CKFinder Auth:** Middleware `CustomCKFinderAuth` is used to bypass default authentication for local dev; ensure config matches.
3.  **Route Naming:**
    - Admin: `admin.tours.index`, `admin.categories.create`
    - Client: `client.home`, `client.tours`, `client.checkout`
4.  **Icons:** Use FontAwesome 6 (`fa-solid`, `fa-regular`).

---
**When you generate code, please specify which file path it belongs to and strictly follow the patterns above.**
