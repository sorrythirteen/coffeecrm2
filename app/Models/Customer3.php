<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer3 extends Model
{
    protected $table = 'customers3';
    public $timestamps = false;

    protected $fillable = ['name', 'email', 'phone', 'address'];

    public function orders()
{
    return $this->hasMany(Order3::class, 'customer_id');
}
}
