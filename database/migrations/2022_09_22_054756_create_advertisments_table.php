<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\AddType;
use App\Enums\AddPageType;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisments', function (Blueprint $table) {
            $table->id();
            $table->string('thumbnail');
            $table->enum('type', AddType::getValues())->default(AddType::Banner);
            $table->enum('page', AddPageType::getValues())->default(AddPageType::Other);
            $table->integer('order');
            $table->string('redirect_link');
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('advertisments');
    }
};
