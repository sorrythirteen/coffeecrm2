<?php
// database/migrations/2025_01_01_000004_create_order_items1_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItems1Table extends Migration
{
    public function up()
    {
        Schema::create('order_items1', function (Blueprint $table) {
    $table->id();
    $table->foreignId('order_id')->constrained('orders1')->onDelete('cascade'); // должен быть BIGINT UNSIGNED
    $table->foreignId('menu_id')->constrained('menu1')->onDelete('cascade'); // тоже bigInt unsigned
    $table->integer('quantity')->default(1);
    $table->decimal('price', 8, 2);
    $table->timestamps();
});
    }
    public function down()
    {
        Schema::dropIfExists('order_items1');
    }
}
