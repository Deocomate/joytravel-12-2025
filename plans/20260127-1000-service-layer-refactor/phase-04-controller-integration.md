## Context Links
- `app/Http/Controllers/Admin/*`
- `app/Http/Controllers/Client/*`

## Overview
- Priority: High
- Status: In Progress
- Scope: Controller wiring and cleanup

## Key Insights
- Controller DI needed for new services
- Remove direct DB/logic from controllers

## Requirements
- Keep controllers thin
- Preserve responses and routes

## Architecture
- Constructor injection for service dependencies
- Shared SlugService usage for non-service controllers

## Related Code Files
- Modify: Admin and Client controllers
- Modify: Base Controller

## Implementation Steps
1. Inject services into controllers
2. Replace inline logic with service calls
3. Remove unused helper methods

## Todo List
- [ ] Update controllers
- [ ] Verify responses unchanged

## Success Criteria
- Controllers only validate and delegate
- No direct slug logic in base controller

## Risk Assessment
- Risk: missing service binding
- Mitigation: rely on Laravel container autowire

## Security Considerations
- Ensure validation rules are unchanged

## Next Steps
- Run tests and update docs
