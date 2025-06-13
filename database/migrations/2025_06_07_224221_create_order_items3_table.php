<?php
// database/migrations/2025_01_03_000004_create_order_items3_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItems3Table extends Migration
{
    public function up()
    {
        Schema::create('order_items3', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders3')->onDelete('cascade');
            $table->foreignId('menu_id')->constrained('menu3')->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->decimal('price', 8, 2);
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('order_items3');
    }
}
