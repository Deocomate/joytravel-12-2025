@php
    $inputId = $attributes->get('id', 'input-' . $name);
@endphp

<x-admin.inputs.wrapper :label="$label" :name="$name" :required="$required" :id="$inputId">
    <div class="input-group">
        <input
            readonly
            type="text"
            name="{{ $name }}"
            id="{{ $inputId }}"
            value="{{ old($name, $value) }}"
            {{ $attributes->except(['id', 'name', 'value'])->merge(['class' => 'form-control']) }}
            @if($required) required @endif
        >
        <span class="input-group-append">
            <button type="button" class="btn btn-secondary ckfinder-file-popup-button">
                Duyệt File
            </button>
        </span>
    </div>
</x-admin.inputs.wrapper>

{{--
Sử dụng @pushonce để đảm bảo đoạn script này chỉ được thêm vào trang MỘT LẦN,
dù bạn có dùng component này nhiều lần trên cùng một trang.
--}}
@pushonce("scripts")
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Lắng nghe sự kiện click trên toàn bộ body
        document.body.addEventListener('click', function(e) {
            // Kiểm tra xem phần tử được click có phải là nút duyệt file của chúng ta không
            if (e.target && e.target.matches('.ckfinder-file-popup-button')) {
                const button = e.target;

                CKFinder.popup({
                    chooseFiles: true,
                    resourceType: 'Files', // Chỉ định mở thư mục Files
                    width: 800,
                    height: 600,
                    onInit: function(finder) {
                        finder.on('files:choose', function(evt) {
                            const file = evt.data.files.first();
                            const path = new URL(file.getUrl()).pathname;

                            // Tìm input tương ứng bằng cách đi ngược lại cây DOM
                            const inputGroup = button.closest('.input-group');
                            if (inputGroup) {
                                const input = inputGroup.querySelector('.form-control');
                                if (input) {
                                    input.value = path;
                                }
                            }
                        });
                    }
                });
            }
        });
    });
</script>
@endpushonce