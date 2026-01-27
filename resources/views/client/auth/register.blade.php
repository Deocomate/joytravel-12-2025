@extends('client.layouts.app')

@section('title', 'Đăng ký - King Express Travel')

@section('content')
    <div
        class="min-h-[70vh] flex items-center justify-center py-12 md:py-20 bg-gradient-to-br from-amber-50 via-white to-orange-50">
        <div class="container mx-auto px-4">
            <div class="max-w-md mx-auto">
                {{-- Card Container --}}
                <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100 relative overflow-hidden">
                    {{-- Decorative Elements --}}
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-amber-400/10 to-orange-500/10 rounded-bl-full -mr-16 -mt-16">
                    </div>
                    <div
                        class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-amber-400/10 to-orange-500/10 rounded-tr-full -ml-12 -mb-12">
                    </div>

                    {{-- Header --}}
                    <div class="text-center mb-6 relative z-10">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-amber-400 to-orange-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-amber-500/30">
                            <i class="fa-solid fa-user-plus text-white text-2xl"></i>
                        </div>
                        <h1 class="text-3xl font-black text-gray-800">Đăng Ký</h1>
                        <p class="text-gray-500 mt-2">Tạo tài khoản để khám phá niềm vui!</p>
                    </div>

                    {{-- Form --}}
                    <form action="{{ route('client.register.submit') }}" method="POST" class="space-y-4 relative z-10">
                        @csrf

                        {{-- Error Alert --}}
                        @if (session('error'))
                            <div
                                class="p-4 bg-red-50 border border-red-100 text-red-700 rounded-xl text-sm flex items-start gap-3">
                                <i class="fa-solid fa-circle-exclamation mt-0.5 flex-shrink-0"></i>
                                <span>{{ session('error') }}</span>
                            </div>
                        @endif

                        {{-- Name Field --}}
                        <div>
                            <label for="register-name" class="block text-sm font-semibold text-gray-700 mb-2">
                                Họ và tên <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="text" name="name" id="register-name" required value="{{ old('name') }}"
                                    placeholder="Nguyễn Văn A"
                                    class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-amber-400 focus:border-amber-500 outline-none transition-all bg-gray-50 focus:bg-white text-sm">
                                <i class="fa-solid fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            </div>
                            @error('name')
                                <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Email Field --}}
                        <div>
                            <label for="register-email" class="block text-sm font-semibold text-gray-700 mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="email" name="email" id="register-email" required
                                    value="{{ old('email') }}" placeholder="your@email.com"
                                    class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-amber-400 focus:border-amber-500 outline-none transition-all bg-gray-50 focus:bg-white text-sm">
                                <i class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            </div>
                            @error('email')
                                <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Phone Field --}}
                        <div>
                            <label for="register-phone" class="block text-sm font-semibold text-gray-700 mb-2">
                                Số điện thoại <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="tel" name="phone" id="register-phone" required
                                    value="{{ old('phone') }}" placeholder="0901234567"
                                    class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-amber-400 focus:border-amber-500 outline-none transition-all bg-gray-50 focus:bg-white text-sm">
                                <i class="fa-solid fa-phone absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            </div>
                            @error('phone')
                                <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Password Field --}}
                        <div>
                            <label for="register-password" class="block text-sm font-semibold text-gray-700 mb-2">
                                Mật khẩu <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="password" name="password" id="register-password" required
                                    placeholder="Tối thiểu 8 ký tự"
                                    class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-amber-400 focus:border-amber-500 outline-none transition-all bg-gray-50 focus:bg-white text-sm">
                                <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            </div>
                            @error('password')
                                <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Password Confirmation Field --}}
                        <div>
                            <label for="register-password-confirmation"
                                class="block text-sm font-semibold text-gray-700 mb-2">
                                Xác nhận mật khẩu <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="password" name="password_confirmation" id="register-password-confirmation"
                                    required placeholder="Nhập lại mật khẩu"
                                    class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-amber-400 focus:border-amber-500 outline-none transition-all bg-gray-50 focus:bg-white text-sm">
                                <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <button type="submit"
                            class="w-full py-3.5 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white font-bold rounded-xl transition-all shadow-lg shadow-amber-500/30 hover:shadow-amber-500/50 hover:-translate-y-0.5 active:translate-y-0 active:scale-[0.99] flex items-center justify-center gap-2 mt-6">
                            <i class="fa-solid fa-user-plus"></i>
                            Đăng ký
                        </button>
                    </form>

                    {{-- Divider --}}
                    <div class="relative flex py-4 items-center">
                        <div class="flex-grow border-t border-gray-200"></div>
                        <span class="flex-shrink mx-4 text-gray-400 text-xs">Hoặc đăng ký với</span>
                        <div class="flex-grow border-t border-gray-200"></div>
                    </div>

                    {{-- Google Signup --}}
                    <a href="{{ route('auth.google.redirect') }}"
                        class="w-full flex items-center justify-center gap-3 py-2.5 border-2 border-gray-200 rounded-xl hover:bg-gray-50 hover:border-gray-300 transition-all font-medium text-gray-700 text-sm group">
                        <svg class="w-4 h-4" viewBox="0 0 48 48">
                            <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12
                            s5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24
                            s8.955,20,20,20s20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path>
                            <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039
                            l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path>
                            <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36
                            c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path>
                            <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571
                            l6.19,5.238C43.021,36.251,44,34,44,30C44,22.659,43.862,21.35,43.611,20.083z"></path>
                        </svg>
                        <span class="group-hover:text-gray-900 transition-colors">Tiếp tục với Google</span>
                    </a>

                    {{-- Login Link --}}
                    <div class="mt-4 text-center relative z-10">
                        <p class="text-gray-600 text-sm">
                            Bạn đã có tài khoản?
                            <a href="{{ route('client.login') }}"
                                class="text-amber-600 font-bold hover:text-amber-700 hover:underline transition-colors">
                                Đăng nhập ngay
                            </a>
                        </p>
                    </div>
                </div>

                {{-- Back to Home --}}
                <div class="mt-6 text-center">
                    <a href="{{ route('client.home') }}"
                        class="text-gray-500 hover:text-amber-600 transition-colors inline-flex items-center gap-2">
                        <i class="fa-solid fa-arrow-left"></i>
                        Quay về trang chủ
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
