<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order2 extends Model
{
    protected $table = 'orders2';
    public $timestamps = false;

    protected $fillable = [
        'customer_id',
        'employee_id',
        'order_date',
        'status',
        'total_amount',
    ];


    public function customer()
    {
        return $this->belongsTo(Customer2::class, 'customer_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee2::class, 'employee_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem2::class, 'order_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction2::class, 'order_id');
    }
}
