<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem3 extends Model
{
    protected $table = 'order_items3';
    public $timestamps = false;

    protected $fillable = ['order_id', 'item_id', 'quantity', 'price'];

    public function order()
    {
        return $this->belongsTo(Order3::class, 'order_id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu3::class, 'item_id');
    }
}
