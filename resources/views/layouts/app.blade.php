<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Aplikasi Manajemen Keuangan Pribadi">
    <title>FinanceApp - Kelola Keuangan Anda</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        // Apply dark mode BEFORE page renders (prevents flash)
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>
<body class="bg-slate-50 dark:bg-slate-950 min-h-screen text-slate-800 dark:text-slate-200 antialiased transition-colors duration-300">

    <!-- Navbar -->
    <nav class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-lg border-b border-slate-200 dark:border-slate-800 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <a href="/" class="flex items-center gap-2.5">
                    <span class="text-2xl">💳</span>
                    <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-violet-600 dark:from-indigo-400 dark:to-violet-400 tracking-tight">
                        FinanceApp
                    </span>
                </a>
                <div class="flex items-center gap-2">
                    <!-- Theme Toggle -->
                    <button id="theme-toggle" type="button" class="w-10 h-10 flex items-center justify-center text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-xl transition-colors" title="Ganti Tema">
                        <svg id="icon-moon" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                        <svg id="icon-sun" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"></path></svg>
                    </button>

                    @auth
                    <!-- User Dropdown -->
                    <div class="relative" id="user-menu-wrapper">
                        <button id="user-menu-btn" type="button"
                            class="flex items-center gap-2.5 pl-2 pr-3 py-1.5 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors group">
                            <!-- Avatar -->
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center text-white text-sm font-bold shadow-sm">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300 hidden sm:block">
                                {{ Auth::user()->name }}
                            </span>
                            <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" id="user-chevron" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="user-dropdown"
                            class="hidden absolute right-0 mt-2 w-56 bg-white dark:bg-slate-900 rounded-2xl shadow-xl border border-slate-100 dark:border-slate-800 overflow-hidden z-50">
                            <!-- User info -->
                            <div class="px-4 py-3 border-b border-slate-100 dark:border-slate-800">
                                <p class="text-sm font-semibold text-slate-800 dark:text-slate-100">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5 truncate">{{ Auth::user()->email }}</p>
                            </div>
                            <!-- Logout -->
                            <div class="p-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full flex items-center gap-2.5 px-3 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-xl transition-colors font-medium">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endauth

                    @guest
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 rounded-xl transition-colors">
                        Masuk
                    </a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <main class="py-6 sm:py-8">
        @yield('content')
    </main>

    <footer class="text-center text-sm text-slate-400 dark:text-slate-600 py-6 border-t border-slate-200 dark:border-slate-800">
        © {{ date('Y') }} FinanceApp &mdash; Kelola Keuangan Anda dengan Cerdas
    </footer>

    <script>
        (function() {
            const iconMoon = document.getElementById('icon-moon');
            const iconSun = document.getElementById('icon-sun');
            const toggleBtn = document.getElementById('theme-toggle');

            function updateIcons() {
                const isDark = document.documentElement.classList.contains('dark');
                iconMoon.classList.toggle('hidden', isDark);
                iconSun.classList.toggle('hidden', !isDark);
            }
            updateIcons();

            toggleBtn.addEventListener('click', function() {
                const isDark = document.documentElement.classList.contains('dark');
                if (isDark) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
                updateIcons();
            });

            // User dropdown
            const userMenuBtn = document.getElementById('user-menu-btn');
            const userDropdown = document.getElementById('user-dropdown');
            const userChevron = document.getElementById('user-chevron');

            if (userMenuBtn && userDropdown) {
                userMenuBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const isOpen = !userDropdown.classList.contains('hidden');
                    userDropdown.classList.toggle('hidden', isOpen);
                    if (userChevron) userChevron.style.transform = isOpen ? '' : 'rotate(180deg)';
                });

                document.addEventListener('click', function() {
                    userDropdown.classList.add('hidden');
                    if (userChevron) userChevron.style.transform = '';
                });
            }
        })();
    </script>
</body>
</html>
