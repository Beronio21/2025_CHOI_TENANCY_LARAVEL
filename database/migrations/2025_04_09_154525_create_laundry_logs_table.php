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
        Schema::create('laundry_logs', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('time_started');
            $table->string('person_responsible');
            $table->string('items_washed');
            $table->integer('quantity_items');
            $table->integer('how_many_kilo');
            $table->string('machine_used');
            $table->string('detergent_used');
            $table->integer('how_many_detergent_used');
            $table->string('drying_method');
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laundry_logs');
    }
};
