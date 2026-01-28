## Context Links
- `docs/code-standards.md`
- `app/Http/Controllers/Controller.php`

## Overview
- Priority: High
- Status: In Progress
- Scope: BaseService, SlugService, FileService stub

## Key Insights
- Slug logic currently in base Controller
- Multiple controllers depend on slug generation

## Requirements
- Centralize slug generation in Common service
- Keep services request/response free

## Architecture
- `BaseService` in `app/Services`
- `SlugService` in `app/Services/Common`
- `FileService` placeholder in `app/Services/Common`

## Related Code Files
- Modify: `app/Http/Controllers/Controller.php`
- Create: `app/Services/BaseService.php`
- Create: `app/Services/Common/SlugService.php`
- Create: `app/Services/Common/FileService.php`

## Implementation Steps
1. Add `BaseService` class
2. Add `SlugService` with unique slug generator
3. Add `FileService` placeholder
4. Remove slug logic from base Controller

## Todo List
- [ ] Create base services
- [ ] Remove Controller slug logic

## Success Criteria
- Controllers no longer call `generateUniqueSlug`
- Slug generation is reusable via service

## Risk Assessment
- Risk: missing DI wiring
- Mitigation: constructor injection and tests

## Security Considerations
- Ensure slug uniqueness checks use safe query

## Next Steps
- Proceed to Admin services
