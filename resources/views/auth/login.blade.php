<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login ke FinanceApp - Kelola Keuangan Anda">
    <title>Login - FinanceApp</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Outfit', sans-serif; }

        .auth-bg {
            background: #0a0a1a;
            min-height: 100vh;
        }

        /* Animated gradient orbs */
        .orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.35;
            animation: float 8s ease-in-out infinite;
            pointer-events: none;
        }
        .orb-1 {
            width: 500px; height: 500px;
            background: radial-gradient(circle, #6366f1, #8b5cf6);
            top: -150px; left: -150px;
            animation-delay: 0s;
        }
        .orb-2 {
            width: 400px; height: 400px;
            background: radial-gradient(circle, #ec4899, #a855f7);
            bottom: -100px; right: -100px;
            animation-delay: -3s;
        }
        .orb-3 {
            width: 300px; height: 300px;
            background: radial-gradient(circle, #06b6d4, #3b82f6);
            top: 50%; left: 60%;
            animation-delay: -6s;
            opacity: 0.2;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -30px) scale(1.05); }
            66% { transform: translate(-20px, 20px) scale(0.95); }
        }

        /* Glass card */
        .glass-card {
            background: rgba(255, 255, 255, 0.04);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 32px 64px rgba(0,0,0,0.5), inset 0 1px 0 rgba(255,255,255,0.1);
        }

        /* Left panel gradient */
        .panel-left {
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 30%, #4c1d95 60%, #2d1b69 100%);
            position: relative;
            overflow: hidden;
        }
        .panel-left::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Ccircle cx='30' cy='30' r='20'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        /* Input styling */
        .auth-input {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            color: #f1f5f9;
            transition: all 0.3s ease;
            font-size: 14px;
        }
        .auth-input::placeholder { color: rgba(255,255,255,0.3); }
        .auth-input:focus {
            outline: none;
            background: rgba(255,255,255,0.09);
            border-color: rgba(99, 102, 241, 0.7);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
        }

        /* Gradient button */
        .btn-primary {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            box-shadow: 0 8px 24px rgba(99, 102, 241, 0.35);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .btn-primary::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.15), transparent);
            opacity: 0;
            transition: opacity 0.3s;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(99, 102, 241, 0.5);
        }
        .btn-primary:hover::before { opacity: 1; }
        .btn-primary:active { transform: translateY(0); }

        /* Feature cards on left panel */
        .feature-item {
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 16px;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }
        .feature-item:hover {
            background: rgba(255,255,255,0.12);
            transform: translateX(4px);
        }

        /* Stats */
        .stat-card {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 20px;
        }

        /* Floating label focus effect */
        .input-wrapper:focus-within label {
            color: #a5b4fc;
        }

        /* Custom checkbox */
        .custom-checkbox {
            appearance: none;
            width: 18px; height: 18px;
            border: 1.5px solid rgba(255,255,255,0.2);
            border-radius: 5px;
            background: rgba(255,255,255,0.06);
            cursor: pointer;
            position: relative;
            flex-shrink: 0;
            transition: all 0.2s;
        }
        .custom-checkbox:checked {
            background: #6366f1;
            border-color: #6366f1;
        }
        .custom-checkbox:checked::after {
            content: '✓';
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 11px;
            font-weight: bold;
        }

        /* Divider */
        .divider { position: relative; }
        .divider::before {
            content: '';
            position: absolute;
            top: 50%; left: 0; right: 0;
            height: 1px;
            background: rgba(255,255,255,0.08);
        }

        /* Scroll animation */
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-in {
            animation: slideUp 0.6s ease forwards;
        }
        .animate-in-delay-1 { animation-delay: 0.1s; opacity: 0; }
        .animate-in-delay-2 { animation-delay: 0.2s; opacity: 0; }
        .animate-in-delay-3 { animation-delay: 0.3s; opacity: 0; }

        /* Error state */
        .auth-input.error {
            border-color: rgba(239, 68, 68, 0.5);
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        /* Glow text */
        .glow-text {
            text-shadow: 0 0 40px rgba(99, 102, 241, 0.5);
        }
    </style>
</head>
<body class="auth-bg flex items-center justify-center min-h-screen p-4">

    <!-- Animated orbs -->
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <!-- Main container -->
    <div class="relative w-full max-w-5xl mx-auto animate-in" style="animation-delay: 0s;">
        <div class="glass-card rounded-3xl overflow-hidden flex flex-col md:flex-row min-h-[580px]">

            <!-- Left Panel -->
            <div class="panel-left md:w-5/12 p-10 flex flex-col justify-between hidden md:flex">
                <!-- Logo area -->
                <div>
                    <div class="flex items-center gap-3 mb-12">
                        <div class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center text-2xl border border-white/20">
                            💳
                        </div>
                        <span class="text-2xl font-bold text-white tracking-tight">FinanceApp</span>
                    </div>

                    <h2 class="text-3xl font-bold text-white mb-3 leading-tight">
                        Kontrol penuh atas<br>
                        <span class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-300 to-violet-300">keuangan Anda</span>
                    </h2>
                    <p class="text-indigo-200/70 text-sm leading-relaxed mb-8">
                        Pantau pemasukan, pengeluaran, dan anggaran Anda dalam satu dashboard yang intuitif.
                    </p>

                    <!-- Feature list -->
                    <div class="space-y-3">
                        <div class="feature-item flex items-center gap-3 px-4 py-3">
                            <div class="w-8 h-8 rounded-xl bg-indigo-500/30 flex items-center justify-center text-sm flex-shrink-0">📊</div>
                            <div>
                                <p class="text-white text-sm font-medium">Laporan Real-time</p>
                                <p class="text-indigo-300/60 text-xs">Grafik & statistik keuangan</p>
                            </div>
                        </div>
                        <div class="feature-item flex items-center gap-3 px-4 py-3">
                            <div class="w-8 h-8 rounded-xl bg-violet-500/30 flex items-center justify-center text-sm flex-shrink-0">💰</div>
                            <div>
                                <p class="text-white text-sm font-medium">Multi Dompet</p>
                                <p class="text-indigo-300/60 text-xs">Bank, Cash, E-wallet</p>
                            </div>
                        </div>
                        <div class="feature-item flex items-center gap-3 px-4 py-3">
                            <div class="w-8 h-8 rounded-xl bg-pink-500/30 flex items-center justify-center text-sm flex-shrink-0">🎯</div>
                            <div>
                                <p class="text-white text-sm font-medium">Manajemen Anggaran</p>
                                <p class="text-indigo-300/60 text-xs">Atur & pantau limit pengeluaran</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom stats -->
                <div class="stat-card p-4 flex items-center gap-4">
                    <div class="text-center flex-1 border-r border-white/10">
                        <p class="text-2xl font-bold text-white">100%</p>
                        <p class="text-xs text-indigo-300/60 mt-0.5">Gratis</p>
                    </div>
                    <div class="text-center flex-1 border-r border-white/10">
                        <p class="text-2xl font-bold text-white">∞</p>
                        <p class="text-xs text-indigo-300/60 mt-0.5">Transaksi</p>
                    </div>
                    <div class="text-center flex-1">
                        <p class="text-2xl font-bold text-white">🔒</p>
                        <p class="text-xs text-indigo-300/60 mt-0.5">Aman</p>
                    </div>
                </div>
            </div>

            <!-- Right Panel (Form) -->
            <div class="md:w-7/12 flex flex-col justify-center p-8 md:p-12">
                <!-- Mobile logo -->
                <div class="flex items-center justify-center gap-2 mb-8 md:hidden">
                    <span class="text-3xl">💳</span>
                    <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 to-violet-400">FinanceApp</span>
                </div>

                <!-- Heading -->
                <div class="mb-8 animate-in animate-in-delay-1">
                    <h1 class="text-3xl font-bold text-white mb-2">Selamat Datang 👋</h1>
                    <p class="text-slate-400 text-sm">Masuk ke akun Anda untuk mulai mengelola keuangan</p>
                </div>

                <!-- Error Alert -->
                @if ($errors->any())
                    <div class="mb-6 p-4 rounded-2xl flex items-start gap-3" style="background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.2);">
                        <span class="text-red-400 text-lg flex-shrink-0 mt-0.5">⚠️</span>
                        <p class="text-sm text-red-300">{{ $errors->first() }}</p>
                    </div>
                @endif

                @if (session('status'))
                    <div class="mb-6 p-4 rounded-2xl" style="background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.2);">
                        <p class="text-sm text-green-300">{{ session('status') }}</p>
                    </div>
                @endif

                <!-- Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-5 animate-in animate-in-delay-2">
                    @csrf

                    <!-- Email -->
                    <div class="input-wrapper">
                        <label for="email" class="block text-sm font-medium text-slate-300 mb-2 transition-colors">
                            Alamat Email
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="email"
                                placeholder="nama@email.com"
                                class="auth-input w-full pl-11 pr-4 py-3.5 rounded-2xl @error('email') error @enderror"
                            >
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="input-wrapper">
                        <label for="password" class="block text-sm font-medium text-slate-300 mb-2 transition-colors">
                            Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="••••••••"
                                class="auth-input w-full pl-11 pr-12 py-3.5 rounded-2xl @error('password') error @enderror"
                            >
                            <button type="button" id="toggle-password" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-500 hover:text-slate-300 transition-colors">
                                <svg id="eye-open" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <svg id="eye-closed" class="w-4 h-4 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Remember + Forgot -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2.5 cursor-pointer group">
                            <input type="checkbox" name="remember" id="remember" class="custom-checkbox">
                            <span class="text-sm text-slate-400 group-hover:text-slate-300 transition-colors">Ingat saya</span>
                        </label>
                    </div>

                    <!-- Submit -->
                    <button type="submit" id="btn-login"
                        class="btn-primary w-full py-4 px-6 text-white font-semibold rounded-2xl text-sm tracking-wide">
                        Masuk ke Akun →
                    </button>

                    <!-- Divider -->
                    <div class="divider flex items-center justify-center py-1">
                        <span class="relative z-10 px-4 text-xs text-slate-500" style="background: transparent;">atau</span>
                    </div>

                    <!-- Demo hint -->
                    <div class="rounded-2xl p-4 text-center" style="background: rgba(99,102,241,0.07); border: 1px dashed rgba(99,102,241,0.25);">
                        <p class="text-xs text-indigo-400 mb-1 font-medium">🎯 Akun Demo</p>
                        <p class="text-xs text-slate-500">demo@financeapp.com / password</p>
                    </div>

                    <!-- Register link -->
                    <p class="text-center text-sm text-slate-500">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="font-semibold text-indigo-400 hover:text-indigo-300 transition-colors ml-1">
                            Daftar sekarang →
                        </a>
                    </p>
                </form>

                <!-- Theme toggle -->
                <div class="mt-8 flex justify-center animate-in animate-in-delay-3">
                    <button id="theme-toggle" type="button" class="flex items-center gap-2 text-xs text-slate-600 hover:text-slate-400 transition-colors px-3 py-2 rounded-xl hover:bg-white/5">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                        Ganti tema
                    </button>
                </div>
            </div>

        </div>
    </div>

    <script>
        // Theme toggle
        if (localStorage.getItem('color-theme') !== 'light') {
            document.documentElement.classList.add('dark');
        }
        document.getElementById('theme-toggle').addEventListener('click', function() {
            const isDark = document.documentElement.classList.contains('dark');
            document.documentElement.classList.toggle('dark', !isDark);
            localStorage.setItem('color-theme', isDark ? 'light' : 'dark');
        });

        // Password toggle
        const togglePassword = document.getElementById('toggle-password');
        const passwordInput = document.getElementById('password');
        const eyeOpen = document.getElementById('eye-open');
        const eyeClosed = document.getElementById('eye-closed');

        togglePassword.addEventListener('click', function () {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            eyeOpen.classList.toggle('hidden', isPassword);
            eyeClosed.classList.toggle('hidden', !isPassword);
        });
    </script>
</body>
</html>

