{{--
    Tour List Partial
    - For initial load: Includes the grid wrapper
    - For AJAX load more: Returns only the tour cards (when wrapped is false)
--}}
@php
    $isAjax = request()->ajax();
@endphp

@if (!$isAjax)
{{-- Initial Load: Include grid wrapper --}}
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6" id="tour-grid">
@endif

@foreach($tours as $tour)
    <x-client.tour-card :tour="$tour" />
@endforeach

@if (!$isAjax)
</div>
@endif
