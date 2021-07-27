<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user =  User::all()->random();
        $addresses = [
            '1 West Lake Street, Minneapolis, Minnesota, Verenigde Staten',
            '658 Medical Center Drive, Orange City, Florida, Verenigde Staten',
            '2536 Hill Street, Belpre, Ohio, Verenigde Staten',
            'Medicine Lake Road, Minnesota, Verenigde Staten',
            '4857 Mulberry Avenue, Wynne, Arkansas, Verenigde Staten',
        ];

        return [
            //
            'author' => $user->name,
            'author_id' => $user->id,
            'title' => $this->faker->name(),
            'description' => '<p>'. $this->faker->sentence(150) .'</p>',
            'capacity' => $this->faker->unique()->numberBetween(1,100),
            'location' => $addresses[$this->faker->unique()->numberBetween(0,4)],
            'start_date' => '01-01-2022',
            'end_date' => '01-01-2022',
            'start_time' => '08:00',
            'start_hour' => '08',
            'start_minute' => '00',
            'end_time' => '20:00',
            'end_hour' => '20',
            'end_minute' => '00',
        ];
    }
}
