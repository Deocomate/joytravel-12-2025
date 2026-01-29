<li class="category-item" data-id="{{ $item['id'] }}">
    <div class="category-card">
        {{-- Drag Handle --}}
        <div class="drag-handle">
            <i class="fas fa-grip-vertical"></i>
        </div>

        {{-- Thumbnail --}}
        @if(!empty($item['thumbnail']))
            <img src="{{ url($item['thumbnail']) }}" alt="{{ $item['name'] }}" class="category-thumb">
        @else
            <div class="category-thumb-placeholder">
                <i class="fas fa-folder"></i>
            </div>
        @endif

        {{-- Category Info --}}
        <div class="category-info">
            <span class="category-name">{{ $item['name'] }}</span>
            <div class="category-badges">
                <span class="cat-badge {{ strtolower($item['type']) }}">
                    <i class="fas {{ $item['type'] === 'TOUR' ? 'fa-suitcase-rolling' : 'fa-newspaper' }} mr-1"></i>
                    {{ $item['type'] }}
                </span>
                <span class="cat-badge {{ $item['is_active'] ? 'active' : 'inactive' }}">
                    <i class="fas {{ $item['is_active'] ? 'fa-check-circle' : 'fa-times-circle' }} mr-1"></i>
                    {{ $item['is_active'] ? 'Hoạt động' : 'Ẩn' }}
                </span>
            </div>
        </div>

        {{-- Actions --}}
        <div class="category-actions">
            <a href="{{ route('admin.categories.edit', ['category' => $item['id']]) }}"
               class="btn btn-sm btn-outline-warning" title="Chỉnh sửa">
                <i class="fas fa-edit"></i>
            </a>
            <form action="{{ route('admin.categories.destroy', ['category' => $item['id']]) }}"
                  method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger" title="Xóa"
                        onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục &quot;{{ $item['name'] }}&quot;?\n\nCác danh mục con (nếu có) cũng sẽ bị xóa.')">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </div>
    </div>

    {{-- Children --}}
    @if (!empty($item['children']) && count($item['children']) > 0)
        <ul class="category-list category-children">
            @foreach ($item['children'] as $child)
                @include('admin.categories.partials.category_item', ['item' => $child])
            @endforeach
        </ul>
    @endif
</li>
