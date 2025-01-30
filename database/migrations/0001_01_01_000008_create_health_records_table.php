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
        Schema::create('health_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->boolean('ph_member')->default(false);
            $table->string('philhealth_no')->nullable();
            $table->integer('height')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('bmi')->nullable();
            $table->integer('waist_circumference')->nullable();
            $table->enum('with_hpn', ['none', 'old', 'new'])->default('none');
            $table->enum('with_dm', ['none', 'old', 'new'])->default('none');
            $table->boolean('pregnant')->default(false);
            $table->date('lmp')->nullable();
            $table->string('pregnancy_test')->nullable();
            $table->string('gp')->nullable();
            $table->enum('smoking', ['never', 'current', 'passive', 'recently_stopped', 'long_stopped'])->default('never');
            $table->boolean('alcohol_intake')->default(false);
            $table->boolean('had_five_drinks')->default(false);
            $table->text('chief_complaint')->nunllable();
            $table->text('diagnosis')->nullable();
            $table->string('management')->nullable();
            $table->date('record_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_records');
    }
};
