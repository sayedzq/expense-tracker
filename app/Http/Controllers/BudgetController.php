<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric|min:1',
            'month' => 'required|date_format:Y-m',
        ]);

        Budget::updateOrCreate(
            ['category_id' => $validated['category_id'], 'month' => $validated['month']],
            ['amount' => $validated['amount']]
        );

        return redirect()->back()->with('success', 'Target Anggaran berhasil ditetapkan!');
    }
}
