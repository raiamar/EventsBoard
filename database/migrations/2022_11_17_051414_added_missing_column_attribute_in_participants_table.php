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
        Schema::table('participants', function (Blueprint $table) {
            $table->string('email')->nullable();
            $table->integer('age')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('optional_number')->nullable();
            $table->text('permanent_address')->nullable();
            $table->text('temporary_address')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('participants', function (Blueprint $table) {
            //
        });
    }
};
