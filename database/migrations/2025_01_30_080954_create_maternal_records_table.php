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
        Schema::create('maternal_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('husband_name');
            $table->string('tt_status');
            $table->string('gp');
            $table->date('lmp');
            $table->string('edc');
            $table->string('termination_of_pregnancy')->nullable();
            $table->string('outcome')->nullable();
            $table->date('date_1');
            $table->date('date_2')->nullable();
            $table->date('date_3')->nullable();
            $table->text('ob_findings');
            $table->string('risk_code')->nullable();
            $table->string('tt_given')->nullable();
            $table->string('management');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maternal_records');
    }
};
