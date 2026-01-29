<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $label }}</h3>
    </div>
    <div class="card-body">
        <div class="form-group">
            {{-- <label for="input-{{ $name }}">{{ $label }}</label> --}}
            <div class="input-group">
                <button type="button" class="btn btn-secondary btn-add-editor-{{ $name }}">Thêm</button>
            </div>
        </div>

        <div id="editor-container-{{ $name }}" class="mt-2">
            <ul class="list-group" id="list-{{$name}}">
                @if (is_array($value) && count($value) > 0)
                    @foreach ($value as $index => $item)
                        <li class="list-group-item d-flex align-items-start flex-column">
                            <textarea name="{{ $name }}[]" id="editor-{{ $name }}-{{ $index }}"
                                      class="form-control ckeditor-textarea">{!! $item !!}</textarea>
                            <div class="mt-2 d-flex justify-content-end w-100">
                                <button type="button" class="btn btn-danger btn-sm btn-remove-editor-{{$name}}"
                                        data-index="{{ $index }}">Xoá
                                </button>
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>

        @error($name)
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

@push("scripts")
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let list_{{$name}} = document.getElementById("list-{{$name}}");
            let buttonAdd_{{$name}} = document.querySelector(".btn-add-editor-{{$name}}");
            let editorCount = {{ is_array($value) ? count($value) : 0 }};

            buttonAdd_{{$name}}.addEventListener('click', function () {
                let li = document.createElement('li');
                li.classList.add('list-group-item', 'd-flex', 'align-items-start', 'flex-column');
                let editorId = `editor-{{ $name }}-${editorCount}`;
                li.innerHTML = `<textarea name="{{ $name }}[]" id="${editorId}" class="form-control ckeditor-textarea"></textarea>
                                  <div class="mt-2 d-flex justify-content-end w-100">
                                        <button type="button" class="btn btn-danger btn-sm btn-remove-editor-{{$name}}" data-index="${editorCount}">Xoá</button>
                                    </div>`;
                list_{{$name}}.appendChild(li);
                initCkEditor(editorId);
                addRemoveEvent(li.querySelector('.btn-remove-editor-{{$name}}'));
                editorCount++;
            });

            function addRemoveEvent(removeButton) {
                removeButton.addEventListener('click', function () {
                    let li = removeButton.closest('li');
                    let textarea = li.querySelector('.ckeditor-textarea');
                    let editorId = textarea.id;
                    if (window.__ckeditorInstances && window.__ckeditorInstances[editorId]) {
                        window.__ckeditorInstances[editorId].destroy();
                        delete window.__ckeditorInstances[editorId];
                    }
                    li.remove();
                });
            }

            list_{{$name}}.querySelectorAll('.ckeditor-textarea').forEach((textarea) => {
                initCkEditor(textarea.id);
            });
            list_{{$name}}.querySelectorAll('.btn-remove-editor-{{$name}}').forEach(button => {
                addRemoveEvent(button);
            });
        });
    </script>
@endpush
