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
        Schema::create('apartment_service', function (Blueprint $table) {
            // Add post_id column
            $table->unsignedBigInteger('apartment_id');
            // Add foreign key
            $table->foreign('apartment_id')->references('id')->on('apartments')->cascadeOnDelete();
    
            // Add tag_id column
            $table->unsignedBigInteger('service_id');
            // Add foreign key
            $table->foreign('service_id')->references('id')->on('services')->cascadeOnDelete();
    
            // Add primary key
            $table->primary(['apartment_id', 'service_id']);
    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartment_service');
    }
};
