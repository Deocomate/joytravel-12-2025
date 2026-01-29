@php
    $isEdit = !empty($category->id);
@endphp

@extends('admin.layouts.main')
@section('title', $isEdit ? 'Sửa Danh mục: ' . $category->name : 'Tạo Danh mục Mới')

@push('styles')
    <style>
        .category-form-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        .category-form-card .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1.25rem 1.5rem;
            border: none;
        }
        .category-form-card .card-header .card-title {
            margin: 0;
            font-weight: 600;
            font-size: 1.1rem;
        }
        .category-form-card .card-body {
            padding: 1.5rem;
        }

        .form-section {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1.25rem;
            margin-bottom: 1.25rem;
        }
        .form-section-title {
            font-weight: 600;
            color: #495057;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e9ecef;
        }
        .form-section-title i {
            color: #007bff;
            margin-right: 0.5rem;
        }

        .type-selector {
            display: flex;
            gap: 1rem;
        }
        .type-option {
            flex: 1;
            position: relative;
        }
        .type-option input[type="radio"] {
            position: absolute;
            opacity: 0;
        }
        .type-option label {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 1.25rem;
            border: 2px solid #dee2e6;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s ease;
            background: white;
        }
        .type-option label:hover {
            border-color: #007bff;
        }
        .type-option input[type="radio"]:checked + label {
            border-color: #007bff;
            background: rgba(0,123,255,0.05);
        }
        .type-option input[type="radio"]:checked + label.tour-label {
            border-color: #667eea;
            background: rgba(102,126,234,0.1);
        }
        .type-option input[type="radio"]:checked + label.news-label {
            border-color: #f5576c;
            background: rgba(245,87,108,0.1);
        }
        .type-option .type-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            margin-bottom: 0.75rem;
        }
        .type-option .type-icon.tour {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .type-option .type-icon.news {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }
        .type-option .type-name {
            font-weight: 600;
            color: #495057;
        }

        .status-toggle {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 10px;
        }
        .status-toggle .status-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
        }
        .status-toggle .status-icon.active {
            background: rgba(40,167,69,0.15);
            color: #28a745;
        }
        .status-toggle .status-icon.inactive {
            background: rgba(220,53,69,0.15);
            color: #dc3545;
        }
        .status-toggle .status-info {
            flex-grow: 1;
        }
        .status-toggle .status-label {
            font-weight: 600;
            color: #495057;
        }
        .status-toggle .status-desc {
            font-size: 0.8rem;
            color: #6c757d;
        }

        .submit-footer {
            background: #f8f9fa;
            padding: 1rem 1.5rem;
            border-top: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .helper-text {
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 0.25rem;
        }
    </style>
@endpush

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card category-form-card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas {{ $isEdit ? 'fa-edit' : 'fa-plus-circle' }} mr-2"></i>
                        {{ $isEdit ? 'Chỉnh sửa danh mục' : 'Tạo danh mục mới' }}
                    </h3>
                </div>

                <form action="{{ $isEdit ? route('admin.categories.update', ['category' => $category->id]) : route('admin.categories.store') }}"
                      method="post">
                    @csrf
                    @if($isEdit)
                        @method('PUT')
                    @endif

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                <strong>Có lỗi xảy ra!</strong> Vui lòng kiểm tra lại các trường dữ liệu.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        {{-- Basic Info --}}
                        <div class="form-section">
                            <h6 class="form-section-title">
                                <i class="fas fa-info-circle"></i>Thông tin cơ bản
                            </h6>

                            <x-admin.inputs.text label="Tên danh mục" name="name"
                                :value="old('name', $category->name ?? '')"
                                :required="true"
                                placeholder="VD: Tour trong nước, Tin du lịch..."/>

                            <x-admin.inputs.image-link label="Ảnh đại diện" name="thumbnail"
                                :value="old('thumbnail', $category->thumbnail ?? '')"/>
                            <p class="helper-text"><i class="fas fa-info-circle mr-1"></i>Ảnh sẽ hiển thị ở danh sách danh mục</p>
                        </div>

                        {{-- Type Selection --}}
                        <div class="form-section">
                            <h6 class="form-section-title">
                                <i class="fas fa-tag"></i>Loại danh mục <span class="text-danger">*</span>
                            </h6>

                            <div class="type-selector">
                                <div class="type-option">
                                    <input type="radio" name="type" id="type-tour" value="TOUR"
                                        {{ old('type', $category->type ?? '') === 'TOUR' ? 'checked' : '' }} required>
                                    <label for="type-tour" class="tour-label">
                                        <div class="type-icon tour">
                                            <i class="fas fa-suitcase-rolling"></i>
                                        </div>
                                        <span class="type-name">Tour du lịch</span>
                                    </label>
                                </div>
                                <div class="type-option">
                                    <input type="radio" name="type" id="type-news" value="NEWS"
                                        {{ old('type', $category->type ?? '') === 'NEWS' ? 'checked' : '' }} required>
                                    <label for="type-news" class="news-label">
                                        <div class="type-icon news">
                                            <i class="fas fa-newspaper"></i>
                                        </div>
                                        <span class="type-name">Tin tức</span>
                                    </label>
                                </div>
                            </div>
                            @error('type')
                                <div class="text-danger mt-2"><small>{{ $message }}</small></div>
                            @enderror
                        </div>

                        {{-- Hierarchy & Priority --}}
                        <div class="form-section">
                            <h6 class="form-section-title">
                                <i class="fas fa-sitemap"></i>Cấu trúc & Thứ tự
                            </h6>

                            <div class="row">
                                <div class="col-md-8">
                                    <x-admin.inputs.select label="Danh mục cha" name="parent_id" :searchable="true">
                                        <option value="">-- Không có (Danh mục gốc) --</option>
                                        @foreach($parentCategories as $parent)
                                            <option value="{{ $parent->id }}"
                                                data-type="{{ $parent->type }}"
                                                @selected(old('parent_id', $category->parent_id ?? '') == $parent->id)>
                                                {{ $parent->name }} ({{ $parent->type }})
                                            </option>
                                        @endforeach
                                    </x-admin.inputs.select>
                                    <p class="helper-text"><i class="fas fa-lightbulb mr-1"></i>Chọn danh mục cha để tạo cấu trúc cây</p>
                                </div>
                                <div class="col-md-4">
                                    <x-admin.inputs.number label="Độ ưu tiên" name="priority"
                                        :value="old('priority', $category->priority ?? 0)"/>
                                    <p class="helper-text">Số nhỏ = hiển thị trước</p>
                                </div>
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="form-section mb-0">
                            <h6 class="form-section-title">
                                <i class="fas fa-toggle-on"></i>Trạng thái
                            </h6>

                            @php
                                $isActive = old('is_active', $category->is_active ?? 1) == 1;
                            @endphp

                            <div class="status-toggle">
                                <div class="status-icon {{ $isActive ? 'active' : 'inactive' }}" id="status-icon">
                                    <i class="fas {{ $isActive ? 'fa-check-circle' : 'fa-times-circle' }}" id="status-icon-i"></i>
                                </div>
                                <div class="status-info">
                                    <div class="status-label" id="status-label">{{ $isActive ? 'Đang hoạt động' : 'Đã ẩn' }}</div>
                                    <div class="status-desc" id="status-desc">
                                        {{ $isActive ? 'Danh mục sẽ hiển thị trên website' : 'Danh mục sẽ bị ẩn khỏi website' }}
                                    </div>
                                </div>
                                <div class="custom-control custom-switch">
                                    <input type="hidden" name="is_active" value="0">
                                    <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1"
                                        {{ $isActive ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="is_active"></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="submit-footer">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left mr-1"></i> Quay lại
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save mr-1"></i>
                            {{ $isEdit ? 'Lưu thay đổi' : 'Tạo danh mục' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusCheckbox = document.getElementById('is_active');
            const statusIcon = document.getElementById('status-icon');
            const statusIconI = document.getElementById('status-icon-i');
            const statusLabel = document.getElementById('status-label');
            const statusDesc = document.getElementById('status-desc');

            statusCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    statusIcon.className = 'status-icon active';
                    statusIconI.className = 'fas fa-check-circle';
                    statusLabel.textContent = 'Đang hoạt động';
                    statusDesc.textContent = 'Danh mục sẽ hiển thị trên website';
                } else {
                    statusIcon.className = 'status-icon inactive';
                    statusIconI.className = 'fas fa-times-circle';
                    statusLabel.textContent = 'Đã ẩn';
                    statusDesc.textContent = 'Danh mục sẽ bị ẩn khỏi website';
                }
            });
        });
    </script>
@endpush
