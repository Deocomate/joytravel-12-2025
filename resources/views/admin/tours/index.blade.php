@extends('admin.layouts.main')
@section('title', 'Quản lý Tour')

@push('styles')
    <style>
        /* Header Stats */
        .tour-stats {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        .stat-card {
            flex: 1;
            background: white;
            border-radius: 8px;
            padding: 1rem 1.25rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .stat-card .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }
        .stat-card .stat-icon.blue { background: rgba(0,123,255,0.15); color: #007bff; }
        .stat-card .stat-icon.green { background: rgba(40,167,69,0.15); color: #28a745; }
        .stat-card .stat-icon.orange { background: rgba(253,126,20,0.15); color: #fd7e14; }
        .stat-card .stat-content .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #212529;
            line-height: 1.2;
        }
        .stat-card .stat-content .stat-label {
            font-size: 0.8rem;
            color: #6c757d;
        }

        /* Filter Card */
        .filter-card {
            border-radius: 8px;
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            margin-bottom: 1.5rem;
        }
        .filter-card .card-header {
            background: white;
            border-bottom: 1px solid #e9ecef;
            cursor: pointer;
        }
        .filter-card .card-header:hover {
            background: #f8f9fa;
        }
        .filter-card .filter-toggle-icon {
            transition: transform 0.2s ease;
        }
        .filter-card.collapsed .filter-toggle-icon {
            transform: rotate(-90deg);
        }

        /* Tour Table */
        .tour-table {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .tour-table thead th {
            background: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #495057;
            padding: 0.875rem 1rem;
        }
        .tour-table tbody tr {
            transition: background-color 0.15s ease;
        }
        .tour-table tbody tr:hover {
            background-color: #f8f9fa;
        }
        .tour-table td {
            vertical-align: middle;
            padding: 0.75rem 1rem;
        }

        /* Tour Card in Table */
        .tour-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .tour-thumbnail {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        }
        .tour-thumbnail-placeholder {
            width: 80px;
            height: 60px;
            background: #e9ecef;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #adb5bd;
        }
        .tour-details .tour-name {
            font-weight: 600;
            color: #212529;
            margin-bottom: 0.25rem;
            max-width: 300px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .tour-details .tour-code {
            font-size: 0.8rem;
            color: #6c757d;
        }
        .tour-details .tour-code code {
            background: #e9ecef;
            padding: 0.15rem 0.4rem;
            border-radius: 4px;
            font-size: 0.75rem;
        }

        /* Price Display */
        .price-display {
            font-weight: 600;
            color: #28a745;
        }
        .price-display .currency {
            font-size: 0.8rem;
            font-weight: normal;
            color: #6c757d;
        }

        /* Slots Badge */
        .slots-badge {
            padding: 0.35rem 0.65rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.8rem;
        }
        .slots-badge.available { background: rgba(40,167,69,0.15); color: #28a745; }
        .slots-badge.low { background: rgba(255,193,7,0.15); color: #856404; }
        .slots-badge.sold-out { background: rgba(220,53,69,0.15); color: #dc3545; }

        /* Category Badges */
        .category-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 0.25rem;
        }
        .category-badge {
            font-size: 0.7rem;
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
            background: rgba(23,162,184,0.15);
            color: #17a2b8;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }
        .action-buttons .btn {
            padding: 0.35rem 0.65rem;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
        }
        .empty-state .empty-icon {
            font-size: 4rem;
            color: #dee2e6;
            margin-bottom: 1rem;
        }
        .empty-state h4 {
            color: #6c757d;
            margin-bottom: 0.5rem;
        }
        .empty-state p {
            color: #adb5bd;
            margin-bottom: 1.5rem;
        }

        /* Quick Actions Header */
        .quick-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .tour-stats {
                flex-direction: column;
            }
            .tour-info {
                flex-direction: column;
                align-items: flex-start;
            }
            .tour-thumbnail {
                width: 100%;
                height: 120px;
            }
        }
    </style>
@endpush

@section('content')
    {{-- Stats Overview --}}
    <div class="tour-stats">
        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="fas fa-suitcase-rolling"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $tours->total() }}</div>
                <div class="stat-label">Tổng số tour</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $tours->where('remaining_slots', '>', 0)->count() }}</div>
                <div class="stat-label">Tour còn chỗ</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon orange">
                <i class="fas fa-folder"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $categories->count() }}</div>
                <div class="stat-label">Danh mục</div>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="quick-actions">
        <h4 class="mb-0"><i class="fas fa-list mr-2"></i>Danh sách Tour</h4>
        <a href="{{ route('admin.tours.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-1"></i> Tạo tour mới
        </a>
    </div>

    {{-- Filter Card --}}
    <div class="card filter-card" id="filterCard">
        <div class="card-header d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#filterBody">
            <span><i class="fas fa-filter mr-2"></i>Bộ lọc nâng cao</span>
            <i class="fas fa-chevron-down filter-toggle-icon"></i>
        </div>
        <div class="collapse {{ request()->hasAny(['search', 'category_id', 'destination_id', 'price_from']) ? 'show' : '' }}" id="filterBody">
            <div class="card-body">
                <form action="{{ route('admin.tours.index') }}" method="GET" id="filter-form">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><i class="fas fa-search mr-1"></i>Tìm kiếm</label>
                                <input type="text" name="search" class="form-control"
                                       value="{{ request('search') }}"
                                       placeholder="Tên hoặc mã tour...">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <x-admin.inputs.select label="Danh mục" name="category_id" :searchable="true">
                                <option value="">Tất cả danh mục</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </x-admin.inputs.select>
                        </div>
                        <div class="col-md-3">
                            <x-admin.inputs.select label="Điểm đến" name="destination_id" :searchable="true">
                                <option value="">Tất cả điểm đến</option>
                                @foreach($destinations as $destination)
                                    <option value="{{ $destination->id }}" @selected(request('destination_id') == $destination->id)>
                                        {{ $destination->name }}
                                    </option>
                                @endforeach
                            </x-admin.inputs.select>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><i class="fas fa-dollar-sign mr-1"></i>Khoảng giá</label>
                                <input id="price_range_slider" type="text">
                                <input type="hidden" name="price_from" id="price_from" value="{{ request('price_from') }}">
                                <input type="hidden" name="price_to" id="price_to" value="{{ request('price_to') }}">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2 mt-2">
                        <a href="{{ route('admin.tours.index') }}" class="btn btn-outline-secondary mr-2">
                            <i class="fas fa-undo mr-1"></i>Đặt lại
                        </a>
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search mr-1"></i>Tìm kiếm
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Tour Table --}}
    <div class="card tour-table">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width: 50px;">ID</th>
                        <th style="min-width: 350px;">Thông tin tour</th>
                        <th>Danh mục</th>
                        <th>Giá người lớn</th>
                        <th style="width: 100px;">Số chỗ</th>
                        <th style="width: 150px;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tours as $tour)
                        <tr>
                            <td>
                                <span class="text-muted">#{{ $tour->id }}</span>
                            </td>
                            <td>
                                <div class="tour-info">
                                    @if($tour->thumbnail)
                                        <img src="{{ url($tour->thumbnail) }}" alt="{{ $tour->name }}" class="tour-thumbnail">
                                    @else
                                        <div class="tour-thumbnail-placeholder">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                    <div class="tour-details">
                                        <div class="tour-name" title="{{ $tour->name }}">{{ $tour->name }}</div>
                                        <div class="tour-code">
                                            <code>{{ $tour->tour_code }}</code>
                                            @if($tour->duration)
                                                <span class="ml-2"><i class="fas fa-clock text-muted"></i> {{ $tour->duration }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="category-badges">
                                    @foreach($tour->categories->take(3) as $category)
                                        <span class="category-badge">{{ $category->name }}</span>
                                    @endforeach
                                    @if($tour->categories->count() > 3)
                                        <span class="category-badge">+{{ $tour->categories->count() - 3 }}</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="price-display">
                                    {{ number_format($tour->price_adult) }}
                                    <span class="currency">đ</span>
                                </div>
                            </td>
                            <td>
                                @php
                                    $slots = $tour->remaining_slots ?? 0;
                                    $slotClass = $slots > 10 ? 'available' : ($slots > 0 ? 'low' : 'sold-out');
                                @endphp
                                <span class="slots-badge {{ $slotClass }}">
                                    @if($slots > 0)
                                        <i class="fas fa-users mr-1"></i>{{ $slots }}
                                    @else
                                        <i class="fas fa-times-circle mr-1"></i>Hết
                                    @endif
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('client.tour.show', $tour) }}" target="_blank"
                                       class="btn btn-outline-info btn-sm" title="Xem trang tour">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                    <a href="{{ route('admin.tours.edit', $tour) }}"
                                       class="btn btn-outline-warning btn-sm" title="Sửa tour">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.tours.destroy', $tour) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm"
                                                title="Xóa tour"
                                                onclick="return confirm('Bạn có chắc muốn xóa tour \"{{ $tour->name }}\"?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <i class="fas fa-suitcase-rolling"></i>
                                    </div>
                                    <h4>Chưa có tour nào</h4>
                                    <p>Bắt đầu bằng cách tạo tour đầu tiên của bạn</p>
                                    <a href="{{ route('admin.tours.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus mr-1"></i> Tạo tour mới
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($tours->hasPages())
            <div class="card-footer d-flex justify-content-between align-items-center">
                <div class="text-muted">
                    Hiển thị {{ $tours->firstItem() }}-{{ $tours->lastItem() }} / {{ $tours->total() }} tour
                </div>
                {{ $tours->links() }}
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        $(function () {
            // Price Range Slider
            $('#price_range_slider').ionRangeSlider({
                type: 'double',
                grid: true,
                min: 0,
                max: 25000000,
                from: {{ request('price_from', 0) }},
                to: {{ request('price_to', 25000000) }},
                prefix: '',
                postfix: 'đ',
                step: 500000,
                prettify_separator: '.',
                onFinish: function (data) {
                    $('#price_from').val(data.from);
                    $('#price_to').val(data.to);
                },
            });

            // Filter card collapse toggle icon
            $('#filterBody').on('show.bs.collapse', function () {
                $('#filterCard').removeClass('collapsed');
            }).on('hide.bs.collapse', function () {
                $('#filterCard').addClass('collapsed');
            });

            // Initialize as collapsed if no filters active
            @if(!request()->hasAny(['search', 'category_id', 'destination_id', 'price_from']))
                $('#filterCard').addClass('collapsed');
            @endif
        });
    </script>
@endpush
