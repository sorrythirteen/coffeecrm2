<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee2 extends Model
{
    protected $table = 'employees2';
    public $timestamps = false;

    protected $fillable = ['name', 'position', 'email', 'phone'];

    public function orders()
    {
        return $this->hasMany(Order2::class, 'employee_id');
    }

    public function workHours()
    {
        return $this->hasMany(WorkHour2::class, 'employee_id');
    }
}
