<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('name');
            $table->integer('property_type');
            $table->string('description');
            $table->integer('tenancy_status');
            $table->string('street');
            $table->string('city');
            $table->string('postal_code');
            $table->string('state');
            $table->string('country');
            $table->string('latitude');
            $table->string('longitude');
            $table->integer('area');
            $table->integer('funishing_status');
            $table->string('funishing_details');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
