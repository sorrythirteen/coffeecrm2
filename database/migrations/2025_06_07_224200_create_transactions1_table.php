<?php
// database/migrations/2025_01_01_000005_create_transactions1_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactions1Table extends Migration
{
    public function up()
    {
        Schema::create('transactions1', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders1')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->string('payment_method')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('transactions1');
    }
}
