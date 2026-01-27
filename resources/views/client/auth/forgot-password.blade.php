@extends('client.layouts.app')

@section('title', 'Quên mật khẩu - King Express Travel')

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
                    <div class="text-center mb-8 relative z-10">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-amber-400 to-orange-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-amber-500/30">
                            <i class="fa-solid fa-key text-white text-2xl"></i>
                        </div>
                        <h1 class="text-3xl font-black text-gray-800">Quên Mật Khẩu</h1>
                        <p class="text-gray-500 mt-2">Nhập email để lấy lại mật khẩu của bạn</p>
                    </div>

                    {{-- Success Message --}}
                    @if (session('success'))
                        <div
                            class="mb-6 p-4 bg-green-50 border border-green-100 text-green-700 rounded-xl text-sm flex items-start gap-3">
                            <i class="fa-solid fa-circle-check mt-0.5 flex-shrink-0"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    {{-- Error Message --}}
                    @if (session('error'))
                        <div
                            class="mb-6 p-4 bg-red-50 border border-red-100 text-red-700 rounded-xl text-sm flex items-start gap-3">
                            <i class="fa-solid fa-circle-exclamation mt-0.5 flex-shrink-0"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif

                    {{-- Form --}}
                    <form action="{{ route('client.forgot-password.submit') }}" method="POST"
                        class="space-y-5 relative z-10">
                        @csrf

                        {{-- Email Field --}}
                        <div>
                            <label for="forgot-email" class="block text-sm font-semibold text-gray-700 mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="email" name="email" id="forgot-email" required value="{{ old('email') }}"
                                    placeholder="your@email.com"
                                    class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-amber-400 focus:border-amber-500 outline-none transition-all bg-gray-50 focus:bg-white">
                                <i class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            </div>
                            @error('email')
                                <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Submit Button --}}
                        <button type="submit"
                            class="w-full py-3.5 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white font-bold rounded-xl transition-all shadow-lg shadow-amber-500/30 hover:shadow-amber-500/50 hover:-translate-y-0.5 active:translate-y-0 active:scale-[0.99] flex items-center justify-center gap-2">
                            <i class="fa-solid fa-paper-plane"></i>
                            Gửi link lấy lại mật khẩu
                        </button>
                    </form>

                    {{-- Info Box --}}
                    <div class="mt-6 p-4 bg-amber-50 border border-amber-100 rounded-xl">
                        <div class="flex items-start gap-3">
                            <i class="fa-solid fa-lightbulb text-amber-500 mt-0.5"></i>
                            <div class="text-sm text-amber-800">
                                <p class="font-semibold">Lưu ý:</p>
                                <p class="mt-1 text-amber-700">Link đặt lại mật khẩu sẽ được gửi tới email của bạn. Vui lòng
                                    kiểm tra cả thư mục spam.</p>
                            </div>
                        </div>
                    </div>

                    {{-- Login Link --}}
                    <div class="mt-6 text-center relative z-10">
                        <p class="text-gray-600">
                            Đã nhớ mật khẩu?
                            <a href="{{ route('client.login') }}"
                                class="text-amber-600 font-bold hover:text-amber-700 hover:underline transition-colors">
                                Đăng nhập
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
