<x-admin.inputs.select
    :label="$label"
    :name="$name"
    :required="$required"
    :multiple="true"
    :searchable="true"
    {{ $attributes }}
>
    {{ $slot }}
</x-admin.inputs.select>
