@php
    $isEdit = isset($destination);
@endphp

@extends('admin.layouts.main')
@section('title', $isEdit ? 'Sửa Điểm đến' : 'Tạo Điểm đến')

@push('styles')
    <style>
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
        .helper-text {
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 0.25rem;
        }
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
    </style>
@endpush

@section('content')
    <form
        action="{{ $isEdit ? route('admin.destinations.update', $destination) : route('admin.destinations.store') }}"
        method="post"
        novalidate>
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Có lỗi xảy ra!</strong> Vui lòng kiểm tra lại các trường dữ liệu.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card section-card">
            <div class="card-header">
                <h3><i class="fas fa-map-marker-alt section-icon"></i>Thông tin cơ bản</h3>
            </div>
            <div class="card-body">
                <x-admin.inputs.text label="Tên điểm đến" name="name" :value="old('name', $destination->name ?? '')" required/>

                <x-admin.inputs.text
                    label="Slug"
                    name="slug_display"
                    :value="old('slug_display', $destination->slug ?? 'Tự động tạo sau khi lưu')"
                    readonly
                    disabled
                />
                <div class="helper-text">Slug được tạo tự động từ tên điểm đến.</div>
            </div>
        </div>

        <div class="card section-card">
            <div class="card-header">
                <h3><i class="fas fa-align-left section-icon"></i>Mô tả chi tiết</h3>
            </div>
            <div class="card-body">
                <x-admin.inputs.editor label="Mô tả" name="description" :value="old('description', $destination->description ?? '')"/>
                <div class="helper-text">Có thể thêm thông tin nổi bật, gợi ý trải nghiệm hoặc lưu ý.</div>
            </div>
        </div>

        <div class="submit-footer d-flex justify-content-between align-items-center">
            <a href="{{ route('admin.destinations.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left mr-1"></i> Quay lại danh sách
            </a>
            <div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-1"></i>{{ $isEdit ? 'Cập nhật' : 'Tạo mới' }}
                </button>
            </div>
        </div>
    </form>
@endsection
