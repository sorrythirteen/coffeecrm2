<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerLoyalty3 extends Model
{
    protected $table = 'customer_loyalty3';
    public $timestamps = false;

    protected $fillable = ['customer_id', 'program_id', 'current_points', 'enrolled_date'];

    public function customer()
    {
        return $this->belongsTo(Customer3::class, 'customer_id');
    }

    public function loyaltyProgram()
    {
        return $this->belongsTo(LoyaltyProgram3::class, 'program_id');
    }

    public function loyaltyTransactions()
    {
        return $this->hasMany(LoyaltyTransaction3::class, 'customer_loyalty_id');
    }
}
