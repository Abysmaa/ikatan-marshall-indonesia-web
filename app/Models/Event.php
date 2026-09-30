<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'slug', 'logo', 'thumbnail', 'description', 'event_date', 'location', 'status', 'sort_order'])]
class Event extends Model
{
    protected function casts(): array
    {
        return [
            'event_date' => 'date',
            'status' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class);
    }
}
