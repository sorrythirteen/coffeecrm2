<?php
// database/migrations/2025_01_02_000007_create_transactions2_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactions2Table extends Migration
{
    public function up()
    {
        Schema::create('transactions2', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders2')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->string('payment_method')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('transactions2');
    }
}
