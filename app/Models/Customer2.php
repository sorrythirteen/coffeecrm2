<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer2 extends Model
{
    protected $table = 'customers2';
    public $timestamps = false;

    protected $fillable = ['name', 'email', 'phone', 'address'];

    public function orders()
{
    return $this->hasMany(Order2::class, 'customer_id');
}
}
