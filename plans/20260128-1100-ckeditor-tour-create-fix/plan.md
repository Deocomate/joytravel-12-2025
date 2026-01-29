# [Bug Fix] Implementation Plan

**Date**: 2026-01-28  
**Type**: Bug Fix  
**Priority**: High  
**Context Tokens**: Admin tours create page fails with CKEditor duplicated modules error and a JS ReferenceError. The CKEditor issue is triggered by multiple component-level script loads and conflicting init functions, causing duplicate bundles/configs on the same page. The ReferenceError happens because `updateDestinationOrder` is referenced before it is initialized in the Sortable config.

## Executive Summary
Fix CKEditor module duplication by consolidating script/config loading and using a single init function, and fix the Sortable callback order error by moving or hoisting the function definition.

## Issue Analysis
### Symptoms
- [ ] `ckeditor-duplicated-modules` error on `/admin/tours/create`
- [ ] `Cannot access 'updateDestinationOrder' before initialization`

### Root Cause
Multiple CKEditor loaders and conflicting `initCkEditor()` definitions on the same page; `const` function used before declaration in Sortable setup.

### Evidence
- **Logs**: Browser console errors provided by user
- **Error Messages**: `ckeditor-duplicated-modules`, `updateDestinationOrder` TDZ
- **Affected Components**:
  - `resources/views/components/admin/inputs/editor.blade.php`
  - `resources/views/components/admin/inputs/editor-array.blade.php`
  - `resources/views/components/admin/inputs/tour-schedule-array.blade.php`
  - `public/admin/js/ckeditor-config.js`
  - `resources/views/admin/tours/createOrEdit.blade.php`

## Context Links
- **Related Issues**: N/A
- **Recent Changes**: N/A
- **Dependencies**: CKEditor 5 bundle in `public/js/ckeditor/ckeditor.js`

## Solution Design
### Approach
Ensure CKEditor assets and config are loaded once and all components use the shared `initCkEditor()`; move/hoist `updateDestinationOrder` before Sortable initialization.

### Changes Required
1. **`resources/views/components/admin/inputs/tour-schedule-array.blade.php`**: remove inline init, push shared config.
2. **`resources/views/components/admin/inputs/editor.blade.php`**: ensure shared loader, no duplicates.
3. **`resources/views/components/admin/inputs/editor-array.blade.php`**: ensure shared loader, no duplicates.
4. **`resources/views/admin/tours/createOrEdit.blade.php`**: move/hoist `updateDestinationOrder` definition.

### Testing Changes
- [ ] Validate editor loads with multiple fields on tours create
- [ ] Drag/drop itinerary items works without JS errors

## Implementation Steps
1. [ ] Unify CKEditor loader/config usage across admin editor components.
2. [ ] Remove duplicate inline CKEditor init from tour schedule component.
3. [ ] Hoist/move `updateDestinationOrder` before Sortable init.
4. [ ] Smoke test `/admin/tours/create` in browser.

## Verification Plan
### Test Cases
- [ ] Page loads without CKEditor errors
- [ ] All editors initialize once and function normally
- [ ] Sorting itinerary updates order labels without errors

### Rollback Plan
If the fix causes issues:
1. Revert commit: `git revert <commit-hash>`
2. Restore previous scripts in editor components and JS order logic

## Risk Assessment
| Risk | Impact | Mitigation |
|------|--------|------------|
| CKEditor config mismatch | Medium | Use shared config only |
| Component regressions | Low | Smoke test editors on other admin forms |

## TODO Checklist
- [ ] Implement fix
- [ ] Update tests
- [ ] Run full test suite
- [ ] Code review
- [ ] Deploy and verify
