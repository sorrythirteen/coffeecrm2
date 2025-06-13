<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu1 extends Model
{
    protected $table = 'menu1';
    public $timestamps = false;

    protected $fillable = ['name', 'description', 'price'];

    public function orderItems()
    {
        return $this->hasMany(OrderItem1::class, 'item_id');
    }
}
