<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkHour3 extends Model
{
    protected $table = 'work_hours3';
    public $timestamps = false;

    protected $fillable = ['employee_id', 'start_time', 'end_time', 'work_date'];



public function employee()
{
    return $this->belongsTo(Employee3::class, 'employee_id');
}

}
