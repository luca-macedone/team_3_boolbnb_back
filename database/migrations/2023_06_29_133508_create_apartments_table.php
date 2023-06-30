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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('title');
            $table->string('slug');
            $table->unsignedTinyInteger('rooms')->nullable();
            $table->unsignedTinyInteger('beds')->nullable();
            $table->unsignedSmallInteger('square_meters')->nullable();
            $table->unsignedTinyInteger('bathrooms')->nullable();
            $table->string('image')->nullable();
            $table->boolean('visibility')->default(true);
            $table->string('latitude');
            $table->string('longitude');
            $table->string('full_address');
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
        Schema::dropIfExists('apartments');
    }
};
