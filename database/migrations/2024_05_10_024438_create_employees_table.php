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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->integer('emp_id')->nullable();
            $table->string('fname')->nullable();
            $table->string('mname');
            $table->string('lname')->nullable();
            $table->string('email')->unique();
            $table->string('des_type_id')->nullable();
            $table->string('avatar');
            $table->string('department_id')->nullable();
            $table->string('work_place')->nullable();
            $table->string('emp_type')->nullable();
            $table->string('emp_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
