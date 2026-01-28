# Code Standards - King Express Travel

## 1. Naming Conventions

| Entity               | Rule                                  | Example                                              |
| -------------------- | ------------------------------------- | ---------------------------------------------------- |
| **Controllers**      | `Namespace` + `Entity` + `Controller` | `AdminTourController`, `ClientNewsController`        |
| **Views (Admin)**    | Resource based                        | `resources/views/admin/tours/createOrEdit.blade.php` |
| **Views (Client)**   | Feature based                         | `resources/views/client/profile/index.blade.php`     |
| **Routes**           | Named Routes (dotted)                 | `admin.tours.index`, `client.checkout.store`         |
| **Blade Components** | `x-{namespace}.{group}.{name}`        | `<x-admin.inputs.text />`, `<x-client.tour-card />`  |

## 2. Admin Development (AdminLTE)

### Forms

**ALWAYS** use the dedicated Blade components in `resources/views/components/admin/inputs/`. Do not write raw HTML inputs.

```blade
<!-- Correct -->
<x-admin.inputs.text label="Tên tour" name="name" :value="$tour->name" required />
<x-admin.inputs.editor label="Mô tả" name="description" :value="$tour->description" />

<!-- Incorrect -->
<div class="form-group">
    <input type="text" name="name">
</div>
```

### Javascript

- Push scripts to the stack: `@push('scripts') ... @endpush`.
- Use jQuery (bundled with AdminLTE) for DOM manipulation in Admin.

## 3. Client Development (Tailwind + Alpine)

### Styling

- Use **Tailwind CSS** classes exclusively.
- Define colors in `tailwind.config` script within `app.blade.php` (e.g., `var(--color-primary)`).
- **Do not** use Bootstrap classes in Client views.

### Interactivity

- Use **Alpine.js** for:
    - Dropdowns (`x-data="{ open: false }"`)
    - Modals
    - Search toggles
    - Mobile menu
- Use **AJAX** for filtering lists (Tours/News). Controller should return JSON `{ html: '...' }`.

## 4. Model & Database Patterns

### JSON Casting

Models utilizing JSON columns (`tours` table) must cast attributes:

```php
protected $casts = [
    'images' => 'array',
    'tour_schedule' => 'array',
    'is_active' => 'boolean',
];
```

### Slugs

- Use `App\Services\Common\SlugService` for slug generation.
- Ensure uniqueness by looping with `-1`, `-2`, etc.

## 5. Controller Logic

### Validation

- Validate **all** incoming requests.
- Use `after_or_equal:today` for dates.
- Use `Rule::in([...])` for Enums.

### Dependency Injection

- Use Route Model Binding where possible:

```php
public function edit(Tour $tour) { ... }
```
