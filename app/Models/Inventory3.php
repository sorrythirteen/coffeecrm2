<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory3 extends Model
{
    protected $table = 'inventory3';
    public $timestamps = false;

    protected $fillable = ['item_id', 'quantity', 'last_updated'];

    public function menu()
    {
        return $this->belongsTo(Menu3::class, 'item_id');
    }
}
