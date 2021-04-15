<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('type');
            $table->string('item');
            $table->string('address');
            $table->string('amount');
            $table->string('name');
            $table->string('cus_phone');
            $table->string('email');
            $table->string('ben_name');
            $table->string('ben_phone');
            $table->string('pick_address');
            $table->string('delivery_type');
            $table->string('assigned')->default(0);
            $table->string('rider')->default(0);
            $table->string('status')->default('credit');
            $table->string('order_id');
            $table->timestamps();
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
