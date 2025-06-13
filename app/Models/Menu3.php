<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu3 extends Model
{
    protected $table = 'menu3';
    public $timestamps = false;

    protected $fillable = ['name', 'description', 'price'];


    public function orderItems()
    {
        return $this->hasMany(OrderItem2::class, 'item_id');
    }
}
