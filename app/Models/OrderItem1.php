<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem1 extends Model
{
    use HasFactory;

    protected $table = 'order_items1';

    protected $fillable = [
        'order_id',
        'menu_id',
        'quantity',
        'price',
    ];

    public function order()
    {
        return $this->belongsTo(Order1::class, 'order_id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu1::class, 'menu_id');
    }
}
