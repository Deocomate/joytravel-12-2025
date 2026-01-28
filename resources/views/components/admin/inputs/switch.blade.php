@props(['label' => null, 'name', 'checked' => false])

<div class="form-group">
    <div class="custom-control custom-switch">
        <input type="hidden" name="{{ $name }}" value="0">
        <input
            type="checkbox"
            class="custom-control-input"
            id="switch-{{ $name }}"
            name="{{ $name }}"
            value="1"
            @checked(old($name, $checked))
            {{ $attributes }}
        >
        <label class="custom-control-label font-weight-normal" for="switch-{{ $name }}">
            {{ $label }}
        </label>
    </div>
    @error($name)
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>
