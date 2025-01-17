<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            // 'role_id' => ['nullable', 'int'],
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'extension_name' => ['nullable', 'string', 'max:255'],
            'birthday' => ['required', 'date'],
            'age' => ['required', 'integer'],
            'phone_number' => ['required', 'string', 'max:13'],
            'province' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'barangay' => ['nullable', 'string', 'max:255'],
            'purok_id' => ['required', 'integer'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return User::create([
            // 'role_id' => $input['role_id'],
            'first_name' => $input['first_name'],
            'middle_name' => $input['middle_name'],
            'last_name' => $input['last_name'],
            'extension_name' => $input['extension_name'],
            'birthday' => $input['birthday'],
            'age' => $input['age'],
            'phone_number' => $input['phone_number'],
            'province' => $input['province'],
            'city' => $input['city'],
            'barangay' => $input['barangay'],
            'purok_id' => $input['purok_id'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
