<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Forms;
use Illuminate\Database\Eloquent\Factories\Factory;

class FormsUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'forms_id' => Forms::all()->pluck('forms_id'),
            'user_id' => User::all()->pluck('user_id'),
        ];
    }
}
