<?php
// database/migrations/2025_01_01_000003_create_orders1_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrders1Table extends Migration
{
    public function up()
    {
        Schema::create('orders1', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers1')->onDelete('cascade');
            $table->decimal('total_price', 10, 2)->default(0);
            $table->string('status')->default('Ожидает');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('orders1');
    }
}
