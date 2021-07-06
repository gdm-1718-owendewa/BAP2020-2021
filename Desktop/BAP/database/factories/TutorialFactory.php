<?php

namespace Database\Factories;

use App\Models\Tutorial;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class TutorialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tutorial::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user =  User::all()->random();

        return [
            //
            'author' => $user->name,
            'author_id' => $user->id,
            'title' => $this->faker->word(),
            'description' => '<p>'. $this->faker->sentence(100) .'</p>',
            'content' => '<p>'. $this->faker->sentence(100) .'</p>',
            'type' => 'written-type',
        ];
    }
}
