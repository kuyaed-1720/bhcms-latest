<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Role;
use App\Models\Purok;
use App\Models\Patient;
use App\Models\HealthWorker;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $provinces = ['Albay', 'Catanduanes', 'Camarines Norte', 'Camarines Sur', 'Masbate', 'Sorsogon'];
        $cities = ['Iriga', 'Naga', 'Ligao', 'Legazpi', 'Tabaco', 'Sorsogon', 'Masbate'];
        $barangays = ['Barangay Poblacion', 'Barangay Buhangin', 'Barangay Bayabas', 'Barangay Pulang Lupa'];
        $birthday = fake()->dateTimeBetween('2000-01-01', '2023-11-11')->format('Y-m-d');
        return [
            'role_id' => Role::inRandomOrder()->first()->id,
            'first_name' => fake()->firstName(),
            'middle_name' => fake()->firstName(),
            'last_name' => fake()->lastName(), 
            'last_activity' => fake()->dateTimeBetween('2024-09-01 00:00:00', Carbon::now())->format('Y-m-d H:i:s'),
            'birthday' => $birthday,
            'age' =>  Carbon::parse($birthday)->diffInYears(now()),
            'phone_number' => fake()->phoneNumber(), 
            'province' => fake()->randomElement($provinces),
            'city' => fake()->randomElement($cities),
            'barangay' => fake()->randomElement($barangays),
            'purok' => Purok::inRandomOrder()->first()->name,
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('11111111'),
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'remember_token' => Str::random(10),
            'profile_photo_path' => null,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Indicate that the user is a patient.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function asPatient()
    {
        return $this->state([
            'role_id' => 3, // patient
        ]);
    }

    /**
     * Indicate that the user is a health worker.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function asHealthWorker()
    {
        return $this->state([
            'role_id' => 2, // health worker
        ]);
    }

    /**
     * Indicate that the user is an admin.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function asAdmin()
    {
        return $this->state([
            'role_id' => 1, // admin
        ]);
    }
}
