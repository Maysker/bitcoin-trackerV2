<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionHistoriesTable extends Migration

{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('buySell', ['buy', 'sell']);
            $table->decimal('amount', 15, 8);
            $table->decimal('rate', 15, 8);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaction_histories');
    }

}
