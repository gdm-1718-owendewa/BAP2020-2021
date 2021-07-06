<?php

namespace Database\Factories;

use App\Models\Thread;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class ThreadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Thread::class;

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
            'title' => $this->faker->name(),
            'question' => '<p>'. $this->faker->sentence(100) .'</p>',
        ];
    }
}
