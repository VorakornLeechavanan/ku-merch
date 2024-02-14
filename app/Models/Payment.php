<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasOne(User::class);   
    }

    public function customer()
    {
        return $this->hasOne(Customer::class);   
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);   
    }


}
