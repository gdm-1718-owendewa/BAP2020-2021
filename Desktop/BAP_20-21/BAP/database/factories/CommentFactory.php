<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Thread;
use App\Models\User;
class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user =  User::all()->random();
        $thread =  Thread::all()->random();

        return [
            //
            'author' => $user->name,
            'author_id' => $user->id,
            'thread_id' => $thread->id,
            'content' => $this->faker->sentence(20),
        ];
    }
}
