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
        Schema::create('personal_info', function (Blueprint $table) {
            $table->id();
            $table->integer('emp_id')->nullable();
            $table->string('personal_email')->unique();
            $table->string('personal_number')->unique();
            $table->date('birth_date')->nullable();
            $table->string('gender')->nullable();
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('nationality')->nullable();
            $table->string('marital_status')->nullable();
            $table->date('date_hired')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_info');
    }
};
