<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Tutorial;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;

class TutorialTest extends TestCase
{
    use RefreshDatabase;
    /* Written Tutorial testing */
    /** @test */
    public function a_tutorial_can_be_added_through_the_form()
    {
        $user = $this->actingAsUserWithReturn();
        $response = $this->post('/tutorial/create/submit', $this->writtendata());
        $this->assertCount(1, Tutorial::all());
    }
    /** @test */
    public function a_title_is_required()
    {
        $user = $this->actingAsUserWithReturn();
        $response = $this->post('/tutorial/create/submit', array_merge($this->writtendata(),['title' => '']));
        $this->assertCount(0, Tutorial::all());
    }
     /** @test */
     public function a_title_is_max_200_characters()
     {
         $user = $this->actingAsUserWithReturn();
         $response = $this->post('/tutorial/create/submit', array_merge($this->writtendata(),['title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laborisaliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris']));
         $this->assertCount(0, Tutorial::all());
     }
     /** @test */
     public function a_description_is_required()
     {
         $user = $this->actingAsUserWithReturn();
         $response = $this->post('/tutorial/create/submit', array_merge($this->writtendata(),['description' => '']));
         $this->assertCount(0, Tutorial::all());
     }
     /** @test */
     public function a_description_is_min_100_characters()
     {
         $user = $this->actingAsUserWithReturn();
         $response = $this->post('/tutorial/create/submit', array_merge($this->writtendata(),['description' => 'sdfsdfsdfsdfsd']));
         $this->assertCount(0, Tutorial::all());
     }
      /** @test */
      public function a_content_type_is_required()
      {
          $user = $this->actingAsUserWithReturn();
          $response = $this->post('/tutorial/create/submit', array_merge($this->writtendata(),['content-type' => '']));
          $this->assertCount(0, Tutorial::all());
      }
      /** @test */
      public function a_thumbnail_is_required()
      {
          $user = $this->actingAsUserWithReturn();
          $response = $this->post('/tutorial/create/submit', array_merge($this->writtendata(),['video-thumbnail' => '']));
          $this->assertCount(0, Tutorial::all());
      }
       /** @test */
       public function a_wysiwyg_is_min_100_character()
       {
           $user = $this->actingAsUserWithReturn();
           $response = $this->post('/tutorial/create/submit', array_merge($this->writtendata(),['wysiwyg-editor' => '']));
           $this->assertCount(0, Tutorial::all());
       }
       /** @test */
        public function a_tutorial_can_be_edited_through_the_form()
        {
            $user = $this->actingAsUserWithReturn();
            $tutorial = $this->createTutorialWithUser($user);
            $response = $this->post('/tutorial/edit/'.$tutorial->id.'/submit', $this->editwrittendata());
            $this->assertCount(1, Tutorial::all());
        }
    private function actingAsUserWithReturn(){
        $user = User::factory()->create();
        $this->actingAs($user);
        return $user;
    }
    private function createTutorial(){
        $tutorial = Tutorial::factory()->create();
        $oldpath = public_path('/images/dummy.jpg');
        $newpath = public_path('/images/tutorials/'.$tutorial->id.'/thumbnail/image.jpg');
        File::copy($oldpath, $newpath);
        return $tutorial;
    }
    private function createTutorialWithUser($user){
        $tutorial = Tutorial::factory()->create(['author_id' => $user->id]);
        $oldpath = public_path('/images/dummy.jpg');
        $newpath = public_path('/images/tutorials/'.$tutorial->id.'/thumbnail/image.jpg');
        File::copy($oldpath, $newpath);
        return $tutorial;
    }
    private function writtendata(){
        return [
            'title' => 'Tut title',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris',
            'content-type' => 'written-type',
            'video-thumbnail' => UploadedFile::fake()->image('avatar.jpg'),
            'wysiwyg-editor' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris',
        ];
    }
    private function editwrittendata(){
        return [
            'title' => 'Tut title2',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris2',
            'content-type' => 'written-type',
            'video-thumbnail' => UploadedFile::fake()->image('avatar.jpg'),
            'wysiwyg-editor' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris2',
        ];
    }
}
