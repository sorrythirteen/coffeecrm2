<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order3 extends Model
{
    use HasFactory;

    protected $table = 'orders3';

    protected $fillable = [
        'customer_id',
        'employee_id',
        'order_date',
        'status',
        'total_amount',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer3::class, 'customer_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem3::class, 'order_id');
    }
}
