# Phase 01: Consolidate slug generation

## Context Links
- `app/Http/Controllers/Controller.php`
- `app/Http/Controllers/Admin/TourController.php`
- `app/Http/Controllers/Admin/NewsController.php`
- `app/Http/Controllers/Admin/DestinationController.php`
- `docs/code-standards.md`

## Overview
- **Priority**: High
- **Status**: In Progress
- **Description**: Remove duplicated slug generation logic and centralize it.

## Key Insights
- Code standards require manual `Str::slug()` and a uniqueness loop.
- Controllers currently duplicate the same logic.

## Requirements
- Keep existing slug behavior (Str::slug + while loop)
- Reuse logic across admin controllers
- Avoid breaking existing APIs

## Architecture
- Add a shared helper in base controller
- Controllers call shared helper with model class and optional except id

## Related Code Files
- **Modify**:
  - `app/Http/Controllers/Controller.php`
  - `app/Http/Controllers/Admin/TourController.php`
  - `app/Http/Controllers/Admin/NewsController.php`
  - `app/Http/Controllers/Admin/DestinationController.php`

## Implementation Steps
1. Add shared `generateUniqueSlug` helper in base controller.
2. Remove duplicate private methods in admin controllers.
3. Update controllers to call the shared helper.
4. Run PHP syntax checks on modified files.

## Todo List
- [ ] Add base controller slug helper
- [ ] Replace controller-specific slug logic
- [ ] Run syntax checks

## Success Criteria
- Single slug helper used in all three controllers
- No functional regressions in slug behavior

## Risk Assessment
- **Risk**: Mismatch in slug uniqueness query
  - **Mitigation**: Keep same logic and model-specific query

## Security Considerations
- No new security impact; slug is derived from user input via validation

## Next Steps
- Optional: extend helper usage to other slug-using controllers
