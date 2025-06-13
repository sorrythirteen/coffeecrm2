<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('reviews', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('customer_id');
        
        // Указываем правильное имя таблицы customers3
        $table->foreign('customer_id')
              ->references('id')
              ->on('customers3')  // Изменили на customers3
              ->onDelete('cascade');
              
        $table->tinyInteger('rating')->unsigned();
        $table->text('comment');
        $table->string('status')->default('pending');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
