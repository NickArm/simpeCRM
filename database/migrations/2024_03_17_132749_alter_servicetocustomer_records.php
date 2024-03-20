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
        Schema::table('servicetocustomer_records', function (Blueprint $table) {
            $table->dropColumn(['amount_paid', 'payment_method']);
            $table->boolean('is_paid')->default(false);
            $table->foreignId('payment_id')->nullable()->constrained('payments')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('servicetocustomer_records', function (Blueprint $table) {
            $table->double('amount_paid')->nullable();
            $table->string('payment_method')->nullable();
            $table->dropColumn('is_paid');
            $table->dropForeign(['payment_id']);
            $table->dropColumn('payment_id');
        });
    }
};
