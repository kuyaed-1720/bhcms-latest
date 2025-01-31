<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->enum('role_name', ['admin', 'bhw', 'resident']);
            $table->timestamps();
        });
        
        Role::insert([
            ['id' => 1, 'role_name' => 'admin'],
            ['id' => 2, 'role_name' => 'bhw'],
            ['id' => 3, 'role_name' => 'resident'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
