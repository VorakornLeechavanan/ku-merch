<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public function cartitems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
