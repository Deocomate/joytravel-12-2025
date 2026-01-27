@props(['user'])

<div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
    <div class="flex items-center gap-x-4">
        <div class="relative w-16 h-16">
            @if ($user->avatar)
                <img class="w-16 h-16 rounded-full object-cover" src="{{ $user->avatar }}" alt="{{ $user->name ?? '' }}">
            @else
                <div
                    class="w-16 h-16 rounded-full bg-[var(--color-primary)] flex items-center justify-center text-white text-2xl font-bold">
                    {{ strtoupper(substr($user->name ?? 'A', 0, 2)) }}
                </div>
            @endif
        </div>
        <div>
            <h2 class="font-bold text-gray-800">{{ $user->name ?? '' }}</h2>
            <p class="text-sm text-gray-500">Thành viên đồng (0)</p>
        </div>
    </div>

    <nav id="profile-sidebar-nav" class="mt-6 space-y-2" x-data>
        <a href="{{ route('client.profile') }}" @click.prevent="loadProfileContent('{{ route('client.profile') }}')"
            class="profile-nav-link flex items-center gap-x-3 px-4 py-3 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('client.profile') ? 'bg-[var(--color-primary-light)] text-[var(--color-primary-dark)]' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-800' }}">
            <i class="fa-solid fa-user-pen w-5 text-center"></i>
            <span>Hồ sơ cá nhân</span>
        </a>

        <a href="{{ route('client.profile.history') }}"
            @click.prevent="loadProfileContent('{{ route('client.profile.history') }}')"
            class="profile-nav-link flex items-center gap-x-3 px-4 py-3 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('client.profile.history') ? 'bg-[var(--color-primary-light)] text-[var(--color-primary-dark)]' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-800' }}">
            <i class="fa-solid fa-receipt w-5 text-center"></i>
            <span>Đơn hàng của tôi</span>
        </a>

        @if ($user->account_type === 'LOCAL')
            <a href="{{ route('client.profile.change-password') }}"
                @click.prevent="loadProfileContent('{{ route('client.profile.change-password') }}')"
                class="profile-nav-link flex items-center gap-x-3 px-4 py-3 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('client.profile.change-password') ? 'bg-[var(--color-primary-light)] text-[var(--color-primary-dark)]' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-800' }}">
                <i class="fa-solid fa-lock w-5 text-center"></i>
                <span>Đổi mật khẩu</span>
            </a>
        @endif

        <a href="#"
            class="flex items-center gap-x-3 px-4 py-3 rounded-lg text-sm font-semibold text-gray-600 hover:bg-gray-100 hover:text-gray-800 transition-colors">
            <i class="fa-solid fa-star-half-stroke w-5 text-center"></i>
            <span>Đánh giá chuyến đi</span>
        </a>
        <a href="#"
            class="flex items-center gap-x-3 px-4 py-3 rounded-lg text-sm font-semibold text-gray-600 hover:bg-gray-100 hover:text-gray-800 transition-colors">
            <i class="fa-solid fa-heart w-5 text-center"></i>
            <span>Danh sách yêu thích</span>
        </a>

        <div class="border-t border-gray-200 my-2"></div>

        <form method="POST" action="{{ route('client.logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-x-3 px-4 py-3 rounded-lg text-sm font-semibold text-gray-600 hover:bg-gray-100 hover:text-gray-800 transition-colors">
                <i class="fa-solid fa-arrow-right-from-bracket w-5 text-center"></i>
                <span>Thoát</span>
            </button>
        </form>
    </nav>
</div>

@push('scripts')
    <script>
        window.loadProfileContent = function(url) {
            const container = document.getElementById('profile-content-area');
            if (!container) return;

            // Loading effect
            container.innerHTML =
                '<div class="flex justify-center items-center min-h-[400px]"><i class="fa-solid fa-spinner fa-spin text-4xl text-[var(--color-primary)]"></i></div>';

            // Update browser history
            if (url !== window.location.href) {
                window.history.pushState({
                    path: url
                }, '', url);
            }

            axios.get(url)
                .then(res => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(res.data, 'text/html');
                    const newContent = doc.getElementById('profile-content-area');

                    if (newContent) {
                        container.innerHTML = newContent.innerHTML;

                        // Re-execute scripts
                        container.querySelectorAll('script').forEach(oldScript => {
                            const newScript = document.createElement('script');
                            Array.from(oldScript.attributes).forEach(attr => newScript.setAttribute(attr
                                .name, attr.value));
                            newScript.appendChild(document.createTextNode(oldScript.innerHTML));
                            oldScript.parentNode.replaceChild(newScript, oldScript);
                        });
                    } else {
                        container.innerHTML =
                            '<div class="text-center text-red-500 p-4">Lỗi: Không tìm thấy nội dung.</div>';
                    }

                    // Update Active State Sidebar
                    document.querySelectorAll('.profile-nav-link').forEach(el => {
                        // Reset classes
                        el.classList.remove('bg-[var(--color-primary-light)]',
                            'text-[var(--color-primary-dark)]');
                        el.classList.add('text-gray-600', 'hover:bg-gray-100', 'hover:text-gray-800');

                        // Check if matched
                        if (el.href === url) {
                            el.classList.remove('text-gray-600', 'hover:bg-gray-100',
                            'hover:text-gray-800');
                            el.classList.add('bg-[var(--color-primary-light)]',
                                'text-[var(--color-primary-dark)]');
                        }
                    });
                })
                .catch(err => {
                    console.error(err);
                    if (typeof window.showToast === 'function') {
                        window.showToast('error', 'Không thể tải nội dung. Vui lòng thử lại.');
                    }
                    setTimeout(() => window.location.reload(), 1000);
                });
        }

        // Handle Back/Forward
        window.addEventListener('popstate', (e) => {
            if (e.state && e.state.path) {
                loadProfileContent(e.state.path);
            } else {
                // If no state (e.g. initial load), reload or load current href
                loadProfileContent(window.location.href);
            }
        });
    </script>
@endpush
