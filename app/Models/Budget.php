<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['category_id', 'amount', 'month'])]
class Budget extends Model
{
    public function category() {
        return $this->belongsTo(Category::class);
    }
}
