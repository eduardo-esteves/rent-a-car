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
        Schema::create('car_rentals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id');
            $table->foreignId('car_id');
            $table->dateTime('start_date');
            $table->dateTime('expected_return_date');
            $table->dateTime('actual_return_date');
            $table->float('daily_rate', 8,2);
            $table->integer('init_mileage');
            $table->integer('final_mileage');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_rentals');
    }
};
