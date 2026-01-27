<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Laravel'))</title>
    <meta name="description" content="@yield('description', 'King Express Travel - Khám phá niềm vui của bạn ở bất cứ đâu.')">

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

    <!-- Alpine.js Focus Plugin (must load before Alpine) -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>

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
                            '0%, 100%': {
                                transform: 'translateY(0)'
                            },
                            '50%': {
                                transform: 'translateY(-10px)'
                            },
                        },
                        shimmer: {
                            '0%': {
                                backgroundPosition: '-200% 0'
                            },
                            '100%': {
                                backgroundPosition: '200% 0'
                            },
                        },
                        gradient: {
                            '0%, 100%': {
                                backgroundPosition: '0% 50%'
                            },
                            '50%': {
                                backgroundPosition: '100% 50%'
                            },
                        },
                        glow: {
                            '0%': {
                                boxShadow: '0 0 5px rgba(245, 158, 11, 0.5)'
                            },
                            '100%': {
                                boxShadow: '0 0 20px rgba(245, 158, 11, 0.8), 0 0 30px rgba(245, 158, 11, 0.4)'
                            },
                        },
                        slideUp: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateY(20px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateY(0)'
                            },
                        },
                        slideDown: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateY(-10px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateY(0)'
                            },
                        },
                        fadeIn: {
                            '0%': {
                                opacity: '0'
                            },
                            '100%': {
                                opacity: '1'
                            },
                        },
                        scaleIn: {
                            '0%': {
                                opacity: '0',
                                transform: 'scale(0.95)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'scale(1)'
                            },
                        },
                    },
                },
            },
        };
    </script>
    @stack('styles')
    <style>
        /* Alpine.js cloak - hide elements until Alpine loads */
        [x-cloak] {
            display: none !important;
        }

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
            /* Shadows */
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            --shadow-2xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            --shadow-glow: 0 0 30px rgba(245, 158, 11, 0.3);
            /* Spacing Scale */
            --space-4: 1rem;
            --space-6: 1.5rem;
            /* Typography Scale */
            --text-sm: 0.875rem;
            /* Radius */
            --radius-lg: 0.5rem;
            --radius-sm: 0.125rem;
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

        ::selection {
            background: var(--color-primary-accent);
            color: var(--color-text-on-primary);
        }

        /* Page Load Animation */
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

        /* Toast Styles */
        .custom-toast.swal2-popup {
            font-size: 0.875rem;
            padding: 0.75rem 1.25rem;
            border-radius: 12px;
            box-shadow: var(--shadow-xl);
        }

        /* Utils */
        .gradient-text {
            background: linear-gradient(135deg, var(--color-primary-accent), var(--color-primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .float-animation {
            animation: float 6s ease-in-out infinite;
        }

        .reveal-up {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s var(--ease-smooth);
        }

        .reveal-up.revealed {
            opacity: 1;
            transform: translateY(0);
        }

        /* Stagger Children Animation */
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

        @keyframes staggerFadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Mobile Bottom Nav */
        .bottom-nav-item {
            position: relative;
            -webkit-tap-highlight-color: transparent;
        }

        .bottom-nav-item::before {
            content: '';
            position: absolute;
            top: 2px;
            left: 50%;
            transform: translateX(-50%) scaleX(0);
            width: 24px;
            height: 3px;
            background: linear-gradient(to right, var(--color-primary), #ea580c);
            border-radius: 999px;
            transition: transform 0.2s ease;
        }

        .bottom-nav-item[aria-current="page"]::before {
            transform: translateX(-50%) scaleX(1);
        }

        .safe-area-bottom {
            padding-bottom: env(safe-area-inset-bottom, 0);
        }

        @supports (padding-bottom: env(safe-area-inset-bottom)) {
            #mobile-bottom-nav {
                padding-bottom: max(8px, env(safe-area-inset-bottom));
            }
        }

        /* Skip Link */
        .skip-link {
            position: absolute;
            top: -100%;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
            padding: var(--space-4) var(--space-6);
            background: var(--color-primary);
            color: var(--color-text-on-primary);
            font-weight: 700;
            font-size: var(--text-sm);
            border-radius: var(--radius-lg);
            text-decoration: none;
            transition: top 0.3s var(--ease-smooth);
            box-shadow: var(--shadow-lg);
        }

        .skip-link:focus {
            top: var(--space-4);
        }

        /* SweetAlert2 Overrides */
        div:where(.swal2-container).swal2-top-end {
            padding: 1rem !important;
        }

        div:where(.swal2-popup).custom-toast {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(245, 158, 11, 0.15) !important;
            box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.1) !important;
            border-radius: 16px !important;
        }

        div:where(.swal2-icon).swal2-success {
            border-color: var(--color-primary) !important;
            color: var(--color-primary) !important;
        }

        div:where(.swal2-timer-progress-bar) {
            background: linear-gradient(90deg, var(--color-primary), var(--color-primary-dark)) !important;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-50">
    <!-- Skip Link for Keyboard Users -->
    <a href="#main-content" class="skip-link">
        Bỏ qua đến nội dung chính
    </a>

    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu-overlay" class="mobile-menu-overlay lg:hidden"></div>

    <div id="app-wrapper" class="page-wrapper flex flex-col min-h-screen">
        {{-- Header Component --}}
        <x-client.header />

        <main id="main-content" class="flex-grow" role="main">
            @yield('content')
        </main>

        {{-- Footer Component (Chứa cả Mobile Bottom Nav) --}}
        <x-client.footer />
    </div>


    <!-- Core Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/axios@1.7.7/dist/axios.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js" defer></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js" defer></script>
    <!-- GSAP for Advanced Animations -->
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12/dist/gsap.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12/dist/ScrollTrigger.min.js" defer></script>

    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Initialize AOS
            if (typeof AOS !== 'undefined') {
                const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
                AOS.init({
                    duration: 800,
                    once: true,
                    easing: 'ease-out-cubic',
                    offset: 50,
                    disable: prefersReducedMotion
                });
            }

            // Initialize GSAP
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


            // Custom Toast Helpers
            window.showSuccessToast = function(message) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: message,
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    customClass: {
                        popup: 'custom-toast'
                    }
                });
            };

            window.showErrorToast = function(message) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: message,
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    customClass: {
                        popup: 'custom-toast'
                    }
                });
            };

            const sessionSuccess = {{ \Illuminate\Support\Js::from(session('success')) }};
            const sessionError = {{ \Illuminate\Support\Js::from(session('error')) }};

            if (sessionSuccess) window.showSuccessToast(sessionSuccess);
            if (sessionError) window.showErrorToast(sessionError);
        });
    </script>
</body>

</html>
