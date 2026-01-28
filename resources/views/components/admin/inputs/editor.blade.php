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

@pushonce("scripts")
    <script src="{{ asset('/js/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('/admin/js/ckeditor-config.js') }}"></script>
@endpushonce

@push("scripts")
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            initCkEditor('{{ $inputId }}');
        });
    </script>
@endpush
