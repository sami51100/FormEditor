<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'lastname' => ['required', 'string', 'max:100'],
            'firstname' => ['required', 'string', 'max:100'],
            'role_id' => ['required', 'integer'],
            // 'current_team_id' => ['nullable'],
            // 'profile_photo_path' => ['nullable'],

        ];
    }

    public function attributes()
    {
        return [
            'lastname' => 'lastname',
            'firstname' => 'firstname',
            'email' => 'email',
            'role_id' => 'role_id',
            // 'current_team_id' => 'current_team_id',
            // 'profile_photo_path' => 'profile_photo_path',
        ];
    }

    public function messages()
    {
        return [
            'lastname.required' => 'Il faut spécifier un nom',
            'lastname.max' => 'Votre nom ne doit pas contenir plus de 100 caractères',
            'firstname.required' => 'Il faut spécifier un prénom',
            'firstname.max' => 'Votre prénom ne doit pas contenir plus de 100 caractères',
            'role_id.required' => 'Veuillez définir un rôle',
        ];
    }
}
