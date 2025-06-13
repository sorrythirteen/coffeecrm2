<?php
// database/migrations/2025_01_02_000001_create_customers2_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomers2Table extends Migration
{
    public function up()
    {
        Schema::create('customers2', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('customers2');
    }
}
