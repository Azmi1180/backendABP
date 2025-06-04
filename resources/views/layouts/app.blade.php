<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'InstanNews') }} - @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- For Lucide Icons (if you want to use them similarly) - CDN option --}}
    <script src="https://unpkg.com/lucide-static@latest/ro"></script>
    <style>
        /* Basic modal styles - can be improved with JS */
        .modal-overlay { display: none; position: fixed; inset: 0; background-color: rgba(0,0,0,0.5); z-index: 50; }
        .modal-content { background-color: white; margin: 10% auto; padding: 20px; border-radius: 8px; max-width: 800px; max-height: 80vh; overflow-y: auto; }
        .modal-active .modal-overlay { display: flex; align-items: center; justify-content: center; }
        /* Sidebar toggle for mobile - basic JS will be needed */
        @media (max-width: 1023px) {
            .sidebar-mobile-closed { transform: translateX(-100%); }
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside id="sidebar" class="fixed left-0 top-0 h-full w-64 bg-[#003479] text-white z-40 transform transition-transform duration-300 ease-in-out lg:translate-x-0 sidebar-mobile-closed">
            <div class="p-4">
                <div class="text-xl font-bold mb-8 flex items-center justify-between">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <i data-lucide="newspaper" class="w-6 h-6"></i> InstanNews
                    </a>
                    <button class="lg:hidden" onclick="toggleSidebar()">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>
                <nav class="flex flex-col">
                    <a href="{{ route('home') }}" class="py-2 px-4 rounded-lg text-left mb-2 flex items-center gap-2 {{ request()->routeIs('home') ? 'bg-blue-500' : 'hover:bg-blue-500' }}">
                        <i data-lucide="home" class="w-4 h-4"></i> Home
                    </a>
                    @auth
                    <a href="{{ route('articles.saved') }}" class="py-2 px-4 rounded-lg text-left flex items-center gap-2 {{ request()->routeIs('articles.saved') ? 'bg-blue-500' : 'hover:bg-blue-500' }}">
                        <i data-lucide="bookmark" class="w-4 h-4"></i> Saved Articles
                    </a>
                    @endauth
                </nav>
            </div>
            @auth
            <div class="p-4 mt-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full hover:bg-red-500 py-2 px-4 rounded-lg text-left flex items-center gap-2">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                        Logout ({{ Auth::user()->username }})
                    </button>
                </form>
            </div>
            @endauth
        </aside>

        <!-- Main Content -->
        <main class="flex-1 lg:ml-64">
            <!-- Header -->
            <div class="fixed top-0 right-0 left-0 lg:left-64 bg-white shadow-sm px-6 py-4 z-30">
                <div class="flex items-center gap-2">
                    <button class="lg:hidden mr-3" onclick="toggleSidebar()">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                    <i data-lucide="newspaper" class="w-6 h-6"></i>
                    <span class="text-xl font-bold text-gray-800">InstanNews</span>
                </div>
            </div>

            <!-- Page Content -->
            <div class="pt-20 p-6 bg-gray-100 min-h-screen">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Basic sidebar toggle
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('sidebar-mobile-closed');
            // You might want an overlay for mobile here too
        }

        // Basic Modal (example, you'll need to trigger this)
        let currentModal = null;
        function openModal(modalId) {
            currentModal = document.getElementById(modalId);
            if (currentModal) {
                document.body.classList.add('modal-active');
            }
        }
        function closeModal() {
            if (currentModal) {
                document.body.classList.remove('modal-active');
                currentModal = null;
            }
        }
        // Close modal if overlay is clicked
        document.querySelectorAll('.modal-overlay').forEach(overlay => {
            overlay.addEventListener('click', function(event) {
                if (event.target === this) {
                    closeModal();
                }
            });
        });
    </script>
    @stack('scripts') {{-- For page-specific scripts --}}
</body>
</html>