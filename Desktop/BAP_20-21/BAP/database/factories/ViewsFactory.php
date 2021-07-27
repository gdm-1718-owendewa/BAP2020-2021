<?php

namespace Database\Factories;

use App\Models\Views;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Article;

class ViewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Views::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $article =  Article::all()->random();

        return [
            //
            'article_id' => $article->id
        ];
    }
}
