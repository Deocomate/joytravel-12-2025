@php
    $isEdit = isset($tour);
@endphp

@extends('admin.layouts.main')
@section('title', $isEdit ? 'Sửa Tour: ' . ($tour->name ?? '') : 'Tạo Tour Mới')

@push('styles')
    <style>
        /* Tab Navigation - Card Style */
        .tour-tabs-wrapper {
            background: #fff;
            border-radius: 12px;
            padding: 0.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .nav-tabs-custom {
            border: none;
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }
        .nav-tabs-custom .nav-item {
            flex: 1;
            min-width: 120px;
        }
        .nav-tabs-custom .nav-link {
            border: none;
            border-radius: 8px;
            color: #6c757d;
            font-weight: 500;
            padding: 0.875rem 1rem;
            transition: all 0.2s ease;
            text-align: center;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        .nav-tabs-custom .nav-link:hover {
            color: #007bff;
            background: #e3f2fd;
        }
        .nav-tabs-custom .nav-link.active {
            color: #fff;
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            box-shadow: 0 4px 12px rgba(0,123,255,0.3);
        }
        .nav-tabs-custom .nav-link i {
            font-size: 1rem;
        }
        .nav-tabs-custom .nav-link .tab-text {
            font-size: 0.875rem;
        }

        /* Quick Info Card */
        .quick-info-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            color: white;
            margin-bottom: 1.5rem;
            border: none;
            box-shadow: 0 4px 15px rgba(102,126,234,0.4);
        }
        .quick-info-card .card-header {
            background: transparent;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            color: white;
            padding: 1rem 1.25rem;
        }
        .quick-info-card .card-header .card-title {
            font-size: 1rem;
            font-weight: 600;
            margin: 0;
        }
        .quick-info-card .card-body {
            padding: 1.25rem;
        }
        .quick-info-card .form-control {
            background: rgba(255,255,255,0.95);
            border: 2px solid transparent;
            border-radius: 8px;
        }
        .quick-info-card .form-control:focus {
            background: white;
            border-color: rgba(255,255,255,0.5);
            box-shadow: 0 0 0 3px rgba(255,255,255,0.2);
        }
        .quick-info-card .form-control.is-invalid {
            border-color: #dc3545;
        }
        .quick-info-card label {
            color: rgba(255,255,255,0.95);
            font-weight: 500;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
        }
        .quick-info-card .form-group {
            margin-bottom: 0;
        }

        /* Pricing Grid */
        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }
        .pricing-card {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 1rem;
            border-left: 4px solid;
            transition: all 0.2s ease;
        }
        .pricing-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .pricing-card.adult { border-left-color: #28a745; }
        .pricing-card.child { border-left-color: #17a2b8; }
        .pricing-card.toddler { border-left-color: #ffc107; }
        .pricing-card.infant { border-left-color: #dc3545; }
        .pricing-card .price-label {
            font-size: 0.8rem;
            color: #6c757d;
            margin-bottom: 0.25rem;
        }
        .pricing-card .price-label .age-range {
            font-weight: normal;
            opacity: 0.8;
        }
        .pricing-card input {
            font-size: 1.1rem;
            font-weight: 600;
        }

        /* Itinerary Section */
        .itinerary-list .list-group-item {
            cursor: move;
            background-color: #f8f9fa;
            border-left: 3px solid #007bff;
            margin-bottom: 0.5rem;
            border-radius: 4px;
            transition: all 0.2s ease;
        }
        .itinerary-list .list-group-item:hover {
            background-color: #e9ecef;
        }
        .itinerary-list .list-group-item .handle {
            cursor: grab;
            color: #6c757d;
        }
        .itinerary-list .list-group-item .destination-name {
            font-weight: 500;
        }
        .itinerary-list .list-group-item .destination-order {
            background: #007bff;
            color: white;
            padding: 0.2rem 0.5rem;
            border-radius: 50%;
            font-size: 0.75rem;
            margin-right: 0.5rem;
            min-width: 24px;
            text-align: center;
            display: inline-block;
        }

        /* Section Cards */
        .section-card {
            border-radius: 8px;
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            margin-bottom: 1.5rem;
        }
        .section-card .card-header {
            background: white;
            border-bottom: 1px solid #e9ecef;
            padding: 1rem 1.25rem;
        }
        .section-card .card-header h3 {
            margin: 0;
            font-size: 1rem;
            font-weight: 600;
            color: #495057;
        }
        .section-card .card-header .section-icon {
            color: #007bff;
            margin-right: 0.5rem;
        }

        /* Helper Text */
        .helper-text {
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 0.25rem;
        }

        /* Submit Footer */
        .submit-footer {
            position: sticky;
            bottom: 0;
            background: white;
            padding: 1rem 1.5rem;
            margin: 0 -1.25rem;
            border-top: 1px solid #e9ecef;
            box-shadow: 0 -4px 12px rgba(0,0,0,0.05);
            z-index: 100;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .nav-tabs-custom .nav-item {
                min-width: 80px;
            }
            .nav-tabs-custom .nav-link {
                padding: 0.75rem 0.5rem;
                flex-direction: column;
                gap: 0.25rem;
            }
            .nav-tabs-custom .nav-link .tab-text {
                font-size: 0.75rem;
            }
        }
        @media (max-width: 768px) {
            .pricing-grid {
                grid-template-columns: 1fr;
            }
            .quick-info-card .row > div {
                margin-bottom: 1rem;
            }
            .quick-info-card .row > div:last-child {
                margin-bottom: 0;
            }
        }
        @media (max-width: 576px) {
            .nav-tabs-custom .nav-link .tab-text {
                display: none;
            }
            .nav-tabs-custom .nav-link i {
                font-size: 1.25rem;
            }
            .nav-tabs-custom .nav-item {
                min-width: 50px;
            }
        }
    </style>
@endpush

@section('content')
    <form action="{{ $isEdit ? route('admin.tours.update', $tour) : route('admin.tours.store') }}" method="POST" novalidate>
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        {{-- Error Alert --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                <strong>Có lỗi xảy ra!</strong> Vui lòng kiểm tra lại các trường được đánh dấu đỏ.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        {{-- Quick Info Card - Always Visible --}}
        <div class="card quick-info-card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-bolt mr-2"></i>Thông tin nhanh</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-tag mr-1"></i>Tên tour <span class="text-warning">*</span></label>
                            <input type="text" name="name" class="form-control form-control-lg {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                   value="{{ old('name', $tour->name ?? '') }}" placeholder="VD: Tour Hạ Long 3N2Đ" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><i class="fas fa-barcode mr-1"></i>Mã tour <span class="text-warning">*</span></label>
                            <input type="text" name="tour_code" class="form-control form-control-lg {{ $errors->has('tour_code') ? 'is-invalid' : '' }}"
                                   value="{{ old('tour_code', $tour->tour_code ?? '') }}" placeholder="VD: HL-001" required>
                            @error('tour_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><i class="fas fa-clock mr-1"></i>Thời gian</label>
                            <input type="text" name="duration" class="form-control form-control-lg"
                                   value="{{ old('duration', $tour->duration ?? '') }}" placeholder="VD: 3N2Đ">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tab Navigation --}}
        <div class="tour-tabs-wrapper">
            <ul class="nav nav-tabs nav-tabs-custom" id="tourTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="basic-tab" data-toggle="tab" href="#basic" role="tab">
                        <i class="fas fa-info-circle"></i>
                        <span class="tab-text">Cơ bản</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pricing-tab" data-toggle="tab" href="#pricing" role="tab">
                        <i class="fas fa-tags"></i>
                        <span class="tab-text">Giá vé</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="itinerary-tab" data-toggle="tab" href="#itinerary" role="tab">
                        <i class="fas fa-route"></i>
                        <span class="tab-text">Hành trình</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="content-tab" data-toggle="tab" href="#content" role="tab">
                        <i class="fas fa-align-left"></i>
                        <span class="tab-text">Nội dung</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="media-tab" data-toggle="tab" href="#media" role="tab">
                        <i class="fas fa-images"></i>
                        <span class="tab-text">Hình ảnh</span>
                    </a>
                </li>
            </ul>
        </div>

        {{-- Tab Content --}}
        <div class="tab-content" id="tourTabsContent">
            {{-- Tab 1: Basic Info --}}
            <div class="tab-pane fade show active" id="basic" role="tabpanel">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card section-card">
                            <div class="card-header">
                                <h3><i class="fas fa-align-left section-icon"></i>Mô tả tour</h3>
                            </div>
                            <div class="card-body">
                                <x-admin.inputs.text-area label="Mô tả ngắn" name="short_description"
                                    :value="old('short_description', $tour->short_description ?? '')"
                                    placeholder="Tóm tắt ngắn gọn về tour (hiển thị ở trang danh sách)"/>
                                <p class="helper-text"><i class="fas fa-lightbulb mr-1"></i>Nên viết 2-3 câu mô tả hấp dẫn về tour</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card section-card">
                            <div class="card-header">
                                <h3><i class="fas fa-cogs section-icon"></i>Cấu hình</h3>
                            </div>
                            <div class="card-body">
                                <x-admin.inputs.text label="Điểm khởi hành" name="departure_point"
                                    :value="old('departure_point', $tour->departure_point ?? '')"
                                    placeholder="VD: Hà Nội"/>

                                <x-admin.inputs.text label="Phương tiện" name="transport_mode"
                                    :value="old('transport_mode', $tour->transport_mode ?? '')"
                                    placeholder="VD: Máy bay, Ô tô"/>

                                <div class="row">
                                    <div class="col-6">
                                        <x-admin.inputs.number label="Số chỗ còn" name="remaining_slots"
                                            :value="old('remaining_slots', $tour->remaining_slots ?? 0)"/>
                                    </div>
                                    <div class="col-6">
                                        <x-admin.inputs.number label="Độ ưu tiên" name="priority"
                                            :value="old('priority', $tour->priority ?? 0)"/>
                                    </div>
                                </div>
                                <p class="helper-text"><i class="fas fa-info-circle mr-1"></i>Ưu tiên cao = hiển thị trước</p>
                            </div>
                        </div>

                        <div class="card section-card">
                            <div class="card-header">
                                <h3><i class="fas fa-folder section-icon"></i>Phân loại</h3>
                            </div>
                            <div class="card-body">
                                <x-admin.inputs.select label="Danh mục" name="category_ids" :multiple="true" :searchable="true">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" @selected(in_array($category->id, old('category_ids', $isEdit ? $tour->categories->pluck('id')->toArray() : [])))>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </x-admin.inputs.select>
                                <p class="helper-text"><i class="fas fa-mouse-pointer mr-1"></i>Có thể chọn nhiều danh mục</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tab 2: Pricing --}}
            <div class="tab-pane fade" id="pricing" role="tabpanel">
                <div class="card section-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3><i class="fas fa-tags section-icon"></i>Bảng giá theo độ tuổi</h3>
                        <span class="badge badge-info">Đơn vị: VNĐ</span>
                    </div>
                    <div class="card-body">
                        <div class="pricing-grid">
                            <div class="pricing-card adult">
                                <div class="price-label">
                                    <i class="fas fa-user mr-1"></i>Người lớn
                                    <span class="age-range">(> 11 tuổi)</span>
                                </div>
                                <input type="number" name="price_adult" class="form-control"
                                       value="{{ old('price_adult', $tour->price_adult ?? 0) }}"
                                       placeholder="0" min="0">
                            </div>
                            <div class="pricing-card child">
                                <div class="price-label">
                                    <i class="fas fa-child mr-1"></i>Trẻ em
                                    <span class="age-range">(5 - 11 tuổi)</span>
                                </div>
                                <input type="number" name="price_child" class="form-control"
                                       value="{{ old('price_child', $tour->price_child ?? 0) }}"
                                       placeholder="0" min="0">
                            </div>
                            <div class="pricing-card toddler">
                                <div class="price-label">
                                    <i class="fas fa-baby mr-1"></i>Trẻ nhỏ
                                    <span class="age-range">(2 - 5 tuổi)</span>
                                </div>
                                <input type="number" name="price_toddler" class="form-control"
                                       value="{{ old('price_toddler', $tour->price_toddler ?? 0) }}"
                                       placeholder="0" min="0">
                            </div>
                            <div class="pricing-card infant">
                                <div class="price-label">
                                    <i class="fas fa-baby-carriage mr-1"></i>Em bé
                                    <span class="age-range">(< 2 tuổi)</span>
                                </div>
                                <input type="number" name="price_infant" class="form-control"
                                       value="{{ old('price_infant', $tour->price_infant ?? 0) }}"
                                       placeholder="0" min="0">
                            </div>
                        </div>
                        <p class="helper-text mt-3">
                            <i class="fas fa-calculator mr-1"></i>
                            Giá được tự động tính khi khách đặt tour dựa trên số lượng từng loại khách
                        </p>
                    </div>
                </div>
            </div>

            {{-- Tab 3: Itinerary --}}
            <div class="tab-pane fade" id="itinerary" role="tabpanel">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card section-card">
                            <div class="card-header">
                                <h3><i class="fas fa-map-pin section-icon"></i>Điểm đến trong hành trình</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Thêm điểm đến</label>
                                    <div class="input-group">
                                        <select id="destination-selector" class="form-control select2-init" style="width: calc(100% - 90px);">
                                            <option value="">-- Chọn điểm đến --</option>
                                            @foreach($destinations as $destination)
                                                <option value="{{ $destination->id }}" data-name="{{ $destination->name }}">
                                                    {{ $destination->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary" id="add-destination-btn">
                                                <i class="fas fa-plus"></i> Thêm
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <label><i class="fas fa-route mr-1"></i>Thứ tự hành trình</label>
                                <p class="helper-text mb-2"><i class="fas fa-arrows-alt mr-1"></i>Kéo thả để sắp xếp thứ tự</p>

                                <div class="itinerary-list">
                                    <ol class="list-group" id="itinerary-sortable-list">
                                        @php
                                            $selectedDestinations = collect(old('destination_ids', $isEdit ? $tour->destinations->pluck('id')->toArray() : []));
                                        @endphp
                                        @foreach($selectedDestinations as $index => $destId)
                                            @php
                                                $dest = $destinations->find($destId);
                                            @endphp
                                            @if($dest)
                                                <li class="list-group-item d-flex justify-content-between align-items-center" data-id="{{ $dest->id }}">
                                                    <span>
                                                        <i class="fas fa-grip-vertical handle mr-2"></i>
                                                        <span class="destination-order">{{ $index + 1 }}</span>
                                                        <span class="destination-name">{{ $dest->name }}</span>
                                                    </span>
                                                    <input type="hidden" name="destination_ids[]" value="{{ $dest->id }}">
                                                    <button type="button" class="btn btn-xs btn-outline-danger remove-destination-btn">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ol>
                                </div>

                                @if($selectedDestinations->isEmpty())
                                    <div class="text-center text-muted py-4" id="empty-itinerary-message">
                                        <i class="fas fa-map-marked-alt fa-2x mb-2"></i>
                                        <p class="mb-0">Chưa có điểm đến nào</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card section-card">
                            <div class="card-header">
                                <h3><i class="fas fa-calendar-alt section-icon"></i>Lịch trình chi tiết từng ngày</h3>
                            </div>
                            <div class="card-body p-0">
                                <x-admin.inputs.tour-schedule-array label="" name="tour_schedule"
                                    :value="old('tour_schedule', $tour->tour_schedule ?? [])"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tab 4: Content --}}
            <div class="tab-pane fade" id="content" role="tabpanel">
                <div class="card section-card">
                    <div class="card-header">
                        <h3><i class="fas fa-file-alt section-icon"></i>Mô tả chi tiết tour</h3>
                    </div>
                    <div class="card-body">
                        <x-admin.inputs.editor label="" name="tour_description"
                            :value="old('tour_description', $tour->tour_description ?? '')"/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card section-card">
                            <div class="card-header">
                                <h3><i class="fas fa-concierge-bell section-icon"></i>Ghi chú dịch vụ</h3>
                            </div>
                            <div class="card-body">
                                <x-admin.inputs.editor label="" name="services_note"
                                    :value="old('services_note', $tour->services_note ?? '')"/>
                                <p class="helper-text"><i class="fas fa-info-circle mr-1"></i>Dịch vụ bao gồm/không bao gồm</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card section-card">
                            <div class="card-header">
                                <h3><i class="fas fa-star section-icon"></i>Đặc điểm nổi bật</h3>
                            </div>
                            <div class="card-body">
                                <x-admin.inputs.editor label="" name="characteristic"
                                    :value="old('characteristic', $tour->characteristic ?? '')"/>
                                <p class="helper-text"><i class="fas fa-lightbulb mr-1"></i>Điểm đặc biệt thu hút khách</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card section-card">
                    <div class="card-header">
                        <h3><i class="fas fa-sticky-note section-icon"></i>Ghi chú thêm</h3>
                    </div>
                    <div class="card-body">
                        <x-admin.inputs.editor label="" name="note"
                            :value="old('note', $tour->note ?? '')"/>
                        <p class="helper-text"><i class="fas fa-info-circle mr-1"></i>Lưu ý quan trọng cho khách hàng</p>
                    </div>
                </div>
            </div>

            {{-- Tab 5: Media --}}
            <div class="tab-pane fade" id="media" role="tabpanel">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card section-card">
                            <div class="card-header">
                                <h3><i class="fas fa-image section-icon"></i>Ảnh đại diện</h3>
                            </div>
                            <div class="card-body">
                                <x-admin.inputs.image-link label="" name="thumbnail"
                                    :value="old('thumbnail', $tour->thumbnail ?? '')"/>
                                <p class="helper-text"><i class="fas fa-info-circle mr-1"></i>Ảnh chính hiển thị ở danh sách tour. Nên dùng ảnh 16:9</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card section-card">
                            <div class="card-header">
                                <h3><i class="fas fa-images section-icon"></i>Album ảnh</h3>
                            </div>
                            <div class="card-body">
                                <x-admin.inputs.image-link-array label="" name="images"
                                    :value="old('images', $tour->images ?? [])"/>
                                <p class="helper-text"><i class="fas fa-info-circle mr-1"></i>Thêm nhiều ảnh để tạo gallery cho tour</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Submit Footer --}}
        <div class="submit-footer">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <a href="{{ route('admin.tours.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left mr-1"></i> Quay lại
                    </a>
                </div>
                <div>
                    @if($isEdit)
                        <a href="{{ route('client.tour.show', $tour) }}" target="_blank" class="btn btn-outline-info mr-2">
                            <i class="fas fa-external-link-alt mr-1"></i> Xem tour
                        </a>
                    @endif
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-save mr-1"></i>
                        {{ $isEdit ? 'Lưu thay đổi' : 'Tạo tour mới' }}
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selector = document.getElementById('destination-selector');
            const addButton = document.getElementById('add-destination-btn');
            const itineraryList = document.getElementById('itinerary-sortable-list');
            const emptyMessage = document.getElementById('empty-itinerary-message');

            function updateDestinationOrder() {
                const items = itineraryList.querySelectorAll('li');
                items.forEach((item, index) => {
                    const orderBadge = item.querySelector('.destination-order');
                    if (orderBadge) {
                        orderBadge.textContent = index + 1;
                    }
                });

                // Toggle empty message
                if (emptyMessage) {
                    emptyMessage.style.display = items.length === 0 ? 'block' : 'none';
                }
            }

            // Initialize Sortable
            new Sortable(itineraryList, {
                animation: 150,
                handle: '.handle',
                onEnd: updateDestinationOrder
            });

            const getSelectedIds = () => {
                return Array.from(itineraryList.querySelectorAll('li')).map(li => li.dataset.id);
            };

            addButton.addEventListener('click', function () {
                const selectedOption = selector.options[selector.selectedIndex];
                if (!selectedOption.value || getSelectedIds().includes(selectedOption.value)) {
                    if (selectedOption.value && getSelectedIds().includes(selectedOption.value)) {
                        // Show toast or notification
                        alert('Điểm đến này đã được thêm!');
                    }
                    return;
                }

                const currentCount = itineraryList.querySelectorAll('li').length;
                const li = document.createElement('li');
                li.className = 'list-group-item d-flex justify-content-between align-items-center';
                li.dataset.id = selectedOption.value;
                li.innerHTML = `
                    <span>
                        <i class="fas fa-grip-vertical handle mr-2"></i>
                        <span class="destination-order">${currentCount + 1}</span>
                        <span class="destination-name">${selectedOption.dataset.name}</span>
                    </span>
                    <input type="hidden" name="destination_ids[]" value="${selectedOption.value}">
                    <button type="button" class="btn btn-xs btn-outline-danger remove-destination-btn">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                itineraryList.appendChild(li);
                selector.value = '';

                // Trigger Select2 clear if available
                if ($(selector).data('select2')) {
                    $(selector).val('').trigger('change');
                }

                updateDestinationOrder();
            });

            itineraryList.addEventListener('click', function (e) {
                if (e.target && (e.target.classList.contains('remove-destination-btn') || e.target.closest('.remove-destination-btn'))) {
                    e.target.closest('li').remove();
                    updateDestinationOrder();
                }
            });

            // Initialize Select2 for destination selector
            if ($.fn.select2) {
                $('#destination-selector').select2({
                    theme: 'bootstrap4',
                    width: '100%',
                    placeholder: '-- Chọn điểm đến --',
                    allowClear: true
                });
            }

            // Tab persistence - remember last active tab
            const activeTab = localStorage.getItem('tourFormActiveTab');
            if (activeTab) {
                $(`#tourTabs a[href="${activeTab}"]`).tab('show');
            }

            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                localStorage.setItem('tourFormActiveTab', $(e.target).attr('href'));
            });
        });
    </script>
@endpush
