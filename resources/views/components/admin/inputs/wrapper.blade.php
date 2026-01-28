@props(['label' => null, 'name', 'required' => false, 'id' => null])

@php
    $inputId = $id ?? 'input-' . $name;
@endphp

<div class="form-group">
    @if($label)
        <label for="{{ $inputId }}">
            {{ $label }}
            @if($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif

    {{ $slot }}

    @error($name)
        <div class="text-danger small mt-1">
            <i class="fas fa-exclamation-circle"></i> {{ $message }}
        </div>
    @enderror
</div>
