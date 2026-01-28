@php
    $isEdit = isset($user);
@endphp

@extends('admin.layouts.main')
@section('title', $isEdit ? 'Sửa Người dùng' : 'Tạo Người dùng')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $isEdit ? 'Sửa người dùng: ' . $user->name : 'Tạo mới người dùng' }}</h3>
        </div>
        <form action="{{ $isEdit ? route('admin.users.update', $user) : route('admin.users.store') }}" method="POST" novalidate>
            @csrf
            @if($isEdit)
                @method('PUT')
            @endif

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Có lỗi xảy ra!</strong> Vui lòng kiểm tra lại các trường dữ liệu.
                    </div>
                @endif

                <x-admin.inputs.text label="Tên người dùng" name="name" :value="old('name', $user->name ?? '')" required/>

                @if ($isEdit)
                    <x-admin.inputs.text
                        label="Email (Không thể thay đổi)"
                        name="email_display"
                        :value="$user->email"
                        id="input-email"
                        disabled
                    />
                    <input type="hidden" name="email" value="{{ $user->email }}">
                @else
                    <x-admin.inputs.email label="Email" name="email" :value="old('email', $user->email ?? '')" required/>
                @endif

                <x-admin.inputs.select
                    label="Vai trò"
                    name="role"
                    :value="old('role', $user->role ?? 'user')"
                    :searchable="false"
                    required
                >
                    <option value="user" @selected(old('role', $user->role ?? 'user') == 'user')>User</option>
                    <option value="admin" @selected(old('role', $user->role ?? 'user') == 'admin')>Admin</option>
                </x-admin.inputs.select>

                <hr>
                <p class="text-muted">{{ $isEdit ? 'Để trống nếu không muốn thay đổi mật khẩu.' : 'Nhập mật khẩu cho tài khoản mới.' }}</p>

                <x-admin.inputs.text type="password"
                               label="Mật khẩu"
                               name="password"
                               value=""
                               :required="!$isEdit"
                               :placeholder="$isEdit ? '********' : 'Nhập mật khẩu'"
                />
                <x-admin.inputs.text type="password"
                               label="Xác nhận mật khẩu"
                               name="password_confirmation"
                               value=""
                               :required="!$isEdit"
                               :placeholder="$isEdit ? '********' : 'Nhập lại mật khẩu'"
                />
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ $isEdit ? 'Cập nhật' : 'Tạo mới' }}</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Hủy</a>
            </div>
        </form>
    </div>
@endsection
