<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction2 extends Model
{
    protected $table = 'transactions2';
    public $timestamps = false;

    protected $fillable = ['order_id', 'amount', 'transaction_date', 'payment_method'];

    public function order()
    {
        return $this->belongsTo(Order2::class, 'order_id');
    }
}
