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
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'lastname' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
            'profile_photo_path' => ['nullable', 'string', 'max:255'],
            'role_id' => ['required', 'integer'],
        ])->validate();

        /* Pas une super idée mais c'est tjr ça de fait (url de l'image stocké)*/
        if (empty($input['profile_photo_path'])) {
            $input['profile_photo_path'] = asset('img/defaut1.png');
        }

        return User::create([
            'lastname' => $input['lastname'],
            'firstname' => $input['firstname'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'profile_photo_path' => $input['profile_photo_path'],
            'role_id' => $input['role_id'],
        ]);
    }
}
