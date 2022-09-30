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
        Schema::table('events', function (Blueprint $table) {
            $table->boolean('status')->default(true);
            $table->double('form_fee')->nullable();
            $table->string('qr_code')->nullable();
            $table->string('address')->nullable();
            $table->string('payment_types')->nullable();
            $table->string('category')->nullable();
            $table->boolean('pre_booking')->default(false);
            $table->double('ticket_price')->nullable();
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            //
        });
    }
};
