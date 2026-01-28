# Refactor Slug Generation

- **Date**: 2026-01-27
- **Type**: Refactor
- **Status**: In Progress

## Phases
- [Phase 01: Consolidate slug generation](./phase-01-consolidate-slug-generation.md) - In Progress

## Dependencies
- `app/Http/Controllers/Controller.php`
- `app/Http/Controllers/Admin/TourController.php`
- `app/Http/Controllers/Admin/NewsController.php`
- `app/Http/Controllers/Admin/DestinationController.php`

## Success Criteria
- Slug generation logic is centralized and reused
- Existing behavior is preserved (Str::slug + while uniqueness check)
- No controller-specific duplicate slug methods remain
