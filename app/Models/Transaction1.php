<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction1 extends Model
{
    protected $table = 'transactions1';
    public $timestamps = false;

    protected $fillable = ['order_id', 'amount', 'transaction_date', 'payment_method'];

    public function order()
    {
        return $this->belongsTo(Order1::class, 'order_id');
    }
}
