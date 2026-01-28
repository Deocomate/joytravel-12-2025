# Admin Input Components Refactoring Plan

**Date**: 2026-01-27  
**Type**: Refactoring  
**Scope**: Admin Blade input components + admin views  
**Context Tokens**: Consolidate admin input components for DRY, attribute bags, reduced JS duplication, and standardized selects.

## Executive Summary
Refactor admin Blade input components to reduce duplicated wrapper markup, enable attribute bags, consolidate select components, deduplicate CKEditor/CKFinder scripts, and update admin views to use the new optimized components.

## Current State Analysis
### Issues with Current Implementation
- [ ] Wrapper markup (`form-group`, label, error) repeated in many components
- [ ] Attributes are hard-coded, limiting reuse and customization
- [ ] Inline scripts duplicated across component instances
- [ ] Multiple select components with overlapping responsibilities

## Context Links
- **Affected Modules**: `resources/views/components/admin/inputs/*`, `app/View/Components/Admin/Inputs/*`, `resources/views/admin/*`
- **Dependencies**: AdminLTE 3, Bootstrap 4, jQuery, Select2, CKEditor 5, CKFinder
- **Related Documentation**: `docs/code-standards.md`

## Refactoring Strategy
### Approach
Introduce a wrapper component, update input components to use attribute bags, consolidate select components, move CKEditor config into a shared JS file, and update admin views to use the new components with minimal API changes.

### Key Improvements
- **DRY wrapper**: Single component handles label + error display
- **Flexible attributes**: `$attributes->merge()` for HTML flexibility
- **Script deduplication**: `@pushonce` and delegated event handlers
- **Select consolidation**: One select component for simple/multiple/searchable

## Implementation Plan
### Phase 1: Component Refactor
1. [ ] Add wrapper component view
2. [ ] Update text input component to use wrapper + attribute bag
3. [ ] Consolidate select components into one select view
4. [ ] Add switch component view
5. [ ] Refactor editor component to use shared config file
6. [ ] Refactor image link component to use delegated events

### Phase 2: Shared Scripts
1. [ ] Create `public/admin/js/ckeditor-config.js` with init function
2. [ ] Ensure scripts are loaded once via `@pushonce`

### Phase 3: View Updates
1. [ ] Update admin views to use new components and API
2. [ ] Remove legacy component usages (select simple/multiple, etc.)

## Backward Compatibility
- **Breaking Changes**: Component signatures may change for select inputs
- **Migration Path**: Update admin views to new component usage

## TODO Checklist
- [ ] Phase 1: Component refactor complete
- [ ] Phase 2: Shared scripts complete
- [ ] Phase 3: Admin view updates complete
- [ ] Lint/check for syntax errors
