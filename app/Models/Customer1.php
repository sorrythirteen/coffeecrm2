<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer1 extends Model
{
    protected $table = 'customers1';
    public $timestamps = false;

    protected $fillable = ['name', 'email', 'phone', 'address'];

    public function orders()
{
    return $this->hasMany(Order1::class, 'customer_id');
}
}
