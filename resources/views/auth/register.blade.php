<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Daftar ke FinanceApp - Kelola Keuangan Anda">
    <title>Daftar - FinanceApp</title>
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
            width: 450px; height: 450px;
            background: radial-gradient(circle, #a855f7, #7c3aed);
            top: -120px; right: -120px;
            animation-delay: 0s;
        }
        .orb-2 {
            width: 350px; height: 350px;
            background: radial-gradient(circle, #ec4899, #db2777);
            bottom: -80px; left: -80px;
            animation-delay: -4s;
        }
        .orb-3 {
            width: 280px; height: 280px;
            background: radial-gradient(circle, #06b6d4, #0891b2);
            top: 40%; right: 25%;
            animation-delay: -2s;
            opacity: 0.15;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(-25px, 25px) scale(1.04); }
            66% { transform: translate(20px, -20px) scale(0.96); }
        }

        /* Glass card */
        .glass-card {
            background: rgba(255, 255, 255, 0.04);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 32px 64px rgba(0,0,0,0.5), inset 0 1px 0 rgba(255,255,255,0.1);
        }

        /* Left panel - violet gradient */
        .panel-left {
            background: linear-gradient(135deg, #2e1065 0%, #4c1d95 30%, #6d28d9 60%, #7c3aed 100%);
            position: relative;
            overflow: hidden;
        }
        .panel-left::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
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
            border-color: rgba(168, 85, 247, 0.7);
            box-shadow: 0 0 0 3px rgba(168, 85, 247, 0.15);
        }

        /* Gradient button - violet */
        .btn-primary {
            background: linear-gradient(135deg, #7c3aed, #a855f7);
            box-shadow: 0 8px 24px rgba(124, 58, 237, 0.35);
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
            box-shadow: 0 12px 32px rgba(124, 58, 237, 0.5);
        }
        .btn-primary:hover::before { opacity: 1; }
        .btn-primary:active { transform: translateY(0); }

        /* Feature cards */
        .feature-item {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 16px;
            transition: all 0.3s ease;
        }
        .feature-item:hover {
            background: rgba(255,255,255,0.14);
            transform: translateX(4px);
        }

        /* Input wrapper focus effect */
        .input-wrapper:focus-within label { color: #c4b5fd; }

        /* Strength bar */
        .strength-bar {
            height: 4px;
            border-radius: 999px;
            background: rgba(255,255,255,0.08);
            transition: background 0.3s ease, transform 0.2s ease;
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
            background: #7c3aed;
            border-color: #7c3aed;
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

        /* Testimonial ticker */
        .steps-item {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(24px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-in { animation: slideUp 0.5s ease forwards; }
        .delay-1 { animation-delay: 0.1s; opacity: 0; }
        .delay-2 { animation-delay: 0.2s; opacity: 0; }
        .delay-3 { animation-delay: 0.3s; opacity: 0; }

        .auth-input.error {
            border-color: rgba(239, 68, 68, 0.5);
        }
    </style>
</head>
<body class="auth-bg flex items-center justify-center min-h-screen p-4 py-8">

    <!-- Animated orbs -->
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <!-- Main container -->
    <div class="relative w-full max-w-5xl mx-auto animate-in">
        <div class="glass-card rounded-3xl overflow-hidden flex flex-col md:flex-row min-h-[620px]">

            <!-- Left Panel -->
            <div class="panel-left md:w-5/12 p-10 flex-col justify-between hidden md:flex">
                <!-- Logo -->
                <div>
                    <div class="flex items-center gap-3 mb-12">
                        <div class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center text-2xl border border-white/20">
                            💳
                        </div>
                        <span class="text-2xl font-bold text-white tracking-tight">FinanceApp</span>
                    </div>

                    <h2 class="text-3xl font-bold text-white mb-3 leading-tight">
                        Mulai perjalanan<br>
                        <span class="bg-clip-text text-transparent bg-gradient-to-r from-violet-300 to-pink-300">finansial Anda</span>
                    </h2>
                    <p class="text-violet-200/70 text-sm leading-relaxed mb-8">
                        Daftar gratis dan mulai kelola keuangan Anda dengan lebih cerdas dan terorganisir.
                    </p>

                    <!-- Steps -->
                    <div class="space-y-3">
                        <div class="steps-item flex items-center gap-3 px-4 py-3">
                            <div class="w-7 h-7 rounded-full bg-violet-500 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">1</div>
                            <div>
                                <p class="text-white text-sm font-medium">Buat Akun</p>
                                <p class="text-violet-300/60 text-xs">Daftar dalam 30 detik</p>
                            </div>
                        </div>
                        <div class="steps-item flex items-center gap-3 px-4 py-3">
                            <div class="w-7 h-7 rounded-full bg-pink-500 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">2</div>
                            <div>
                                <p class="text-white text-sm font-medium">Tambah Dompet</p>
                                <p class="text-violet-300/60 text-xs">Hubungkan akun keuangan Anda</p>
                            </div>
                        </div>
                        <div class="steps-item flex items-center gap-3 px-4 py-3">
                            <div class="w-7 h-7 rounded-full bg-cyan-500 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">3</div>
                            <div>
                                <p class="text-white text-sm font-medium">Catat & Pantau</p>
                                <p class="text-violet-300/60 text-xs">Lihat laporan keuangan Anda</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quote -->
                <div class="p-4 rounded-2xl" style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1);">
                    <p class="text-violet-200/80 text-sm italic leading-relaxed">"Mengelola keuangan bukan soal seberapa banyak yang Anda hasilkan, tapi seberapa bijak Anda menggunakannya."</p>
                    <div class="flex items-center gap-2 mt-3">
                        <div class="w-7 h-7 rounded-full bg-gradient-to-br from-violet-400 to-pink-400 flex items-center justify-center text-white text-xs font-bold">F</div>
                        <span class="text-xs text-violet-300/60">FinanceApp Team</span>
                    </div>
                </div>
            </div>

            <!-- Right Panel (Form) -->
            <div class="md:w-7/12 flex flex-col justify-center p-8 md:p-12 md:overflow-y-auto">
                <!-- Mobile logo -->
                <div class="flex items-center justify-center gap-2 mb-6 md:hidden">
                    <span class="text-3xl">💳</span>
                    <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-violet-400 to-pink-400">FinanceApp</span>
                </div>

                <!-- Heading -->
                <div class="mb-7 animate-in delay-1">
                    <h1 class="text-3xl font-bold text-white mb-2">Buat Akun Baru 🚀</h1>
                    <p class="text-slate-400 text-sm">Isi informasi di bawah untuk memulai</p>
                </div>

                <!-- Errors -->
                @if ($errors->any())
                    <div class="mb-5 p-4 rounded-2xl space-y-1" style="background: rgba(239,68,68,0.08); border: 1px solid rgba(239,68,68,0.2);">
                        @foreach ($errors->all() as $error)
                            <p class="text-sm text-red-300 flex items-start gap-2"><span class="text-red-400 flex-shrink-0">•</span>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="space-y-4 animate-in delay-2">
                    @csrf

                    <!-- Name -->
                    <div class="input-wrapper">
                        <label for="name" class="block text-sm font-medium text-slate-300 mb-2 transition-colors">Nama Lengkap</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name"
                                placeholder="Nama lengkap Anda"
                                class="auth-input w-full pl-11 pr-4 py-3.5 rounded-2xl @error('name') error @enderror">
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="input-wrapper">
                        <label for="email" class="block text-sm font-medium text-slate-300 mb-2 transition-colors">Alamat Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                                placeholder="nama@email.com"
                                class="auth-input w-full pl-11 pr-4 py-3.5 rounded-2xl @error('email') error @enderror">
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="input-wrapper">
                        <label for="password" class="block text-sm font-medium text-slate-300 mb-2 transition-colors">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input id="password" type="password" name="password" required autocomplete="new-password"
                                placeholder="Minimal 8 karakter"
                                class="auth-input w-full pl-11 pr-12 py-3.5 rounded-2xl @error('password') error @enderror">
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
                        <!-- Strength bars -->
                        <div class="mt-2.5 flex gap-1.5" id="strength-bars">
                            <div class="strength-bar flex-1" id="bar-1"></div>
                            <div class="strength-bar flex-1" id="bar-2"></div>
                            <div class="strength-bar flex-1" id="bar-3"></div>
                            <div class="strength-bar flex-1" id="bar-4"></div>
                        </div>
                        <p class="text-xs mt-1.5 transition-colors" id="strength-label" style="color: rgba(255,255,255,0.3);">Masukkan password</p>
                    </div>

                    <!-- Confirm Password -->
                    <div class="input-wrapper">
                        <label for="password_confirmation" class="block text-sm font-medium text-slate-300 mb-2 transition-colors">Konfirmasi Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                                placeholder="Ulangi password Anda"
                                class="auth-input w-full pl-11 pr-4 py-3.5 rounded-2xl">
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="pt-1">
                        <button type="submit" id="btn-register"
                            class="btn-primary w-full py-4 px-6 text-white font-semibold rounded-2xl text-sm tracking-wide">
                            Buat Akun Sekarang →
                        </button>
                    </div>

                    <!-- Login link -->
                    <p class="text-center text-sm text-slate-500 pt-1">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="font-semibold text-violet-400 hover:text-violet-300 transition-colors ml-1">
                            Masuk di sini →
                        </a>
                    </p>
                </form>

                <!-- Theme toggle -->
                <div class="mt-6 flex justify-center animate-in delay-3">
                    <button id="theme-toggle" type="button" class="flex items-center gap-2 text-xs text-slate-600 hover:text-slate-400 transition-colors px-3 py-2 rounded-xl hover:bg-white/5">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                        Ganti tema
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Theme
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

        // Password strength
        const bars = [document.getElementById('bar-1'), document.getElementById('bar-2'), document.getElementById('bar-3'), document.getElementById('bar-4')];
        const strengthLabel = document.getElementById('strength-label');
        const colors = ['#ef4444', '#f97316', '#eab308', '#22c55e'];
        const labels = ['Sangat Lemah', 'Lemah', 'Sedang', 'Kuat 💪'];

        passwordInput.addEventListener('input', function () {
            const val = passwordInput.value;
            let score = 0;
            if (val.length >= 8) score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;

            bars.forEach((bar, i) => {
                bar.style.background = i < score ? colors[score - 1] : 'rgba(255,255,255,0.08)';
            });

            strengthLabel.textContent = val.length === 0 ? 'Masukkan password' : (labels[score - 1] || 'Sangat Lemah');
            strengthLabel.style.color = val.length === 0 ? 'rgba(255,255,255,0.3)' : colors[score - 1] || colors[0];
        });
    </script>
</body>
</html>

