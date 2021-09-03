<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->unsignedBigInteger('delivery_man')->nullable();
            $table->string('origin');
            $table->string('destination');
            $table->string('pick_up_point')->nullable();
            $table->string('delivery_point')->nullable();
            $table->string('type');
            $table->foreignId('status_id')->unsigned()->default(1)->constrained();
            $table->timestamps();

            // $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('delivery_man')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deliveries');
    }
}
