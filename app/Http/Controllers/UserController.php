<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Purok;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
    public function create()
    {
        $puroks = Purok::all();
        $roles = Role::all();
        return Inertia::render('Auth/Register', [
            'jetstream' => config('jetstream'),
            'auth' => ['user' => Auth::user()],
            'puroks' => $puroks,
            'roles' => $roles
        ]);
    }

    public function store(array $input)
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

        User::create([
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

        return redirect()->route('login');
    }
}