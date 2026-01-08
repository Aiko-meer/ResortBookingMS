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
        Schema::create('Cottage_customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cottage_id');
            $table->string('customer_name');
            $table->string('customer_contact');
            $table->string('customer_address');
            $table->string('customer_email');
            $table->enum('booking_type', ['overnight', 'daytime']);
            $table->string('type');
            $table->date('check_in');
            $table->date('check_out')->nullable();
            $table->time('check_in_time');
            $table->time('check_out_time');
            $table->integer('days_of_stay')->default(0);
            $table->decimal('total_payment', 10, 2);
            $table->text('notes')->nullable();
            $table->json('other_charges')->nullable(); // store dynamic charges as JSON
            $table->integer('status');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_cottage_customers');
    }
};
