@php
    $inputId = $attributes->get('id', 'input-' . $name);
    $previewId = 'preview-' . $name;
    $previewContainerId = 'preview-container-' . $name;
    $currentValue = old($name, $value);
@endphp

<x-admin.inputs.wrapper :label="$label" :name="$name" :required="$required" :id="$inputId">
    <div class="input-group">
        <input
            readonly
            type="text"
            name="{{ $name }}"
            id="{{ $inputId }}"
            value="{{ $currentValue }}"
            {{ $attributes->except(['id', 'name', 'value'])->merge(['class' => 'form-control']) }}
            @if($required) required @endif
        >
        <span class="input-group-append">
            <button
                type="button"
                class="btn btn-secondary btn-ckfinder"
                data-input-id="{{ $inputId }}"
                data-preview-id="{{ $previewId }}"
                data-preview-container="{{ $previewContainerId }}"
            >
                Duyệt Ảnh
            </button>
        </span>
    </div>

    <div id="{{ $previewContainerId }}" class="mt-2" style="{{ $currentValue ? '' : 'display:none' }}">
        <img
            src="{{ $currentValue }}"
            alt="Image Preview"
            id="{{ $previewId }}"
            style="max-width: 200px; max-height: 200px; display: {{ $currentValue ? 'block' : 'none' }};"
        >
        <button
            type="button"
            class="btn btn-xs btn-danger mt-1 btn-clear-image"
            data-input-id="{{ $inputId }}"
            data-preview-id="{{ $previewId }}"
            data-preview-container="{{ $previewContainerId }}"
        >
            Xóa ảnh
        </button>
    </div>
</x-admin.inputs.wrapper>

@pushonce("scripts")
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.addEventListener('click', function (e) {
                const ckfinderButton = e.target.closest('.btn-ckfinder');
                if (ckfinderButton) {
                    const inputId = ckfinderButton.dataset.inputId;
                    const previewId = ckfinderButton.dataset.previewId;
                    const previewContainerId = ckfinderButton.dataset.previewContainer;

                    CKFinder.popup({
                        chooseFiles: true,
                        width: 800,
                        height: 600,
                        onInit: function (finder) {
                            finder.on('files:choose', function (evt) {
                                const file = evt.data.files.first();
                                const fullUrl = file.getUrl();
                                let path;
                                try {
                                    path = new URL(fullUrl).pathname;
                                } catch (err) {
                                    path = fullUrl;
                                }

                                const input = document.getElementById(inputId);
                                const previewImage = document.getElementById(previewId);
                                const previewContainer = document.getElementById(previewContainerId);

                                if (input) {
                                    input.value = path;
                                }
                                if (previewImage) {
                                    previewImage.src = path;
                                    previewImage.style.display = "block";
                                }
                                if (previewContainer) {
                                    previewContainer.style.display = "block";
                                }
                            });
                        }
                    });
                }

                const clearButton = e.target.closest('.btn-clear-image');
                if (clearButton) {
                    const input = document.getElementById(clearButton.dataset.inputId);
                    const previewImage = document.getElementById(clearButton.dataset.previewId);
                    const previewContainer = document.getElementById(clearButton.dataset.previewContainer);

                    if (input) {
                        input.value = "";
                    }
                    if (previewImage) {
                        previewImage.src = "";
                        previewImage.style.display = "none";
                    }
                    if (previewContainer) {
                        previewContainer.style.display = "none";
                    }
                }
            });
        });
    </script>
@endpushonce
