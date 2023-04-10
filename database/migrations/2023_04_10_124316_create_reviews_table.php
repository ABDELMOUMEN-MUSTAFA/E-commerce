<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('order_product_id');
            $table->mediumText('comment');
            $table->tinyInteger('number_stars');
            $table->timestamps();
            $table->foreign('user_id')->nullable()->references('id')->on('users')->onDelete('cascade')->nullOnDelete();
            $table->foreign('order_product_id')->nullable()->references('id')->on('order_product')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
