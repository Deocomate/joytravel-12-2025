## Context Links
- `app/Http/Controllers/Admin/TourController.php`
- `app/Http/Controllers/Admin/NewsController.php`
- `app/Http/Controllers/Admin/OrderController.php`
- `app/Http/Controllers/Admin/AdminBaseController.php`

## Overview
- Priority: High
- Status: In Progress
- Scope: Admin services for Tour, News, Order, Dashboard

## Key Insights
- Controllers contain business logic and filtering
- Payment update logic should be isolated

## Requirements
- Move CRUD logic into services
- Keep controller actions thin

## Architecture
- `app/Services/Admin/TourService.php`
- `app/Services/Admin/NewsService.php`
- `app/Services/Admin/OrderService.php`
- `app/Services/Admin/DashboardService.php`

## Related Code Files
- Modify: Admin controllers above
- Create: Admin service classes

## Implementation Steps
1. Implement TourService (list/create/update/sync)
2. Implement NewsService (list/create/update)
3. Implement OrderService (list/update status/payment)
4. Implement DashboardService (stats + chart data)

## Todo List
- [ ] Build admin services
- [ ] Wire controllers to services

## Success Criteria
- Controllers only validate and call services
- Logic is reusable and testable

## Risk Assessment
- Risk: regressions in filters
- Mitigation: keep query parity

## Security Considerations
- Validate status enums strictly

## Next Steps
- Proceed to client services
