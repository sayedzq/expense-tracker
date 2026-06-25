<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Wallet;
use App\Models\Category;
use App\Models\Budget;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->toDateString());
        $currentMonth = Carbon::parse($startDate)->format('Y-m');

        $transactions = Transaction::with(['category', 'wallet'])
            ->whereBetween('transaction_date', [$startDate, $endDate])
            ->orderBy('transaction_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        $totalIncome = $transactions->where('type', 'income')->sum('amount');
        $totalExpense = $transactions->where('type', 'expense')->sum('amount');
        $totalBalance = Wallet::sum('balance');

        $wallets = Wallet::all();
        $categories = Category::all();

        // Data for Category Pie Chart
        $expensesByCategory = $transactions->where('type', 'expense')
            ->groupBy(function($item) {
                return $item->category ? $item->category->name : 'Uncategorized';
            })
            ->map->sum('amount');

        // Data for Daily Line Chart
        $dailyExpenses = $transactions->where('type', 'expense')
            ->groupBy('transaction_date')
            ->map->sum('amount')->sortKeys();

        // Budgets and Alerts Logic
        $expensesByCategoryId = $transactions->where('type', 'expense')
            ->groupBy('category_id')
            ->map->sum('amount');
            
        $budgets = Budget::with('category')->where('month', $currentMonth)->get();
        $budgetAlerts = [];
        foreach ($budgets as $budget) {
            $spent = $expensesByCategoryId->get($budget->category_id, 0);
            if ($spent > $budget->amount) {
                $budgetAlerts[] = [
                    'category' => $budget->category->name,
                    'icon' => $budget->category->icon,
                    'budget' => $budget->amount,
                    'spent' => $spent,
                    'over' => $spent - $budget->amount
                ];
            }
        }

        return view('transactions.index', compact(
            'transactions', 'totalIncome', 'totalExpense', 'totalBalance', 
            'wallets', 'categories', 'startDate', 'endDate',
            'expensesByCategory', 'dailyExpenses', 'budgetAlerts', 'currentMonth'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:1',
            'wallet_id' => 'required|exists:wallets,id',
            'category_id' => 'required|exists:categories,id',
            'transaction_date' => 'required|date',
            'description' => 'nullable|string|max:255',
        ]);

        $transaction = Transaction::create($validated);

        $wallet = Wallet::find($validated['wallet_id']);
        if ($validated['type'] == 'income') {
            $wallet->balance += $validated['amount'];
        } elseif ($validated['type'] == 'expense') {
            $wallet->balance -= $validated['amount'];
        }
        $wallet->save();

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil disimpan!');
    }

    public function destroy(Transaction $transaction)
    {
        $wallet = $transaction->wallet;
        if ($wallet) {
            if ($transaction->type == 'income') {
                $wallet->balance -= $transaction->amount;
            } elseif ($transaction->type == 'expense') {
                $wallet->balance += $transaction->amount;
            }
            $wallet->save();
        }

        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus!');
    }
}
