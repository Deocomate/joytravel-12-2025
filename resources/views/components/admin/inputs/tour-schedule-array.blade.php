<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $label }}</h3>
    </div>
    <div class="card-body">
        <div id="schedule-container-{{ $name }}">
            @if (is_array($value) && count($value) > 0)
                @foreach ($value as $index => $item)
                    <div class="schedule-item card card-outline card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Ngày {{ $index + 1 }}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool text-danger btn-remove-schedule"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control mb-2" name="{{ $name }}[{{ $index }}][title]" placeholder="Tiêu đề (VD: Ngày 1: Hà Nội - Hạ Long)" value="{{ $item['title'] ?? '' }}">
                            <textarea name="{{ $name }}[{{ $index }}][content]" id="schedule-editor-{{ $name }}-{{ $index }}" class="form-control ckeditor-textarea">{!! $item['content'] ?? '' !!}</textarea>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="text-center mt-2">
            <button type="button" class="btn btn-primary btn-add-schedule-{{ $name }}">
                <i class="fas fa-plus"></i> Thêm Lịch trình
            </button>
        </div>
    </div>
</div>

<template id="schedule-template-{{ $name }}">
    <div class="schedule-item card card-outline card-secondary">
        <div class="card-header">
            <h3 class="card-title">Ngày __INDEX_PLUS_1__</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool text-danger btn-remove-schedule"><i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="card-body">
            <input type="text" class="form-control mb-2" name="{{ $name }}[__INDEX__][title]" placeholder="Tiêu đề (VD: Ngày __INDEX_PLUS_1__: ...)">
            <textarea name="{{ $name }}[__INDEX__][content]" id="schedule-editor-{{ $name }}-__INDEX__" class="form-control ckeditor-textarea"></textarea>
        </div>
    </div>
</template>

@pushonce("scripts")
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const allScheduleContainers = document.querySelectorAll('[id^="schedule-container-"]');

            allScheduleContainers.forEach(container => {
                const name = container.id.replace('schedule-container-', '');
                const addButton = document.querySelector(`.btn-add-schedule-${name}`);
                const template = document.getElementById(`schedule-template-${name}`);
                let scheduleCount = container.querySelectorAll('.schedule-item').length;

                const addRemoveEvent = (removeButton) => {
                    removeButton.addEventListener('click', function () {
                        const item = this.closest('.schedule-item');
                        const textarea = item.querySelector('.ckeditor-textarea');
                        const editorId = textarea.id;

                        const instanceMap = window.__ckeditorInstances || {};
                        if (instanceMap[editorId]) {
                            instanceMap[editorId].destroy().catch(error => console.error(error));
                            delete instanceMap[editorId];
                        }
                        item.remove();
                        updateScheduleIndexes(name);
                    });
                };

                const updateScheduleIndexes = (name) => {
                    const scheduleContainer = document.getElementById(`schedule-container-${name}`);
                    const items = scheduleContainer.querySelectorAll('.schedule-item');
                    scheduleCount = items.length;
                    items.forEach((item, index) => {
                        item.querySelector('.card-title').textContent = `Ngày ${index + 1}`;
                        item.querySelectorAll('input, textarea').forEach(input => {
                            const oldName = input.getAttribute('name');
                            const newName = oldName.replace(/\[\d+\]/, `[${index}]`);
                            input.setAttribute('name', newName);
                        });
                    });
                };

                if (addButton) {
                    addButton.addEventListener('click', () => {
                        const newScheduleHTML = template.innerHTML.replace(/__INDEX__/g, scheduleCount).replace(/__INDEX_PLUS_1__/g, scheduleCount + 1);
                        const newScheduleDiv = document.createElement('div');
                        newScheduleDiv.innerHTML = newScheduleHTML;
                        const newItem = newScheduleDiv.firstElementChild;
                        container.appendChild(newItem);

                        const newEditorId = `schedule-editor-${name}-${scheduleCount}`;
                        if (typeof initCkEditor === 'function') {
                            initCkEditor(newEditorId);
                        }
                        addRemoveEvent(newItem.querySelector('.btn-remove-schedule'));
                        scheduleCount++;
                    });
                }

                container.querySelectorAll('.schedule-item').forEach(item => {
                    const textarea = item.querySelector('.ckeditor-textarea');
                    if (textarea && typeof initCkEditor === 'function') {
                        initCkEditor(textarea.id);
                    }
                    addRemoveEvent(item.querySelector('.btn-remove-schedule'));
                });
            });
        });
    </script>
@endpushonce
