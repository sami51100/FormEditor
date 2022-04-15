<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFormsRequest extends FormRequest
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
            'title' => ['required', 'max:100'],
            'description' => ['required'],
            'date' => ['required', 'date', 'before:tomorrow'],
            'color' => ['required', 'string', 'max:10'],
            'progress' => ['required', 'integer'],
            'formulaire' => ['nullable'],
            'logo' => ['nullable']
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'titre',
            'description' => 'description',
            'date' => 'date',
            'color' => 'color',
            'progress' => 'progress',
            'formulaire' => 'formulaire',
            'logo' => 'logo',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Il faut spécifier un titre',
            'title.max' => 'Le titre ne doit pas contenir plus de 100 caractères',
            'description.required' => 'Il faut spécifier une description',
            'date.required' => 'Il faut spécifier une date',
            'date.date' => 'Le format de la date est incorrect',
            'date.before' => 'La date doit être inférieur ou égal à aujourd\'hui'

        ];
    }
}
