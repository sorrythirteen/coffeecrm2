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
    Schema::table('orders1', function (Blueprint $table) {
        $table->decimal('total_amount', 10, 2)->nullable();
    });
}

public function down()
{
    Schema::table('orders1', function (Blueprint $table) {
        $table->dropColumn('total_amount');
    });
}

};
