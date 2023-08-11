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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->integer('is_active')->default(1);
            $table->string('id_number')->unique();
            $table->string('f_name');
            $table->string('l_name');
            $table->char('sex', 1);
            $table->date('date_of_birth');
            $table->integer('height')->nullable();
            $table->integer('weight')->nullable();
            $table->string('phone_no');
            $table->text('address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
