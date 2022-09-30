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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organizer_id');
            $table->unsignedBigInteger('event_id');
            $table->longText('customer_details');
            $table->double('total_price');
            $table->integer('total_ticket')->default(1);
            $table->string('payment_method')->nullable();
            $table->boolean('paid')->default(false);
            $table->string('ticket_code')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('organizer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
