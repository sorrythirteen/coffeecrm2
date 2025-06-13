<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoyaltyProgram3 extends Model
{
    protected $table = 'loyalty_programs3';
    public $timestamps = false;

    protected $fillable = ['name', 'description', 'type', 'discount_rate', 'points_per_currency'];

    public function customerLoyalties()
    {
        return $this->hasMany(CustomerLoyalty3::class, 'program_id');
    }
}
