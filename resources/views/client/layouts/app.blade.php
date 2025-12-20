<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>
    <meta name="description"
        content="@yield('description', 'King Express Travel - Khám phá niềm vui của bạn ở bất cứ đâu.')">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Mulish', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        primary: '#f59e0b',
                        'primary-dark': '#d97706',
                        'primary-accent': '#fbbf24',
                        'primary-light': '#fffbeb',
                        'primary-subtle-hover': '#fef3c7',
                        'text-on-primary': '#ffffff',
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'float-slow': 'float 8s ease-in-out infinite',
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'bounce-slow': 'bounce 2s infinite',
                        'shimmer': 'shimmer 2s linear infinite',
                        'gradient': 'gradient 8s ease infinite',
                        'glow': 'glow 2s ease-in-out infinite alternate',
                        'slide-up': 'slideUp 0.5s ease-out',
                        'slide-down': 'slideDown 0.3s ease-out',
                        'fade-in': 'fadeIn 0.4s ease-out',
                        'scale-in': 'scaleIn 0.3s ease-out',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
                        },
                        shimmer: {
                            '0%': { backgroundPosition: '-200% 0' },
                            '100%': { backgroundPosition: '200% 0' },
                        },
                        gradient: {
                            '0%, 100%': { backgroundPosition: '0% 50%' },
                            '50%': { backgroundPosition: '100% 50%' },
                        },
                        glow: {
                            '0%': { boxShadow: '0 0 5px rgba(245, 158, 11, 0.5)' },
                            '100%': { boxShadow: '0 0 20px rgba(245, 158, 11, 0.8), 0 0 30px rgba(245, 158, 11, 0.4)' },
                        },
                        slideUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        slideDown: {
                            '0%': { opacity: '0', transform: 'translateY(-10px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        scaleIn: {
                            '0%': { opacity: '0', transform: 'scale(0.95)' },
                            '100%': { opacity: '1', transform: 'scale(1)' },
                        },
                    },
                },
            },
        };
    </script>

    @stack('styles')

    <style>
        /* ========================================
           CSS VARIABLES
        ======================================== */
        :root {
            --font-sans: 'Mulish', ui-sans-serif, system-ui, sans-serif;

            /* Color Palette */
            --color-primary: #f59e0b;
            --color-primary-dark: #d97706;
            --color-primary-accent: #fbbf24;
            --color-primary-light: #fffbeb;
            --color-primary-subtle-hover: #fef3c7;
            --color-text-on-primary: #ffffff;

            /* Glassmorphism */
            --glass-bg: rgba(255, 255, 255, 0.85);
            --glass-bg-dark: rgba(255, 255, 255, 0.95);
            --glass-border: rgba(255, 255, 255, 0.2);
            --glass-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);

            /* Animation Timing */
            --ease-smooth: cubic-bezier(0.4, 0, 0.2, 1);
            --ease-bounce: cubic-bezier(0.68, -0.55, 0.265, 1.55);
            --ease-elastic: cubic-bezier(0.175, 0.885, 0.32, 1.275);
            --ease-out-expo: cubic-bezier(0.16, 1, 0.3, 1);

            /* Shadows */
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            --shadow-2xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            --shadow-glow: 0 0 30px rgba(245, 158, 11, 0.3);
        }

        /* ========================================
           BASE STYLES
        ======================================== */
        html {
            scroll-behavior: smooth;
        }

        html,
        body {
            overflow-x: hidden;
            width: 100%;
        }

        body {
            font-family: var(--font-sans);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, var(--color-primary), var(--color-primary-dark));
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--color-primary-dark);
        }

        /* Selection */
        ::selection {
            background: var(--color-primary-accent);
            color: var(--color-text-on-primary);
        }

        /* ========================================
           PAGE LOAD ANIMATION
        ======================================== */
        .page-wrapper {
            opacity: 0;
            animation: pageLoad 0.6s var(--ease-smooth) forwards;
        }

        @keyframes pageLoad {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ========================================
           TOAST STYLES
        ======================================== */
        .custom-toast.swal2-popup {
            font-size: 0.875rem;
            padding: 0.75rem 1.25rem;
            border-radius: 12px;
            box-shadow: var(--shadow-xl);
        }

        .custom-toast .swal2-title {
            font-size: 1em;
        }

        .custom-toast .swal2-icon {
            width: 1.25em;
            height: 1.25em;
            margin: 0 0.5em 0 0;
        }

        .custom-toast .swal2-icon .swal2-icon-content {
            font-size: 1em;
        }

        /* ========================================
           HEADER STYLES
        ======================================== */
        .header-glass {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            box-shadow: var(--glass-shadow);
            border-bottom: 1px solid var(--glass-border);
        }

        .header-scrolled {
            background: var(--glass-bg-dark) !important;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1) !important;
        }

        .header-scrolled .main-nav-bar {
            height: 56px !important;
            transition: height 0.3s var(--ease-smooth);
        }

        /* Navigation Link Animation */
        .main-nav-link {
            position: relative;
            transition: all 0.3s var(--ease-smooth);
        }

        .main-nav-link::after {
            content: '';
            position: absolute;
            width: 100%;
            transform: scaleX(0);
            height: 3px;
            bottom: 0;
            left: 0;
            background: linear-gradient(90deg, var(--color-primary-accent), var(--color-primary-dark));
            transform-origin: bottom right;
            transition: transform 0.4s var(--ease-elastic);
            border-radius: 2px;
        }

        .main-nav-link:hover {
            transform: translateY(-2px);
        }

        .main-nav-link:hover::after,
        .main-nav-link.active::after {
            transform: scaleX(1);
            transform-origin: bottom left;
        }

        /* ========================================
           MEGA MENU STYLES
        ======================================== */
        .mega-menu-wrapper {
            opacity: 0;
            visibility: hidden;
            transform: translateY(15px) scale(0.98);
            transition: all 0.3s var(--ease-smooth);
            pointer-events: none;
        }

        .group:hover .mega-menu-wrapper {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
            pointer-events: auto;
        }

        .mega-menu-parent-item {
            transition: all 0.2s var(--ease-smooth);
        }

        .mega-menu-parent-item.active {
            background-color: #ffffff;
            color: var(--color-primary-dark);
            font-weight: 700;
            border-right: 3px solid var(--color-primary);
        }

        .mega-menu-parent-item:not(.active) {
            border-right: 3px solid transparent;
        }

        .mega-menu-parent-item:hover {
            padding-left: 1.25rem;
        }

        .mega-menu-children-panel {
            animation: fadeSlideIn 0.4s var(--ease-smooth);
        }

        @keyframes fadeSlideIn {
            from {
                opacity: 0;
                transform: translateX(10px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* ========================================
           MOBILE MENU
        ======================================== */
        .mobile-menu-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s var(--ease-smooth);
            z-index: 40;
        }

        .mobile-menu-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .mobile-menu-panel {
            position: fixed;
            top: 0;
            right: 0;
            width: 85%;
            max-width: 320px;
            height: 100vh;
            background: white;
            transform: translateX(100%);
            transition: transform 0.4s var(--ease-out-expo);
            z-index: 50;
            overflow-y: auto;
            box-shadow: -10px 0 40px rgba(0, 0, 0, 0.15);
        }

        .mobile-menu-panel.active {
            transform: translateX(0);
        }

        /* Hamburger Menu Animation */
        .hamburger {
            width: 24px;
            height: 20px;
            position: relative;
            cursor: pointer;
        }

        .hamburger span {
            display: block;
            position: absolute;
            height: 3px;
            width: 100%;
            background: currentColor;
            border-radius: 3px;
            transition: all 0.3s var(--ease-smooth);
        }

        .hamburger span:nth-child(1) {
            top: 0;
        }

        .hamburger span:nth-child(2) {
            top: 50%;
            transform: translateY(-50%);
        }

        .hamburger span:nth-child(3) {
            bottom: 0;
        }

        .hamburger.active span:nth-child(1) {
            top: 50%;
            transform: translateY(-50%) rotate(45deg);
        }

        .hamburger.active span:nth-child(2) {
            opacity: 0;
            transform: translateX(20px);
        }

        .hamburger.active span:nth-child(3) {
            bottom: 50%;
            transform: translateY(50%) rotate(-45deg);
        }

        /* ========================================
           DROPDOWN STYLES
        ======================================== */
        .dropdown-menu {
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px) scale(0.95);
            transition: all 0.25s var(--ease-smooth);
        }

        .dropdown-menu.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
        }

        /* ========================================
           BUTTON STYLES
        ======================================== */
        .btn-primary {
            position: relative;
            overflow: hidden;
            transition: all 0.3s var(--ease-smooth);
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(245, 158, 11, 0.4);
        }

        .btn-primary:active {
            transform: translateY(0) scale(0.98);
        }

        /* Ghost Button */
        .btn-ghost {
            position: relative;
            overflow: hidden;
            transition: all 0.3s var(--ease-smooth);
        }

        .btn-ghost::before {
            content: '';
            position: absolute;
            inset: 0;
            background: var(--color-primary);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s var(--ease-smooth);
            z-index: -1;
        }

        .btn-ghost:hover::before {
            transform: scaleX(1);
        }

        .btn-ghost:hover {
            color: white;
        }

        /* ========================================
           CARD STYLES
        ======================================== */
        .card-hover {
            transition: all 0.4s var(--ease-smooth);
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-2xl);
        }

        .card-3d {
            transition: transform 0.3s var(--ease-smooth);
            transform-style: preserve-3d;
        }

        .card-3d:hover {
            transform: perspective(1000px) rotateY(5deg) rotateX(5deg);
        }

        /* ========================================
           TEXT EFFECTS
        ======================================== */
        .gradient-text {
            background: linear-gradient(135deg, var(--color-primary-accent), var(--color-primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .gradient-text-animated {
            background: linear-gradient(270deg, var(--color-primary-accent), var(--color-primary-dark), var(--color-primary-accent));
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradient 3s ease infinite;
        }

        /* ========================================
           ANIMATIONS
        ======================================== */
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        /* Pulse Ring Effect */
        .pulse-ring {
            position: relative;
        }

        .pulse-ring::after {
            content: '';
            position: absolute;
            inset: -4px;
            border-radius: inherit;
            border: 2px solid var(--color-primary);
            animation: pulseRing 2s infinite;
        }

        @keyframes pulseRing {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            100% {
                transform: scale(1.3);
                opacity: 0;
            }
        }

        /* Reveal on Scroll */
        .reveal-up {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s var(--ease-smooth);
        }

        .reveal-up.revealed {
            opacity: 1;
            transform: translateY(0);
        }

        /* Stagger Children */
        .stagger-children>* {
            opacity: 0;
            transform: translateY(20px);
        }

        .stagger-children.animate>* {
            animation: staggerFadeIn 0.5s var(--ease-smooth) forwards;
        }

        .stagger-children.animate>*:nth-child(1) {
            animation-delay: 0.1s;
        }

        .stagger-children.animate>*:nth-child(2) {
            animation-delay: 0.2s;
        }

        .stagger-children.animate>*:nth-child(3) {
            animation-delay: 0.3s;
        }

        .stagger-children.animate>*:nth-child(4) {
            animation-delay: 0.4s;
        }

        .stagger-children.animate>*:nth-child(5) {
            animation-delay: 0.5s;
        }

        .stagger-children.animate>*:nth-child(6) {
            animation-delay: 0.6s;
        }

        @keyframes staggerFadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ========================================
           SOCIAL ICONS
        ======================================== */
        .social-icon {
            transition: all 0.3s var(--ease-elastic);
        }

        .social-icon:hover {
            transform: translateY(-5px) scale(1.1);
        }

        /* ========================================
           INPUT STYLES
        ======================================== */
        .input-animated {
            transition: all 0.3s var(--ease-smooth);
            border: 2px solid transparent;
        }

        .input-animated:focus {
            border-color: var(--color-primary);
            box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1);
        }

        /* ========================================
           SKELETON LOADING
        ======================================== */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
        }

        @keyframes shimmer {
            0% {
                background-position: -200% 0;
            }

            100% {
                background-position: 200% 0;
            }
        }

        /* ========================================
           SLIDER/CAROUSEL STYLES
        ======================================== */
        .slider-nav-btn,
        .main-carousel-nav-btn {
            color: var(--color-primary);
            background: #fff;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            box-shadow: var(--shadow-md);
            transition: all 0.3s var(--ease-smooth);
        }

        .slider-nav-btn:after,
        .main-carousel-nav-btn:after {
            font-size: 18px;
            font-weight: 600;
        }

        .slider-nav-btn:hover,
        .main-carousel-nav-btn:hover {
            transform: scale(1.1);
            box-shadow: var(--shadow-glow);
        }

        .swiper-button-disabled {
            opacity: 0;
            pointer-events: none;
        }

        /* ========================================
           UTILITIES
        ======================================== */
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .glass-dark {
            background: rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .text-shadow {
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .text-shadow-lg {
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-50">

    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu-overlay" class="mobile-menu-overlay lg:hidden"></div>

    <div id="app-wrapper" class="page-wrapper flex flex-col min-h-screen">
        @include('client.layouts.partials.header')

        <main class="flex-grow">
            @yield('content')
        </main>

        @include('client.layouts.partials.footer')
    </div>

    <!-- Auth Modals -->
    <x-client.modal id="login-modal" title="Đăng nhập"
        subtitle="Đăng nhập tài khoản Du Lịch Việt và khám phá niềm vui của bạn ở bất cứ đâu">
        @include('client.auth.partials.login-form')
    </x-client.modal>
    <x-client.modal id="register-modal" title="Đăng ký"
        subtitle="Nhận tài khoản Du Lịch Việt và khám phá niềm vui của bạn ở bất cứ đâu">
        @include('client.auth.partials.register-form')
    </x-client.modal>
    <x-client.modal id="forgot-password-modal" title="Quên mật khẩu"
        subtitle="Nhập email của bạn để nhận mật khẩu mới từ hệ thống Du Lịch Việt">
        @include('client.auth.partials.forgot-password-form')
    </x-client.modal>

    <!-- Core Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/axios@1.7.7/dist/axios.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js" defer></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js" defer></script>

    <!-- GSAP for Advanced Animations -->
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12/dist/gsap.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12/dist/ScrollTrigger.min.js" defer></script>

    <script src="{{ asset('js/client-app.js') }}" defer></script>

    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Initialize AOS
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 800,
                    once: true,
                    easing: 'ease-out-cubic',
                    offset: 50
                });
            }

            // Initialize GSAP ScrollTrigger
            if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
                gsap.registerPlugin(ScrollTrigger);

                // Header scroll effect
                const header = document.querySelector('header');
                if (header) {
                    ScrollTrigger.create({
                        start: 'top -50',
                        onUpdate: (self) => {
                            if (self.direction === 1 && self.scroll() > 50) {
                                header.classList.add('header-scrolled');
                            } else if (self.scroll() <= 50) {
                                header.classList.remove('header-scrolled');
                            }
                        }
                    });
                }

                // Reveal animations
                gsap.utils.toArray('.reveal-up').forEach(elem => {
                    ScrollTrigger.create({
                        trigger: elem,
                        start: 'top 85%',
                        onEnter: () => elem.classList.add('revealed')
                    });
                });

                // Stagger animations
                gsap.utils.toArray('.stagger-children').forEach(container => {
                    ScrollTrigger.create({
                        trigger: container,
                        start: 'top 80%',
                        onEnter: () => container.classList.add('animate')
                    });
                });
            }

            // Session messages
            @if (session('registration_error') && $errors->any())
                window.openModal('register-modal');
            @elseif ($errors->any())
                window.openModal('login-modal');
            @endif

            @if (session('success'))
                window.showSuccessToast(@json(session('success')));
            @endif

            @if (session('error'))
                window.showErrorToast(@json(session('error')));
            @endif
        });
    </script>

</body>

</html>