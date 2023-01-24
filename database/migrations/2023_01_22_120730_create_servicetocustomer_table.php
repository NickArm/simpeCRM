<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicetocustomer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id');
            $table->foreignId('service_id');
            $table->float('price');
            $table->date('expiration');
            $table->boolean('reminder');
            $table->boolean('paid_status');
            $table->string('notes');
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
        Schema::dropIfExists('servicetocustomer');
    }
};
