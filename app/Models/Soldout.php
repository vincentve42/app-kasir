<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Soldout extends Model
{
    public function sold_product() : BelongsTo{
        return $this->belongsTo(Product::class);
    }
    public function sold() : BelongsTo{
        return $this->belongsTo(User::class);
    }
}
