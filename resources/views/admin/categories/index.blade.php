@extends('admin.layouts.main')
@section('title','Quản lý Danh mục')

@push('styles')
    <style>
        /* Stats Cards */
        .category-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.25rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: transform 0.2s ease;
        }
        .stat-card:hover {
            transform: translateY(-2px);
        }
        .stat-card .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }
        .stat-card .stat-icon.tour { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
        .stat-card .stat-icon.news { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; }
        .stat-card .stat-icon.total { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; }
        .stat-card .stat-content .stat-value {
            font-size: 1.75rem;
            font-weight: 700;
            color: #212529;
            line-height: 1;
        }
        .stat-card .stat-content .stat-label {
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 0.25rem;
        }

        /* Header Actions */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .page-header h4 {
            margin: 0;
            font-weight: 600;
        }
        .header-actions {
            display: flex;
            gap: 0.5rem;
        }

        /* Filter Card */
        .filter-card {
            background: white;
            border-radius: 12px;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
        }
        .filter-card .filter-label {
            font-weight: 500;
            color: #495057;
            white-space: nowrap;
        }
        .filter-card .filter-buttons {
            display: flex;
            gap: 0.5rem;
        }
        .filter-card .filter-btn {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            border: 2px solid #e9ecef;
            background: white;
            color: #6c757d;
            font-weight: 500;
            transition: all 0.2s ease;
            cursor: pointer;
            text-decoration: none;
        }
        .filter-card .filter-btn:hover {
            border-color: #007bff;
            color: #007bff;
            text-decoration: none;
        }
        .filter-card .filter-btn.active {
            background: #007bff;
            border-color: #007bff;
            color: white;
        }
        .filter-card .filter-btn.tour.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: #667eea;
        }
        .filter-card .filter-btn.news.active {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            border-color: #f093fb;
        }

        /* Tree Container */
        .tree-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        .tree-header {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.5rem;
        }
        .tree-header h5 {
            margin: 0;
            font-weight: 600;
            color: #495057;
        }
        .tree-header .helper-text {
            font-size: 0.8rem;
            color: #6c757d;
        }
        .tree-body {
            padding: 1rem;
            min-height: 200px;
        }

        /* Category List - SortableJS */
        .category-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .category-list .category-list {
            margin-left: 2.5rem;
            margin-top: 0.5rem;
        }
        .category-list .category-list:empty {
            display: none;
        }

        /* Category Item */
        .category-item {
            margin-bottom: 0.5rem;
        }
        .category-card {
            display: flex;
            align-items: center;
            background: #f8f9fa;
            border: 2px solid transparent;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.2s ease;
        }
        .category-card:hover {
            border-color: #007bff;
            box-shadow: 0 4px 12px rgba(0,123,255,0.15);
        }

        /* Drag Handle */
        .drag-handle {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            min-height: 56px;
            cursor: grab;
            background: #e9ecef;
            border-right: 1px solid #dee2e6;
            transition: all 0.2s ease;
            flex-shrink: 0;
        }
        .drag-handle:hover {
            background: #007bff;
        }
        .drag-handle:hover i {
            color: white;
        }
        .drag-handle:active {
            cursor: grabbing;
        }
        .drag-handle i {
            color: #6c757d;
            font-size: 1rem;
            transition: color 0.2s ease;
        }

        /* Category Thumbnail */
        .category-thumb {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            object-fit: cover;
            margin: 0 0.75rem;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            flex-shrink: 0;
        }
        .category-thumb-placeholder {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: #dee2e6;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 0.75rem;
            color: #adb5bd;
            flex-shrink: 0;
        }

        /* Category Info */
        .category-info {
            flex-grow: 1;
            padding: 0.75rem 0;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.5rem;
            min-width: 0;
        }
        .category-name {
            font-weight: 600;
            color: #212529;
            font-size: 0.95rem;
        }

        /* Badges */
        .category-badges {
            display: flex;
            gap: 0.35rem;
            flex-wrap: wrap;
        }
        .cat-badge {
            padding: 0.25rem 0.6rem;
            border-radius: 6px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }
        .cat-badge.tour {
            background: rgba(102,126,234,0.15);
            color: #667eea;
        }
        .cat-badge.news {
            background: rgba(245,87,108,0.15);
            color: #f5576c;
        }
        .cat-badge.active {
            background: rgba(40,167,69,0.15);
            color: #28a745;
        }
        .cat-badge.inactive {
            background: rgba(220,53,69,0.15);
            color: #dc3545;
        }

        /* Actions */
        .category-actions {
            display: flex;
            padding: 0 1rem;
            gap: 0.5rem;
            flex-shrink: 0;
        }
        .category-actions .btn {
            width: 32px;
            height: 32px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        .category-actions .btn:hover {
            transform: scale(1.1);
        }

        /* SortableJS States */
        .sortable-ghost {
            opacity: 0.4;
        }
        .sortable-ghost .category-card {
            border-color: #007bff;
            background: #e3f2fd;
        }
        .sortable-chosen .category-card {
            border-color: #007bff;
            box-shadow: 0 8px 24px rgba(0,123,255,0.3);
        }
        .sortable-drag {
            opacity: 1 !important;
        }

        /* Drop placeholder */
        .sortable-placeholder {
            background: #f0f7ff;
            border: 2px dashed #007bff;
            border-radius: 10px;
            min-height: 56px;
            margin-bottom: 0.5rem;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
        }
        .empty-state .empty-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            background: #f8f9fa;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: #adb5bd;
        }
        .empty-state h5 {
            color: #6c757d;
            margin-bottom: 0.5rem;
        }
        .empty-state p {
            color: #adb5bd;
            margin-bottom: 1.5rem;
        }

        /* Save Button - Floating */
        .save-order-btn {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            z-index: 1000;
            padding: 1rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            box-shadow: 0 4px 20px rgba(40,167,69,0.4);
            display: none;
            animation: slideUp 0.3s ease;
        }
        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .category-stats {
                grid-template-columns: 1fr;
            }
            .filter-card {
                flex-direction: column;
                align-items: stretch;
            }
            .filter-card .filter-buttons {
                flex-wrap: wrap;
            }
            .category-info {
                flex-direction: column;
                align-items: flex-start;
            }
            .category-thumb, .category-thumb-placeholder {
                display: none;
            }
            .category-list .category-list {
                margin-left: 1rem;
            }
        }
    </style>
@endpush

@section('content')
    @php
        $countTour = 0;
        $countNews = 0;
        $countAll = 0;

        $countRecursive = function($items) use (&$countRecursive, &$countTour, &$countNews, &$countAll) {
            foreach ($items as $item) {
                $countAll++;
                if ($item['type'] === 'TOUR') $countTour++;
                if ($item['type'] === 'NEWS') $countNews++;
                if (!empty($item['children'])) {
                    $countRecursive($item['children']);
                }
            }
        };
        $countRecursive($categoryTree);
    @endphp

    {{-- Stats Overview --}}
    <div class="category-stats">
        <div class="stat-card">
            <div class="stat-icon total">
                <i class="fas fa-layer-group"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $countAll }}</div>
                <div class="stat-label">Tổng danh mục</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon tour">
                <i class="fas fa-suitcase-rolling"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $countTour }}</div>
                <div class="stat-label">Danh mục Tour</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon news">
                <i class="fas fa-newspaper"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $countNews }}</div>
                <div class="stat-label">Danh mục Tin tức</div>
            </div>
        </div>
    </div>

    {{-- Page Header --}}
    <div class="page-header">
        <h4><i class="fas fa-folder-tree mr-2"></i>Cây danh mục</h4>
        <div class="header-actions">
            <a href="{{ route('admin.categories.add-to-tour.create') }}" class="btn btn-outline-info">
                <i class="fas fa-link mr-1"></i> Gán danh mục cho Tour
            </a>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                <i class="fas fa-plus mr-1"></i> Tạo danh mục mới
            </a>
        </div>
    </div>

    {{-- Filter --}}
    <div class="filter-card">
        <span class="filter-label"><i class="fas fa-filter mr-2"></i>Lọc theo loại:</span>
        <div class="filter-buttons">
            <a href="{{ route('admin.categories.index') }}" class="filter-btn {{ !$selectedType ? 'active' : '' }}">
                <i class="fas fa-th-list mr-1"></i> Tất cả
            </a>
            <a href="{{ route('admin.categories.index', ['type' => 'TOUR']) }}" class="filter-btn tour {{ $selectedType === 'TOUR' ? 'active' : '' }}">
                <i class="fas fa-suitcase-rolling mr-1"></i> Tour
            </a>
            <a href="{{ route('admin.categories.index', ['type' => 'NEWS']) }}" class="filter-btn news {{ $selectedType === 'NEWS' ? 'active' : '' }}">
                <i class="fas fa-newspaper mr-1"></i> Tin tức
            </a>
        </div>
    </div>

    @include('admin.partials.alerts')

    {{-- Tree Container --}}
    <div class="tree-container">
        <div class="tree-header">
            <h5><i class="fas fa-sitemap mr-2"></i>Cấu trúc danh mục</h5>
            <span class="helper-text">
                <i class="fas fa-hand-pointer mr-1"></i>
                Kéo thả để thay đổi thứ tự hoặc tạo danh mục con
            </span>
        </div>
        <div class="tree-body">
            @if(!empty($categoryTree) && count($categoryTree) > 0)
                <ul class="category-list" id="category-root-list">
                    @foreach ($categoryTree as $item)
                        @include('admin.categories.partials.category_item', ['item' => $item, 'level' => 0])
                    @endforeach
                </ul>
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-folder-open"></i>
                    </div>
                    <h5>Chưa có danh mục nào</h5>
                    <p>Bắt đầu bằng cách tạo danh mục đầu tiên</p>
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus mr-1"></i> Tạo danh mục mới
                    </a>
                </div>
            @endif
        </div>
    </div>

    {{-- Floating Save Button --}}
    <button id="save-category-order" class="btn btn-success save-order-btn">
        <i class="fas fa-save mr-2"></i> Lưu thay đổi
    </button>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let hasChanges = false;
            const saveButton = document.getElementById('save-category-order');

            // Simple notification function
            function showNotification(message, type) {
                const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
                const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
                const alertHtml = `
                    <div class="alert ${alertClass} alert-dismissible fade show position-fixed"
                         style="top: 20px; right: 20px; z-index: 9999; min-width: 300px; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
                        <i class="fas ${icon} mr-2"></i>${message}
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                `;
                const alertEl = $(alertHtml).appendTo('body');
                setTimeout(() => alertEl.fadeOut(300, function() { $(this).remove(); }), 3000);
            }

            // Initialize all sortable lists
            function initSortable(listElement) {
                if (!listElement) return;

                new Sortable(listElement, {
                    group: 'categories',
                    animation: 150,
                    fallbackOnBody: true,
                    swapThreshold: 0.65,
                    handle: '.drag-handle',
                    ghostClass: 'sortable-ghost',
                    chosenClass: 'sortable-chosen',
                    dragClass: 'sortable-drag',
                    onEnd: function(evt) {
                        hasChanges = true;
                        $(saveButton).fadeIn();
                    }
                });
            }

            // Initialize root list
            initSortable(document.getElementById('category-root-list'));

            // Initialize all nested lists
            document.querySelectorAll('.category-children').forEach(function(list) {
                initSortable(list);
            });

            // Build tree data from DOM
            function buildTreeData(listElement) {
                const items = [];
                if (!listElement) return items;

                listElement.querySelectorAll(':scope > .category-item').forEach(function(item) {
                    const id = item.dataset.id;
                    const childrenList = item.querySelector(':scope > .category-children');
                    const children = childrenList ? buildTreeData(childrenList) : [];

                    items.push({
                        id: parseInt(id),
                        children: children
                    });
                });

                return items;
            }

            // Save Order
            saveButton.addEventListener('click', function(e) {
                e.preventDefault();
                if (!hasChanges) return;

                const treeData = buildTreeData(document.getElementById('category-root-list'));
                const button = this;

                button.disabled = true;
                button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Đang lưu...';

                fetch('{{ route("admin.categories.updateOrder") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        categoryData: JSON.stringify(treeData)
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification('Đã lưu thứ tự danh mục thành công!', 'success');
                        button.innerHTML = '<i class="fas fa-check mr-2"></i> Đã lưu!';
                        hasChanges = false;
                        setTimeout(() => {
                            $(button).fadeOut(300, function() {
                                button.innerHTML = '<i class="fas fa-save mr-2"></i> Lưu thay đổi';
                                button.disabled = false;
                            });
                        }, 1500);
                    } else {
                        showNotification('Lỗi: ' + (data.message || 'Không thể cập nhật.'), 'error');
                        button.disabled = false;
                        button.innerHTML = '<i class="fas fa-save mr-2"></i> Lưu thay đổi';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Lỗi kết nối. Vui lòng thử lại.', 'error');
                    button.disabled = false;
                    button.innerHTML = '<i class="fas fa-save mr-2"></i> Lưu thay đổi';
                });
            });

            // Keyboard shortcut: Ctrl+S to save
            document.addEventListener('keydown', function(e) {
                if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                    e.preventDefault();
                    if (hasChanges) {
                        saveButton.click();
                    }
                }
            });

            // Warn before leaving if there are unsaved changes
            window.addEventListener('beforeunload', function(e) {
                if (hasChanges) {
                    e.preventDefault();
                    e.returnValue = '';
                }
            });
        });
    </script>
@endpush
