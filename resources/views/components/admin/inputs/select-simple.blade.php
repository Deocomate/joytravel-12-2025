<x-admin.inputs.select
    :label="$label"
    :name="$name"
    :value="$value"
    :required="$required"
    :searchable="false"
    {{ $attributes }}
>
    {{ $slot }}
</x-admin.inputs.select>
