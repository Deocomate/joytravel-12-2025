@extends('admin.layouts.main')
@section('title', 'Quản lý Điểm đến')

@push('styles')
    <style>
        .destination-stats {
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

        .quick-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

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

        .destination-table {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .destination-table thead th {
            background: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #495057;
            padding: 0.875rem 1rem;
        }
        .destination-table tbody tr:hover {
            background-color: #f8f9fa;
        }
        .destination-table td {
            vertical-align: middle;
            padding: 0.75rem 1rem;
        }
        .destination-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .destination-details .destination-name {
            font-weight: 600;
            color: #212529;
            margin-bottom: 0.25rem;
            max-width: 380px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .destination-details .destination-meta {
            font-size: 0.8rem;
            color: #6c757d;
        }
        .destination-details .destination-meta code {
            background: #e9ecef;
            padding: 0.15rem 0.4rem;
            border-radius: 4px;
            font-size: 0.75rem;
        }
        .count-badge {
            padding: 0.35rem 0.65rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.8rem;
            background: rgba(23,162,184,0.15);
            color: #17a2b8;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }
        .count-badge.empty {
            background: rgba(108,117,125,0.15);
            color: #6c757d;
        }
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }
        .action-buttons .btn {
            padding: 0.35rem 0.65rem;
        }
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

        @media (max-width: 768px) {
            .destination-stats {
                flex-direction: column;
            }
            .quick-actions {
                flex-direction: column;
                gap: 0.75rem;
                align-items: flex-start;
            }
        }
    </style>
@endpush

@section('content')
    <div class="destination-stats">
        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="fas fa-map-marked-alt"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $totalDestinations }}</div>
                <div class="stat-label">Tổng điểm đến</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green">
                <i class="fas fa-route"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $destinationsWithTours }}</div>
                <div class="stat-label">Có tour liên kết</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon orange">
                <i class="fas fa-circle-notch"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">{{ $destinationsWithoutTours }}</div>
                <div class="stat-label">Chưa gắn tour</div>
            </div>
        </div>
    </div>

    <div class="quick-actions">
        <h4 class="mb-0"><i class="fas fa-map-marker-alt mr-2"></i>Danh sách Điểm đến</h4>
        <a href="{{ route('admin.destinations.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-1"></i> Tạo điểm đến
        </a>
    </div>

    <div class="card filter-card" id="filterCard">
        <div class="card-header d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#filterBody">
            <span><i class="fas fa-filter mr-2"></i>Bộ lọc nhanh</span>
            <i class="fas fa-chevron-down filter-toggle-icon"></i>
        </div>
        <div class="collapse {{ request()->hasAny(['search', 'has_tours']) ? 'show' : '' }}" id="filterBody">
            <div class="card-body">
                <form action="{{ route('admin.destinations.index') }}" method="GET">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><i class="fas fa-search mr-1"></i>Tìm kiếm</label>
                                <input type="text" name="search" class="form-control"
                                       value="{{ request('search') }}"
                                       placeholder="Tên hoặc slug điểm đến...">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <x-admin.inputs.select label="Tour gắn kết" name="has_tours">
                                <option value="">Tất cả</option>
                                <option value="with" @selected(request('has_tours') === 'with')>Có tour</option>
                                <option value="without" @selected(request('has_tours') === 'without')>Chưa có tour</option>
                            </x-admin.inputs.select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2 mt-2">
                        <a href="{{ route('admin.destinations.index') }}" class="btn btn-outline-secondary mr-2">
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

    <div class="card destination-table">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width: 70px;">ID</th>
                        <th>Điểm đến</th>
                        <th style="width: 160px;">Tour liên kết</th>
                        <th style="width: 140px;">Cập nhật</th>
                        <th style="width: 150px;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($destinations as $destination)
                        <tr>
                            <td>
                                <span class="text-muted">#{{ $destination->id }}</span>
                            </td>
                            <td>
                                <div class="destination-info">
                                    <div class="destination-details">
                                        <div class="destination-name" title="{{ $destination->name }}">
                                            {{ $destination->name }}
                                        </div>
                                        <div class="destination-meta">
                                            <code>{{ $destination->slug }}</code>
                                            @if($destination->description)
                                                <span class="ml-2">
                                                    {{ \Illuminate\Support\Str::limit(strip_tags($destination->description), 80) }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($destination->tours_count > 0)
                                    <a href="{{ route('admin.tours.index', ['destination_id' => $destination->id]) }}"
                                       class="count-badge">
                                        <i class="fas fa-route"></i>{{ $destination->tours_count }}
                                    </a>
                                @else
                                    <span class="count-badge empty">
                                        <i class="fas fa-circle"></i>0
                                    </span>
                                @endif
                            </td>
                            <td>
                                {{ optional($destination->updated_at)->format('d/m/Y') }}
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.destinations.edit', $destination) }}"
                                       class="btn btn-outline-warning btn-sm" title="Sửa điểm đến">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.destinations.destroy', $destination) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm"
                                                title="Xóa điểm đến"
                                                onclick="return confirm('Bạn có chắc muốn xóa điểm đến \"{{ $destination->name }}\"?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <i class="fas fa-map-signs"></i>
                                    </div>
                                    <h4>Chưa có điểm đến nào</h4>
                                    <p>Bắt đầu bằng cách tạo điểm đến đầu tiên của bạn</p>
                                    <a href="{{ route('admin.destinations.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus mr-1"></i> Tạo điểm đến
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($destinations->hasPages())
            <div class="card-footer d-flex justify-content-between align-items-center">
                <div class="text-muted">
                    Hiển thị {{ $destinations->firstItem() }}-{{ $destinations->lastItem() }} / {{ $destinations->total() }} điểm đến
                </div>
                {{ $destinations->links() }}
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        $(function () {
            $('#filterBody').on('show.bs.collapse', function () {
                $('#filterCard').removeClass('collapsed');
            }).on('hide.bs.collapse', function () {
                $('#filterCard').addClass('collapsed');
            });

            @if(!request()->hasAny(['search', 'has_tours']))
                $('#filterCard').addClass('collapsed');
            @endif
        });
    </script>
@endpush
