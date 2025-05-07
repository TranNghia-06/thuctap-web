<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'visit_date', 'quantity', 'price', 'status'
    ];

    public function getTotalAmountAttribute()
    {
        return $this->price * $this->quantity;
    }
}
