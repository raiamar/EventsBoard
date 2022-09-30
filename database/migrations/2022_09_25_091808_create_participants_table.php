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
            $table->string('name');
            $table->string('guardian_name')->nullable();
            $table->integer('age');
            $table->enum('gender', GenderType::getValues());
            $table->bigInteger('guardian_number')->nullable();
            $table->string('email')->nullable();
            $table->double('height')->nullable();
            $table->string('pp_image');
            $table->double('weight')->nullable();
            $table->string('full_image')->nullable();
            $table->bigInteger('contact');
            $table->string('p_address');
            $table->string('t_address')->nullable();
            $table->longText('details');
            $table->string('payment_method')->drfault('qr_code');
            $table->string('qrcode_payment')->nullable();
            $table->string('payment_reg')->nullable();
            $table->boolean('payment_conformation')->default(false);
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('reference')->nullable();
            $table->boolean('conformation')->default(true);
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
