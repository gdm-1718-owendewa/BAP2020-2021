<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $amount = 5;
        \App\Models\User::factory(15)->create();
        for ($x = 0; $x < $amount; $x++) {
            $article = \App\Models\Article::factory(1)->create();
            $id = $article->first()->id;
            $path = public_path('/images/articles/'.$id.'/main-image');
            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);
                $oldpath = public_path('/images/dummy.jpg');
                $newpath = $path.'/image.jpg';
                File::copy($oldpath, $newpath);
            }
        }
        for ($j = 0; $j < $amount; $j++) {
            $event = \App\Models\Event::factory(1)->create();
            $id = $event->first()->id;
            $path = public_path('/images/events/'.$id.'/main-image');
            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);
                $oldpath = public_path('/images/dummy.jpg');
                $newpath = $path.'/image.jpg';
                File::copy($oldpath, $newpath);
            }
        }
        for ($y = 0; $y < $amount; $y++) {
            \App\Models\Thread::factory(1)->create();
        }
        for ($t = 0; $t < $amount; $t++) {
            $tutorial = \App\Models\Tutorial::factory(1)->create();
            $id = $tutorial->first()->id;
            $path = public_path('/images/tutorials/'.$id.'/thumbnail');
            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);
                $oldpath = public_path('/images/dummy.jpg');
                $newpath = $path.'/image.jpg';
                File::copy($oldpath, $newpath);
            }
        }
        for ($u = 0; $u < $amount; $u++) {
            \App\Models\Course::factory(1)->create();
        }
        \App\Models\Views::factory(100)->create();
        \App\Models\Comment::factory(5)->create();
        \App\Models\CourseUpload::factory(5)->create();

    }
}
