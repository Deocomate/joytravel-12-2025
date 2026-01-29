@php
    $inputId = $attributes->get('id', 'input-' . $name);
@endphp

<x-admin.inputs.wrapper :label="$label" :name="$name" :id="$inputId">
    <textarea
        name="{{ $name }}"
        id="{{ $inputId }}"
        {{ $attributes->except(['id', 'name'])->merge(['class' => 'form-control ckeditor-instance ' . ($errors->has($name) ? 'is-invalid' : '')]) }}
    >{!! old($name, $value) !!}</textarea>
</x-admin.inputs.wrapper>

@push("scripts")
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            initCkEditor('{{ $inputId }}');
        });
    </script>
@endpush
