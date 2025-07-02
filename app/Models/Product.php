<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Soldout;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    public function user() : BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function sold() : HasMany{
        return $this->hasMany(Soldout::class);
    }
}
