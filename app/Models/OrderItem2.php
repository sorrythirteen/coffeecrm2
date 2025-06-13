<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem2 extends Model
{
    use HasFactory;

    protected $table = 'order_items2';

    protected $fillable = [
        'order_id',
        'menu_id',  
        'quantity',
        'price',
    ];

    public function order()
    {
        return $this->belongsTo(Order2::class, 'order_id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu2::class, 'menu_id');
    }
}
