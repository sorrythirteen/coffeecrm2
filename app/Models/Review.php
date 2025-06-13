<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'rating',
        'comment',
        'status'
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer3::class);
    }
}