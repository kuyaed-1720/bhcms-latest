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
        Schema::create('child_clinic_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained('children');
            $table->enum('epi_status', ['complete', 'incomplete'])->nullable();
            $table->enum('type_of_feeding', ['bf', 'mixed;', 'bot'])->nullable();
            $table->boolean('bcg')->default(false);
            $table->boolean('dpt')->default(false);
            $table->boolean('opv')->default(false);
            $table->boolean('hepa_b')->default(false);
            $table->boolean('am')->default(false);
            $table->string('wt');
            $table->string('vs');
            $table->text('chief_complaint');
            $table->text('other_cc')->nullable();
            $table->string('management');
            $table->date('record_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_clinic_records');
    }
};
