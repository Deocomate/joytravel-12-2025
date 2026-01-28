@php
    $inputId = $attributes->get('id', 'input-' . $name);
    $placeholderValue = $attributes->get('placeholder', 'Enter ' . $label);
@endphp

<x-admin.inputs.wrapper :label="$label" :name="$name" :required="$required" :id="$inputId">
    <textarea
        name="{{ $name }}"
        id="{{ $inputId }}"
        rows="{{ $attributes->get('rows', 3) }}"
        placeholder="{{ $placeholderValue }}"
        {{ $attributes->except(['id', 'name', 'rows', 'placeholder'])->merge(['class' => 'form-control ' . ($errors->has($name) ? 'is-invalid' : '')]) }}
        @if($required) required @endif
    >{{ old($name, $value) }}</textarea>
</x-admin.inputs.wrapper>
