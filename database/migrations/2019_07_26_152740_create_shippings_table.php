<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('registered_customer_id')->nullable();
            $table->foreign('registered_customer_id')->references('id')->on('customers')
                ->onDelete('set null');

            $table->string('first_name');
            $table->string('last_name');
            $table->string('street_address');
            $table->string('postal_code');
            $table->string('city');
            $table->string('country');
            $table->string('phone');
            $table->boolean('default_address')->default(false);

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
        Schema::dropIfExists('shippings');
    }
}
