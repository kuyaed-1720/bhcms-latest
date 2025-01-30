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
        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->constrained('users');
            $table->string('mother');
            $table->string('father');
            $table->date('birthdate');
            $table->string('birthplace');
            $table->int('age');
            $table->enum('sex', ['male', 'female']);
            $table->string('address');
            $table->integer('birth_height');
            $table->integer('birth_weight');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('children');
    }
};
