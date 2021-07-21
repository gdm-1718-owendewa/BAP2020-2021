<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

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
            'user_id' => $user->id,
            'date' => '01-01-2022',
            'description' => $this->faker->name(),
            'hour' => '00',
            'minute' => '00',
        ];
    }
}
