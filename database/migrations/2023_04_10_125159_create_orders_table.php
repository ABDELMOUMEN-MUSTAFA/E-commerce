<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('shipper_id');
            $table->unsignedBigInteger('order_status_id');
            $table->date('shipped_date')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->nullable()->references('id')->on('users')->nullOnDelete();
            $table->foreign('shipper_id')->nullable()->references('id')->on('shippers')->nullOnDelete();
            $table->foreign('order_status_id')->nullable()->references('id')->on('order_statuses')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
