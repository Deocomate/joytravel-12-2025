@php
    $inputId = $attributes->get('id', 'input-' . $name);
    $currentValue = old($name, $value);
@endphp

<x-admin.inputs.wrapper :label="$label" :name="$name" :required="$required" :id="$inputId">
    <select
        name="{{ $name }}{{ $multiple ? '[]' : '' }}"
        id="{{ $inputId }}"
        {{ $attributes->except(['id', 'name'])->merge(['class' => 'form-control ' . ($searchable ? 'select2-init ' : '') . ($errors->has($name) ? 'is-invalid' : '')]) }}
        @if($multiple) multiple @endif
        @if($required) required @endif
        style="width: 100%;"
    >
        @if(!$multiple && count($options) > 0)
            <option value="">-- Chọn {{ $label }} --</option>
        @endif

        @if(count($options) > 0)
            @foreach($options as $key => $optionLabel)
                <option value="{{ $key }}"
                    @if($multiple)
                        @selected(in_array($key, (array) $currentValue))
                    @else
                        @selected($currentValue == $key)
                    @endif
                >
                    {{ $optionLabel }}
                </option>
            @endforeach
        @else
            {{ $slot }}
        @endif
    </select>
</x-admin.inputs.wrapper>

@if($searchable)
    @pushonce('styles')
        <link rel="stylesheet" href="{{ asset('/admin/plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    @endpushonce

    @pushonce('scripts')
        <script src="{{ asset('/admin/plugins/select2/js/select2.full.min.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                $('.select2-init').select2({
                    theme: 'bootstrap4',
                    width: '100%',
                    language: "vi"
                });
            });
        </script>
    @endpushonce
@endif
