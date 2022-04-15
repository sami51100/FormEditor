<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use App\Models\Forms;

class FormsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Forms::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $usersID = DB::table('users')->pluck('id');
        // $groupeID = DB::table('groupes')->pluck('id');
        return [
            'title' => $this->faker->realText($maxNbChars = 20, $indexSize = 2),
            'description' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'date' => $this->faker->dateTimeBetween($startDate = '-1 years'),
            'color' => $this->faker->hexcolor(),
            'progress' => $this->faker->numberBetween($min = 0, $max = 100),
            'user_id' => $this->faker->randomElement($usersID),
            // 'groupe_id' => $this->faker->randomElement($groupeID),
            'logo' => $this->faker->imageUrl($width = 800, $height = 800, 'cats'),
            // 'logo' => $this->$this->loadImage(),
        ];
    }

    public static function loadImage()
    {
        return "https://picsum.photos/800/800?random=" . mt_rand(1, 30);
    }
}
