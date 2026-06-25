<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['type', 'amount', 'transaction_date', 'description', 'wallet_id', 'to_wallet_id', 'category_id'])]
class Transaction extends Model
{
    public function wallet() {
        return $this->belongsTo(Wallet::class, 'wallet_id');
    }
    
    public function toWallet() {
        return $this->belongsTo(Wallet::class, 'to_wallet_id');
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
