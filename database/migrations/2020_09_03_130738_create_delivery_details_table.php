<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('delivery_id')->constrained();
            $table->decimal('size')->nullable();
            $table->decimal('hight')->nullable();
            $table->decimal('long')->nullable();
            $table->decimal('width')->nullable();
            $table->decimal('initial_offer')->nullable();
            $table->decimal('final_offer')->nullable();
            $table->string('content')->nullable();

            // $table->foreign('delivery_id')->references('id')->on('deliveries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_details');
    }
}
