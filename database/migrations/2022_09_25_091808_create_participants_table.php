<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\GenderType;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->integer('event_id');
            $table->integer('orginizer_id');
            $table->string('category')->nullable();
            $table->string('name');
            $table->longText('participant_details')->nullable();
            $table->longText('participant_gaurdian')->nullable();
            $table->integer('gender');
            $table->string('pp_image')->nullable();
            $table->string('full_image')->nullable();
            $table->longText('details');
            $table->string('payment_method')->default('qr_code');
            $table->string('qrcode_payment')->nullable();
            $table->string('payment_reg')->nullable();
            $table->boolean('payment_conformation')->default(false);
            $table->string('reference')->nullable();
            $table->boolean('conformation')->default(false);
            $table->longText('social_media')->nullable();
            $table->longText('extra')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participants');
    }
};
