<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user =  User::all()->random();
        return [
                'author' => $user->name,
                'author_id' => $user->id,
                'title' => $this->faker->name(),
                'content' => '<p>'. $this->faker->sentence(501) .'</p>',
                'image_name' => null,
        ];
    }
}
