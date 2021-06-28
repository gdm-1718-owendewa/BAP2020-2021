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
        $amount = 1;
        // \App\Models\User::factory(10)->create();
        for ($x = 0; $x < $amount; $x++) {
            $article = \App\Models\Article::factory(1)->create();
            $id = $article->first()->id;
            $path = public_path('/images/articles/'.$id.'/main-image');
            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);
                $oldpath = public_path('/images/articledummy.jpg');
                $newpath = $path.'/image.jpg';
                File::copy($oldpath, $newpath);
            }
        }
    }
}
