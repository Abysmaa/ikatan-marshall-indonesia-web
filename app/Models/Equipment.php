<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'slug', 'description', 'image', 'quantity', 'availability', 'sort_order', 'status'])]
class Equipment extends Model
{
    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'sort_order' => 'integer',
            'status' => 'boolean',
        ];
    }
}
