@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
    
    @if(session('success'))
        <div class="mb-6 bg-emerald-100 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl shadow-sm flex items-center justify-between" role="alert">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 font-bold text-xl">&times;</button>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Kolom Kiri: Form & Ringkasan -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Kartu Total -->
            <div class="bg-gradient-to-br from-indigo-600 to-violet-700 rounded-3xl p-6 shadow-lg shadow-indigo-200 text-white relative overflow-hidden group">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-2xl group-hover:bg-white/20 transition duration-500"></div>
                <h2 class="text-indigo-100 font-medium mb-1">Total Pengeluaran</h2>
                <div class="text-4xl font-bold tracking-tight">Rp {{ number_format($totalExpenses, 0, ',', '.') }}</div>
            </div>

            <!-- Kartu Form -->
            <div class="bg-white/80 backdrop-blur-xl rounded-3xl p-6 shadow-sm border border-slate-100">
                <h3 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Catat Pengeluaran
                </h3>
                
                <form action="{{ route('expenses.store') }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-1">Judul Pengeluaran</label>
                        <input type="text" name="title" required class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 focus:border-indigo-500 focus:ring-indigo-500 transition shadow-sm" placeholder="Contoh: Makan Siang">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-1">Jumlah (Rp)</label>
                        <input type="number" name="amount" required min="0" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 focus:border-indigo-500 focus:ring-indigo-500 transition shadow-sm" placeholder="50000">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-1">Kategori</label>
                        <select name="category" required class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 focus:border-indigo-500 focus:ring-indigo-500 transition shadow-sm">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}">{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-1">Tanggal</label>
                        <input type="date" name="expense_date" required value="{{ date('Y-m-d') }}" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 focus:border-indigo-500 focus:ring-indigo-500 transition shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-1">Catatan (Opsional)</label>
                        <textarea name="notes" rows="2" class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 focus:border-indigo-500 focus:ring-indigo-500 transition shadow-sm" placeholder="Tambahkan catatan..."></textarea>
                    </div>
                    
                    <button type="submit" class="w-full bg-slate-900 hover:bg-indigo-600 text-white font-medium py-3 rounded-xl transition-all duration-300 shadow-md shadow-slate-200 hover:shadow-indigo-200 transform hover:-translate-y-0.5">
                        Simpan Pengeluaran
                    </button>
                </form>
            </div>
        </div>

        <!-- Kolom Kanan: Riwayat Pengeluaran -->
        <div class="lg:col-span-2">
            <div class="bg-white/80 backdrop-blur-xl rounded-3xl p-6 shadow-sm border border-slate-100 min-h-full">
                <h3 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    Riwayat Terkini
                </h3>

                @if($expenses->isEmpty())
                    <div class="text-center py-16 px-4 bg-slate-50/50 rounded-2xl border border-dashed border-slate-200">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto shadow-sm mb-4">
                            <span class="text-2xl">📝</span>
                        </div>
                        <p class="text-slate-500 font-medium">Belum ada pengeluaran tercatat.</p>
                        <p class="text-sm text-slate-400 mt-1">Mulai catat pengeluaran Anda menggunakan form di sebelah kiri.</p>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($expenses as $expense)
                            <div class="group flex items-center justify-between p-4 bg-white hover:bg-indigo-50/50 rounded-2xl border border-slate-100 hover:border-indigo-100 transition-all duration-300 shadow-sm hover:shadow">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center text-xl shadow-inner">
                                        @if($expense->category == 'Food') 🍔
                                        @elseif($expense->category == 'Transport') 🚗
                                        @elseif($expense->category == 'Bills') 🧾
                                        @elseif($expense->category == 'Entertainment') 🎬
                                        @elseif($expense->category == 'Shopping') 🛍️
                                        @else 📦
                                        @endif
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-slate-800">{{ $expense->title }}</h4>
                                        <div class="flex items-center gap-2 text-sm text-slate-500">
                                            <span class="px-2 py-0.5 bg-slate-100 rounded-md text-xs font-medium">{{ $expense->category }}</span>
                                            <span>&bull;</span>
                                            <span>{{ \Carbon\Carbon::parse($expense->expense_date)->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="flex items-center gap-6">
                                    <div class="text-right">
                                        <div class="font-bold text-slate-800">Rp {{ number_format($expense->amount, 0, ',', '.') }}</div>
                                    </div>
                                    
                                    <form action="{{ route('expenses.destroy', $expense) }}" method="POST" class="opacity-0 group-hover:opacity-100 transition-opacity">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Hapus pengeluaran ini?')" class="w-8 h-8 flex items-center justify-center rounded-full text-red-400 hover:text-white hover:bg-red-500 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        
    </div>
</div>
@endsection
