<?php
// database/migrations/2025_01_02_000003_create_menu2_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenu2Table extends Migration
{
    public function up()
    {
        Schema::create('menu2', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2);
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('menu2');
    }
}
