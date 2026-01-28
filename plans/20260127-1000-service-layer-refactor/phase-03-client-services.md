## Context Links
- `app/Http/Controllers/Client/ClientCheckoutController.php`
- `app/Http/Controllers/Client/ClientTourController.php`

## Overview
- Priority: Highest
- Status: In Progress
- Scope: Booking and Search services

## Key Insights
- Checkout contains transaction and pricing logic
- Tour search mixes query logic and UI concerns

## Requirements
- Move transaction into BookingService
- Move filters into SearchService

## Architecture
- `app/Services/Client/BookingService.php`
- `app/Services/Client/SearchService.php`

## Related Code Files
- Modify: client controllers above
- Create: client services

## Implementation Steps
1. Implement BookingService create flow
2. Implement SearchService for filters and listing
3. Keep controller validation only

## Todo List
- [ ] Build BookingService
- [ ] Build SearchService
- [ ] Wire controllers

## Success Criteria
- Controller logic is slim and consistent
- Booking transaction stays in service

## Risk Assessment
- Risk: pricing or slot validation mismatch
- Mitigation: preserve existing logic

## Security Considerations
- Validate inputs in controller
- Avoid leaking payment details

## Next Steps
- Integrate controllers and run tests
