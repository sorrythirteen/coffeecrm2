<?php
// database/migrations/2025_01_03_000001_create_customers3_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomers3Table extends Migration
{
    public function up()
    {
        Schema::create('customers3', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->integer('loyalty_points')->default(0); // баллы лояльности
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('customers3');
    }
}
