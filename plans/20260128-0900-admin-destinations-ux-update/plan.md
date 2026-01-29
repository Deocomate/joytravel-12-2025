## Plan: Admin Destinations UX/UI Update

### Goals
- Align admin destinations screens with tours UI patterns.
- Improve readability, actions, and filtering for destinations.
- Keep controller logic slim and consistent with service patterns.

### Scope
- Views: `resources/views/admin/destinations/*`
- Controller: `app/Http/Controllers/Admin/DestinationController.php`
- Schema reference: `database/migrations/2025_08_15_074112_init_system_schemas.php`

### Tasks
1. Review tours admin views for layout, filters, table actions, and form structure.
2. Update destinations index view to match tours list UX (filters, actions, empty state).
3. Update destinations create/edit view to match tours form layout and component usage.
4. Ensure controller passes required data (filters, lists, default values).
5. Run view compile to validate Blade syntax.
6. Run tests if available.
7. Perform code review and update docs if needed.

### Notes
- Use admin input components (no raw input HTML).
- Keep changes minimal and consistent with existing AdminLTE styling.
