<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Purok;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('puroks', function (Blueprint $table) {
            $table->id();
            $table->enum('purok_name', ['1', '2', '3', '4', '5A', '5B', '6', '7', '8', '9', '10', '11', '12']);
        });
        
        Purok::insert([
            ['id' => 1, 'purok_name' => '1'],
            ['id' => 2, 'purok_name' => '2'],
            ['id' => 3, 'purok_name' => '3'],
            ['id' => 4, 'purok_name' => '4'],
            ['id' => 5, 'purok_name' => '5A'],
            ['id' => 6, 'purok_name' => '5B'],
            ['id' => 7, 'purok_name' => '6'],
            ['id' => 8, 'purok_name' => '7'],
            ['id' => 9, 'purok_name' => '8'],
            ['id' => 10, 'purok_name' => '9'],
            ['id' => 11, 'purok_name' => '10'],
            ['id' => 12, 'purok_name' => '11'],
            ['id' => 13, 'purok_name' => '12'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('puroks');
    }
};
