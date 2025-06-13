<?php
// database/migrations/2025_01_02_000004_create_inventory2_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventory2Table extends Migration
{
    public function up()
    {
        Schema::create('inventory2', function (Blueprint $table) {
            $table->id();
            $table->string('item_name');
            $table->integer('quantity')->default(0);
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('inventory2');
    }
}
