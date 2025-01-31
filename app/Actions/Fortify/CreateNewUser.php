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
            'role_id' => ['required', 'integer'],
            'purok_id' => ['required', 'integer'],
            'fname' => ['required', 'string', 'max:255'],
            'mname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'suffix' => ['nullable', 'string', 'max:255'],
            'birthdate' => ['required', 'date'],
            'age' => ['required', 'integer'],
            'sex' => ['required', 'in:male,female'],
            'contact_no' => ['required', 'string', 'max:13'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return User::create([
            'role_id' => $input['role_id'],
            'purok_id' => $input['purok_id'],
            'fname' => $input['fname'],
            'mname' => $input['mname'],
            'lname' => $input['lname'],
            'suffix' => $input['suffix'],
            'birthdate' => $input['birthdate'],
            'age' => $input['age'],
            'sex' =>$input['sex'],
            'contact_no' => $input['contact_no'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
