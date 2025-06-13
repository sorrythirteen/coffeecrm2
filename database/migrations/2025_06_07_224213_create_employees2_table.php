<?php
// database/migrations/2025_01_02_000002_create_employees2_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployees2Table extends Migration
{
    public function up()
    {
        Schema::create('employees2', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('employees2');
    }
}
