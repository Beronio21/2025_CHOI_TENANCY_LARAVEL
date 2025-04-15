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
        Schema::create('laundry_records', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('wash_id');
            $table->string('customer_name');
            $table->string('item_name');
            $table->integer('qty');
            $table->decimal('kilos', 5, 2);
            $table->string('detergent_type');
            $table->integer('detergent_used_g');
            $table->date('date_washed');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laundry_records');
    }
};
