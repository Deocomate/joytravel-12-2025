@php
    $inputId = $attributes->get('id', 'input-' . $name);
    $placeholderValue = $attributes->get('placeholder', 'Enter ' . $label);
@endphp

<x-admin.inputs.wrapper :label="$label" :name="$name" :required="$required" :id="$inputId">
    <input
        type="number"
        name="{{ $name }}"
        id="{{ $inputId }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholderValue }}"
        {{ $attributes->except(['id', 'name', 'value', 'placeholder'])->merge(['class' => 'form-control ' . ($errors->has($name) ? 'is-invalid' : '')]) }}
        @if($required) required @endif
    >
</x-admin.inputs.wrapper>
