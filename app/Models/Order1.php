<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order1 extends Model
{
    use HasFactory;

    protected $table = 'orders1';

    protected $fillable = [
        'customer_id',
        'employee_id',
        'order_date',
        'status',
        'total_amount',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer1::class, 'customer_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem1::class, 'order_id');
    }
}
