<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['name', 'type', 'balance'])]
class Wallet extends Model
{
    public function transactions() {
        return $this->hasMany(Transaction::class);
    }
}
