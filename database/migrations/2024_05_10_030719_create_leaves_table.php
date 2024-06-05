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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->string('rec_id')->nullable();
            $table->string('name')->nullable();
            $table->string('date_filed')->nullable();
            $table->string('leave_type')->nullable();
            $table->string('from_date')->nullable();
            $table->string('to_date')->nullable();
            $table->string('day')->nullable();
            $table->string('leave_reason');
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
