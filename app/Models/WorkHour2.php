<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkHour2 extends Model
{
    protected $table = 'work_hours2';
    public $timestamps = false;

    protected $fillable = ['employee_id', 'start_time', 'end_time', 'work_date'];



public function employee()
{
    return $this->belongsTo(Employee2::class, 'employee_id');
}

}
