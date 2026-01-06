<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    protected function gallery(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? json_decode($value, true) : [],
            set: fn($value) => $value ? json_encode($value) : null
        );
    }

    public function getImage()
    {
        return $this->image ?: 'assets/img/no-image.png';
    }

}
