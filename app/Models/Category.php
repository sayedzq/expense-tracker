<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['name', 'type', 'color', 'icon'])]
class Category extends Model
{
    public function transactions() {
        return $this->hasMany(Transaction::class);
    }
}
