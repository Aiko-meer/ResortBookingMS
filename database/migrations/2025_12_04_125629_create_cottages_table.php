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
        Schema::create('cottages', function (Blueprint $table) {
             $table->id();
        $table->string('room_number')->unique(); // Cottage #
        $table->string('room_type');            // Type (Standard, Deluxe, etc.)
        $table->integer('capacity_adult');      // Capacity
        $table->decimal('price_day', 10, 2);  
        $table->decimal('price_ov', 10, 2); 
        $table->integer('status');
        $table->integer('income');  
        $table->json('amenities')->nullable();
        $table->text('description');
        $table->timestamps();                   // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cottages');
    }
};
