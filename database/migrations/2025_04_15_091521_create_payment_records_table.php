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
        Schema::create('payment_records', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('payment_id');
            $table->string('customer');
            $table->string('wash_id');
            $table->decimal('kilos', 5, 2);
            $table->decimal('rate_per_kg', 8, 2);
            $table->decimal('detergent_fee', 8, 2);
            $table->decimal('total_amount', 8, 2);
            $table->string('payment_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_records');
    }
};
