<?php

namespace Database\Factories;

use App\Models\CourseUpload;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Course;

class CourseUploadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CourseUpload::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $course =  Course::all()->random();
        return [
            //
            'course_id' => $course->id,
            'title' => $this->faker->word(),
            'content' => $this->faker->sentence(50),

        ];
    }
}
