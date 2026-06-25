@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
    
    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-300 px-5 py-3.5 rounded-2xl flex items-center justify-between animate-fade-in" role="alert">
            <div class="flex items-center gap-2.5">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-emerald-600 dark:hover:text-emerald-200 text-xl leading-none">&times;</button>
        </div>
    @endif

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="bg-rose-50 dark:bg-rose-900/30 border border-rose-200 dark:border-rose-800 text-rose-700 dark:text-rose-300 px-5 py-3.5 rounded-2xl" role="alert">
            <ul class="list-disc list-inside space-y-1 text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Budget Over-Limit Alerts --}}
    @if(!empty($budgetAlerts))
        @foreach($budgetAlerts as $alert)
        <div class="bg-rose-50 dark:bg-rose-900/20 border border-rose-200 dark:border-rose-800 text-rose-700 dark:text-rose-300 px-5 py-3.5 rounded-2xl flex items-center justify-between" role="alert">
            <div class="flex items-center gap-2.5">
                <span class="text-xl">⚠️</span>
                <span class="font-medium">
                    {{ $alert['icon'] }} <strong>{{ $alert['category'] }}</strong> melebihi anggaran!
                    &mdash; Batas: Rp {{ number_format($alert['budget'], 0, ',', '.') }},
                    Terpakai: <strong>Rp {{ number_format($alert['spent'], 0, ',', '.') }}</strong>
                </span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-rose-400 hover:text-rose-600 text-xl leading-none">&times;</button>
        </div>
        @endforeach
    @endif

    {{-- ==================== SECTION 1: SUMMARY CARDS ==================== --}}
    <section>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            {{-- Balance --}}
            <div class="relative overflow-hidden bg-gradient-to-br from-indigo-600 to-violet-700 rounded-2xl p-6 text-white shadow-lg shadow-indigo-500/20 dark:shadow-indigo-500/10">
                <div class="absolute -right-6 -top-6 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                <p class="text-indigo-200 text-sm font-medium mb-1">💰 Saldo Keseluruhan</p>
                <p class="text-3xl sm:text-4xl font-bold tracking-tight">Rp {{ number_format($totalBalance, 0, ',', '.') }}</p>
            </div>
            {{-- Income --}}
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 border border-slate-200 dark:border-slate-800 shadow-sm">
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mb-1 flex items-center gap-1.5">
                    <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full inline-block"></span> Pemasukan Bulan Ini
                </p>
                <p class="text-3xl font-bold text-emerald-600 dark:text-emerald-400">Rp {{ number_format($totalIncome, 0, ',', '.') }}</p>
            </div>
            {{-- Expense --}}
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 border border-slate-200 dark:border-slate-800 shadow-sm">
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mb-1 flex items-center gap-1.5">
                    <span class="w-2.5 h-2.5 bg-rose-500 rounded-full inline-block"></span> Pengeluaran Bulan Ini
                </p>
                <p class="text-3xl font-bold text-rose-600 dark:text-rose-400">Rp {{ number_format($totalExpense, 0, ',', '.') }}</p>
            </div>
        </div>
    </section>

    {{-- ==================== SECTION 2: ADD TRANSACTION + WALLET INFO ==================== --}}
    <section>
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
            {{-- Transaction Form (3 cols wide) --}}
            <div class="lg:col-span-3 bg-white dark:bg-slate-900 rounded-2xl p-6 border border-slate-200 dark:border-slate-800 shadow-sm">
                <h2 class="text-lg font-bold text-slate-800 dark:text-white mb-5 flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Catat Transaksi Baru
                </h2>
                
                <form action="{{ route('transactions.store') }}" method="POST">
                    @csrf

                    {{-- Type Toggle --}}
                    <div class="grid grid-cols-2 gap-3 mb-5">
                        <label class="cursor-pointer">
                            <input type="radio" name="type" value="income" class="peer sr-only" required>
                            <div class="text-center py-2.5 rounded-xl border-2 border-slate-200 dark:border-slate-700 text-slate-500 dark:text-slate-400 font-medium peer-checked:border-emerald-500 peer-checked:bg-emerald-50 peer-checked:text-emerald-700 dark:peer-checked:border-emerald-500 dark:peer-checked:bg-emerald-900/30 dark:peer-checked:text-emerald-400 transition-all">
                                ↓ Pemasukan
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="type" value="expense" class="peer sr-only" checked>
                            <div class="text-center py-2.5 rounded-xl border-2 border-slate-200 dark:border-slate-700 text-slate-500 dark:text-slate-400 font-medium peer-checked:border-rose-500 peer-checked:bg-rose-50 peer-checked:text-rose-700 dark:peer-checked:border-rose-500 dark:peer-checked:bg-rose-900/30 dark:peer-checked:text-rose-400 transition-all">
                                ↑ Pengeluaran
                            </div>
                        </label>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-600 dark:text-slate-400 mb-1.5">Dompet / Akun</label>
                            <select name="wallet_id" required class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 dark:text-white px-4 py-2.5 focus:border-indigo-500 focus:ring-indigo-500 transition text-sm">
                                @foreach($wallets as $wallet)
                                    <option value="{{ $wallet->id }}">{{ $wallet->name }} (Rp {{ number_format($wallet->balance, 0, ',', '.') }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-600 dark:text-slate-400 mb-1.5">Kategori</label>
                            <select name="category_id" required class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 dark:text-white px-4 py-2.5 focus:border-indigo-500 focus:ring-indigo-500 transition text-sm">
                                <option value="">— Pilih Kategori —</option>
                                <optgroup label="📥 Pemasukan">
                                    @foreach($categories->where('type', 'income') as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->icon }} {{ $cat->name }}</option>
                                    @endforeach
                                </optgroup>
                                <optgroup label="📤 Pengeluaran">
                                    @foreach($categories->where('type', 'expense') as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->icon }} {{ $cat->name }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-5">
                        <div>
                            <label class="block text-sm font-medium text-slate-600 dark:text-slate-400 mb-1.5">Jumlah (Rp)</label>
                            <input type="number" name="amount" required min="1" class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 dark:text-white px-4 py-2.5 focus:border-indigo-500 focus:ring-indigo-500 transition text-sm" placeholder="50000">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-600 dark:text-slate-400 mb-1.5">Tanggal</label>
                            <input type="date" name="transaction_date" required value="{{ date('Y-m-d') }}" class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 dark:text-white px-4 py-2.5 focus:border-indigo-500 focus:ring-indigo-500 transition text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-600 dark:text-slate-400 mb-1.5">Catatan</label>
                            <input type="text" name="description" class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 dark:text-white px-4 py-2.5 focus:border-indigo-500 focus:ring-indigo-500 transition text-sm" placeholder="Opsional...">
                        </div>
                    </div>
                    
                    <button type="submit" class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-8 py-3 rounded-xl transition-all duration-200 shadow-md shadow-indigo-500/20 hover:shadow-lg hover:shadow-indigo-500/30 active:scale-[0.98]">
                        Simpan Transaksi
                    </button>
                </form>
            </div>

            {{-- Wallet Cards (2 cols wide) --}}
            <div class="lg:col-span-2 space-y-4">
                <h2 class="text-lg font-bold text-slate-800 dark:text-white flex items-center gap-2">
                    <span>👛</span> Dompet Anda
                </h2>
                @foreach($wallets as $wallet)
                <div class="bg-white dark:bg-slate-900 rounded-2xl p-5 border border-slate-200 dark:border-slate-800 shadow-sm flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center text-lg
                            @if($wallet->type == 'Cash') bg-amber-100 dark:bg-amber-900/30
                            @elseif($wallet->type == 'Bank') bg-blue-100 dark:bg-blue-900/30
                            @else bg-violet-100 dark:bg-violet-900/30
                            @endif
                        ">
                            @if($wallet->type == 'Cash') 💵
                            @elseif($wallet->type == 'Bank') 🏦
                            @else 📱
                            @endif
                        </div>
                        <div>
                            <p class="font-semibold text-slate-800 dark:text-white text-sm">{{ $wallet->name }}</p>
                            <p class="text-xs text-slate-400 dark:text-slate-500">{{ $wallet->type }}</p>
                        </div>
                    </div>
                    <p class="font-bold text-slate-800 dark:text-white">Rp {{ number_format($wallet->balance, 0, ',', '.') }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ==================== SECTION 3: ANALYTICS ==================== --}}
    <section>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Daily Chart (2 cols) --}}
            <div class="lg:col-span-2 bg-white dark:bg-slate-900 rounded-2xl p-6 border border-slate-200 dark:border-slate-800 shadow-sm">
                <h2 class="text-lg font-bold text-slate-800 dark:text-white mb-4">📈 Tren Pengeluaran Harian</h2>
                <div class="h-64">
                    <canvas id="dailyExpenseChart"></canvas>
                </div>
            </div>
            {{-- Category Chart (1 col) --}}
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 border border-slate-200 dark:border-slate-800 shadow-sm">
                <h2 class="text-lg font-bold text-slate-800 dark:text-white mb-4">📊 Per Kategori</h2>
                <canvas id="categoryExpenseChart"></canvas>
            </div>
        </div>
    </section>

    {{-- ==================== SECTION 4: BUDGET ==================== --}}
    <section>
        <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 border border-slate-200 dark:border-slate-800 shadow-sm">
            <h2 class="text-lg font-bold text-slate-800 dark:text-white mb-5 flex items-center gap-2">
                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Atur Anggaran Bulan Ini ({{ \Carbon\Carbon::parse($currentMonth . '-01')->translatedFormat('F Y') }})
            </h2>
            <form action="{{ route('budgets.store') }}" method="POST" class="flex flex-col sm:flex-row items-end gap-4">
                @csrf
                <input type="hidden" name="month" value="{{ $currentMonth }}">
                <div class="w-full sm:w-auto sm:flex-1">
                    <label class="block text-sm font-medium text-slate-600 dark:text-slate-400 mb-1.5">Kategori Pengeluaran</label>
                    <select name="category_id" required class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 dark:text-white px-4 py-2.5 focus:border-indigo-500 focus:ring-indigo-500 transition text-sm">
                        @foreach($categories->where('type', 'expense') as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->icon }} {{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full sm:w-auto sm:flex-1">
                    <label class="block text-sm font-medium text-slate-600 dark:text-slate-400 mb-1.5">Batas Maksimal (Rp)</label>
                    <input type="number" name="amount" required min="1" class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 dark:text-white px-4 py-2.5 focus:border-indigo-500 focus:ring-indigo-500 transition text-sm" placeholder="1500000">
                </div>
                <button type="submit" class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2.5 rounded-xl transition-all shadow-md active:scale-[0.98]">
                    Simpan Anggaran
                </button>
            </form>
        </div>
    </section>

    {{-- ==================== SECTION 5: TRANSACTION HISTORY ==================== --}}
    <section>
        <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 border border-slate-200 dark:border-slate-800 shadow-sm">
            
            {{-- Header + Date Filter --}}
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <h2 class="text-lg font-bold text-slate-800 dark:text-white flex items-center gap-2">
                    <svg class="w-5 h-5 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Riwayat Transaksi
                </h2>
                <form action="{{ route('transactions.index') }}" method="GET" class="flex flex-wrap items-center gap-2">
                    <input type="date" name="start_date" value="{{ $startDate }}" class="text-sm rounded-lg border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 dark:text-white px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 transition">
                    <span class="text-slate-400 dark:text-slate-600 font-medium">s/d</span>
                    <input type="date" name="end_date" value="{{ $endDate }}" class="text-sm rounded-lg border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 dark:text-white px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 transition">
                    <button type="submit" class="bg-indigo-100 dark:bg-indigo-900/50 text-indigo-700 dark:text-indigo-300 px-4 py-2 rounded-lg hover:bg-indigo-200 dark:hover:bg-indigo-800 transition text-sm font-medium">
                        🔍 Filter
                    </button>
                </form>
            </div>

            {{-- Transaction List --}}
            @if($transactions->isEmpty())
                <div class="text-center py-16 bg-slate-50 dark:bg-slate-800/30 rounded-2xl border-2 border-dashed border-slate-200 dark:border-slate-700">
                    <span class="text-4xl mb-4 block">📝</span>
                    <p class="text-slate-500 dark:text-slate-400 font-medium">Belum ada transaksi di periode ini.</p>
                    <p class="text-sm text-slate-400 dark:text-slate-500 mt-1">Gunakan formulir di atas untuk mencatat transaksi pertama Anda.</p>
                </div>
            @else
                <div class="space-y-3">
                    @foreach($transactions as $trx)
                        <div class="group flex items-center justify-between p-4 bg-slate-50 dark:bg-slate-800/50 hover:bg-indigo-50 dark:hover:bg-slate-800 rounded-xl border border-slate-100 dark:border-slate-800 transition-all duration-200">
                            <div class="flex items-center gap-4">
                                {{-- Icon --}}
                                <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg shrink-0
                                    @if($trx->type == 'income') bg-emerald-100 dark:bg-emerald-900/30 @else bg-slate-200 dark:bg-slate-700 @endif
                                ">
                                    {{ $trx->category->icon ?? '💸' }}
                                </div>
                                {{-- Details --}}
                                <div class="min-w-0">
                                    <p class="font-semibold text-slate-800 dark:text-white text-sm">{{ $trx->category->name ?? 'Tanpa Kategori' }}</p>
                                    <div class="flex flex-wrap items-center gap-x-2 gap-y-0.5 text-xs text-slate-400 dark:text-slate-500 mt-0.5">
                                        <span class="px-1.5 py-0.5 bg-slate-100 dark:bg-slate-700 rounded text-[11px] font-medium">{{ $trx->wallet->name }}</span>
                                        <span>{{ \Carbon\Carbon::parse($trx->transaction_date)->format('d M Y') }}</span>
                                        @if($trx->description)
                                            <span class="truncate max-w-[180px] text-slate-500 dark:text-slate-400">— {{ $trx->description }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-3 shrink-0">
                                @if($trx->type == 'income')
                                    <span class="font-bold text-emerald-600 dark:text-emerald-400 text-sm">+ Rp {{ number_format($trx->amount, 0, ',', '.') }}</span>
                                @else
                                    <span class="font-bold text-rose-600 dark:text-rose-400 text-sm">- Rp {{ number_format($trx->amount, 0, ',', '.') }}</span>
                                @endif
                                
                                <form action="{{ route('transactions.destroy', $trx) }}" method="POST" class="opacity-0 group-hover:opacity-100 transition-opacity">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Hapus transaksi ini?')" class="w-8 h-8 flex items-center justify-center rounded-lg text-red-400 hover:text-white hover:bg-red-500 transition-colors" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</div>

{{-- ==================== CHART.JS INITIALIZATION ==================== --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const isDark = document.documentElement.classList.contains('dark');
    const textColor = isDark ? '#94a3b8' : '#64748b';
    const gridColor = isDark ? '#1e293b' : '#f1f5f9';

    // Daily Expense Line Chart
    const dailyData = @json($dailyExpenses);
    const dailyLabels = Object.keys(dailyData).map(function(d) {
        const parts = d.split('-');
        return parts[2] + '/' + parts[1];
    });

    const dailyCtx = document.getElementById('dailyExpenseChart');
    if (dailyCtx) {
        new Chart(dailyCtx, {
            type: 'bar',
            data: {
                labels: dailyLabels,
                datasets: [{
                    label: 'Pengeluaran (Rp)',
                    data: Object.values(dailyData),
                    backgroundColor: isDark ? 'rgba(129, 140, 248, 0.6)' : 'rgba(99, 102, 241, 0.7)',
                    borderColor: '#6366f1',
                    borderWidth: 1,
                    borderRadius: 6,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(ctx) {
                                return 'Rp ' + ctx.parsed.y.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                scales: {
                    x: { ticks: { color: textColor, font: { size: 11 } }, grid: { display: false } },
                    y: {
                        ticks: {
                            color: textColor,
                            font: { size: 11 },
                            callback: function(v) { return 'Rp ' + (v / 1000) + 'k'; }
                        },
                        grid: { color: gridColor }
                    }
                }
            }
        });
    }

    // Category Doughnut Chart
    const categoryData = @json($expensesByCategory);
    const catCtx = document.getElementById('categoryExpenseChart');
    if (catCtx) {
        const hasData = Object.keys(categoryData).length > 0;
        new Chart(catCtx, {
            type: 'doughnut',
            data: {
                labels: hasData ? Object.keys(categoryData) : ['Belum ada data'],
                datasets: [{
                    data: hasData ? Object.values(categoryData) : [1],
                    backgroundColor: hasData
                        ? ['#6366f1', '#ec4899', '#14b8a6', '#f59e0b', '#8b5cf6', '#ef4444', '#06b6d4', '#84cc16']
                        : ['#e2e8f0'],
                    borderWidth: 0,
                    hoverOffset: 6
                }]
            },
            options: {
                responsive: true,
                cutout: '65%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: textColor,
                            font: { size: 11 },
                            padding: 12
                        }
                    },
                    tooltip: {
                        enabled: hasData,
                        callbacks: {
                            label: function(ctx) {
                                return ctx.label + ': Rp ' + ctx.parsed.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    }
});
</script>
@endsection
