<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoyaltyTransaction3 extends Model
{
    protected $table = 'loyalty_transactions3';
    public $timestamps = false;

    protected $fillable = ['customer_loyalty_id', 'transaction_type', 'points', 'related_order_id', 'transaction_date'];

    public function customerLoyalty()
    {
        return $this->belongsTo(CustomerLoyalty3::class, 'customer_loyalty_id');
    }

    public function relatedOrder()
    {
        return $this->belongsTo(Order3::class, 'related_order_id');
    }
}
