@props(['id', 'title', 'subtitle'])

<div x-data="{
    open: false,
    init() {
        this.$watch('open', value => {
            if (value) {
                document.body.style.overflow = 'hidden';
                this.$nextTick(() => {
                    const firstInput = this.$el.querySelector('input, button[type=submit]');
                    if (firstInput) firstInput.focus();
                });
            } else {
                document.body.style.overflow = '';
            }
        });
    }
}" x-show="open"
    x-on:open-modal.window="if ($event.detail === '{{ $id }}') open = true"
    x-on:close-modal.window="if ($event.detail === '{{ $id }}') open = false"
    x-on:keydown.escape.window="open = false" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" id="{{ $id }}"
    class="modal-overlay fixed inset-0 z-[9999] flex items-center justify-center p-4" style="display: none;"
    aria-labelledby="modal-title-{{ $id }}" role="dialog" aria-modal="true" x-cloak>
    <style>
        .modal-overlay {
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal-overlay.active {
            opacity: 1;
        }

        .modal-panel-glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow:
                0 25px 50px -12px rgba(0, 0, 0, 0.25),
                0 0 0 1px rgba(255, 255, 255, 0.1) inset,
                0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transform: scale(0.95) translateY(10px);
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .modal-overlay.active .modal-panel-glass {
            transform: scale(1) translateY(0);
            opacity: 1;
        }

        .modal-header {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
            position: relative;
            overflow: hidden;
        }

        .modal-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.15) 0%, transparent 50%);
            transform: rotate(-30deg);
        }

        .modal-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        }

        .modal-close-btn {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .modal-close-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: rotate(90deg);
        }

        .modal-close-btn:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.3);
        }

        .modal-body {
            position: relative;
        }

        .modal-body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, var(--color-primary-light), var(--color-primary-accent), var(--color-primary-light));
            border-radius: 2px;
            opacity: 0.6;
        }

        @keyframes modal-shimmer {
            0% {
                background-position: -200% 0;
            }

            100% {
                background-position: 200% 0;
            }
        }

        .modal-shimmer {
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            background-size: 200% 100%;
            animation: modal-shimmer 2s infinite;
        }
    </style>

    <!-- Backdrop click to close -->
    <div @click="open = false" class="absolute inset-0"></div>

    <!-- Modal Panel -->
    <div @click.stop x-show="open" x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 scale-95 translate-y-4"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-4"
        class="modal-panel-glass rounded-2xl w-full max-w-md overflow-hidden relative z-10">
        <!-- Header with Gradient -->
        <div class="modal-header px-6 py-5 relative">
            <div class="flex justify-between items-start relative z-10">
                <div>
                    <h2 id="modal-title-{{ $id }}" class="text-xl font-bold text-white drop-shadow-sm">
                        {{ $title }}</h2>
                    @if ($subtitle)
                        <p class="mt-1 text-white/80 text-sm">{{ $subtitle }}</p>
                    @endif
                </div>
                <button type="button" @click="open = false"
                    class="modal-close-btn modal-close-button text-white cursor-pointer flex-shrink-0"
                    aria-label="Đóng">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>
        </div>

        <!-- Body -->
        <div class="modal-body px-6 pt-6 pb-6">
            {{ $slot }}
        </div>
    </div>
</div>
