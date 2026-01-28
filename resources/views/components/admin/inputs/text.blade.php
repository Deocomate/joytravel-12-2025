@php
    $inputId = $attributes->get('id', 'input-' . $name);
    $inputType = $attributes->get('type', 'text');
    $placeholderValue = $attributes->get('placeholder', $placeholder ?: 'Enter ' . $label);
@endphp

<x-admin.inputs.wrapper :label="$label" :name="$name" :required="$required" :id="$inputId">
    <input
        type="{{ $inputType }}"
        name="{{ $name }}"
        id="{{ $inputId }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholderValue }}"
        {{ $attributes->except(['id', 'type', 'name', 'value', 'placeholder'])->merge(['class' => 'form-control ' . ($errors->has($name) ? 'is-invalid' : '')]) }}
        @if($required) required @endif
    >
</x-admin.inputs.wrapper>
