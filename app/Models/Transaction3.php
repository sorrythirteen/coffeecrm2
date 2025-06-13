<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction3 extends Model
{
    protected $table = 'transactions3';
    public $timestamps = false;

    protected $fillable = ['order_id', 'amount', 'transaction_date', 'payment_method'];

    public function order()
    {
        return $this->belongsTo(Order3::class, 'order_id');
    }
}
