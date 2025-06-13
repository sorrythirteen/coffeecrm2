<?php
// database/migrations/2025_01_02_000008_create_work_hours2_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkHours2Table extends Migration
{
    public function up()
    {
        Schema::create('work_hours2', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees2')->onDelete('cascade');
            $table->date('work_date');
            $table->time('start_time');
            $table->time('end_time')->nullable();
            $table->timestamps();

            $table->unique(['employee_id', 'work_date']);
        });
    }
    public function down()
    {
        Schema::dropIfExists('work_hours2');
    }
}
