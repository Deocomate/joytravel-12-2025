@php
    $inputId = $attributes->get('id', 'input-' . $name);
@endphp

<x-admin.inputs.wrapper :label="$label" :name="$name" :required="$required" :id="$inputId">
    <input
        type="time"
        name="{{ $name }}"
        id="{{ $inputId }}"
        value="{{ old($name, $value) }}"
        onfocus="this.showPicker()"
        {{ $attributes->except(['id', 'name', 'value'])->merge(['class' => 'form-control ' . ($errors->has($name) ? 'is-invalid' : '')]) }}
        @if($required) required @endif
    >
</x-admin.inputs.wrapper>

@if($value == "" && old($name) == "")
    @push('scripts')
        <script>
            document.getElementById('{{ $inputId }}').value = (new Date()).toTimeString().substring(0, 5);
        </script>
    @endpush
@endif

