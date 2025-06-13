<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory2 extends Model
{
    protected $table = 'inventory2';
    public $timestamps = false;

    protected $fillable = ['item_id', 'quantity', 'last_updated'];

    public function menu()
    {
        return $this->belongsTo(Menu2::class, 'item_id');
    }
}
