<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wallet;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Demo user
        User::firstOrCreate(
            ['email' => 'demo@financeapp.com'],
            ['name' => 'Demo User', 'password' => Hash::make('password')]
        );

        // Dompet Default
        Wallet::firstOrCreate(['name' => 'Dompet Utama'], ['type' => 'Cash', 'balance' => 100000]);
        Wallet::firstOrCreate(['name' => 'Rekening Bank'], ['type' => 'Bank', 'balance' => 0]);
        Wallet::firstOrCreate(['name' => 'E-wallet (Gopay/OVO)'], ['type' => 'E-wallet', 'balance' => 0]);

        // Kategori Pemasukan
        Category::firstOrCreate(['name' => 'Gaji'], ['type' => 'income', 'icon' => '💰']);
        Category::firstOrCreate(['name' => 'Bonus'], ['type' => 'income', 'icon' => '🎁']);
        Category::firstOrCreate(['name' => 'Investasi'], ['type' => 'income', 'icon' => '📈']);

        // Kategori Pengeluaran
        Category::firstOrCreate(['name' => 'Makanan & Minuman'], ['type' => 'expense', 'icon' => '🍔']);
        Category::firstOrCreate(['name' => 'Transportasi'], ['type' => 'expense', 'icon' => '🚗']);
        Category::firstOrCreate(['name' => 'Pendidikan'], ['type' => 'expense', 'icon' => '📚']);
        Category::firstOrCreate(['name' => 'Tagihan bulanan'], ['type' => 'expense', 'icon' => '🧾']);
        Category::firstOrCreate(['name' => 'Hiburan'], ['type' => 'expense', 'icon' => '🎬']);
        Category::firstOrCreate(['name' => 'Belanja'], ['type' => 'expense', 'icon' => '🛍️']);
    }
}
