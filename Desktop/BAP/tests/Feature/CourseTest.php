<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Course;
use App\Models\CourseUpload;
use Illuminate\Support\Facades\File;
class CourseTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_course_can_be_added_through_the_form()
    {
        $user = $this->actingAsUserWithReturn();
        $response = $this->post('/course/create/submit', $this->data());
        $this->assertCount(1, Course::all());
    }
     /** @test */
     public function a_title_is_required()
     {
         $user = $this->actingAsUserWithReturn();
         $response = $this->post('/course/create/submit', array_merge($this->data(), ['title' => '']));
         $response->assertSessionHasErrors('title');
         $this->assertCount(0, Course::all());
     }
     /** @test */
     public function a_title_is_max_200_characters()
     {
         $user = $this->actingAsUserWithReturn();
         $response = $this->post('/course/create/submit', array_merge($this->data(), ['title' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa']));
         $response->assertSessionHasErrors('title');
         $this->assertCount(0, Course::all());
     }
      /** @test */
      public function an_info_is_required()
      {
          $user = $this->actingAsUserWithReturn();
          $response = $this->post('/course/create/submit', array_merge($this->data(), ['info' => '']));
          $response->assertSessionHasErrors('info');
          $this->assertCount(0, Course::all());
      }
      /** @test */
      public function an_info_is_min_100()
      {
          $user = $this->actingAsUserWithReturn();
          $response = $this->post('/course/create/submit', array_merge($this->data(), ['info' => 'aaaaa']));
          $response->assertSessionHasErrors('info');
          $this->assertCount(0, Course::all());
      }
       /** @test */
     public function a_content_is_required()
     {
         $user = $this->actingAsUserWithReturn();
         $response = $this->post('/course/create/submit', array_merge($this->data(), ['content' => '']));
         $response->assertSessionHasErrors('content');
         $this->assertCount(0, Course::all());
     }
       /** @test */
       public function a_content_is_min_100()
       {
           $user = $this->actingAsUserWithReturn();
           $response = $this->post('/course/create/submit', array_merge($this->data(), ['content' => 'aaaaa']));
           $response->assertSessionHasErrors('content');
           $this->assertCount(0, Course::all());
       }
       /** @test */
    public function a_course_can_be_edited_through_the_form()
    {
        
        $user = $this->actingAsUserWithReturn();
        $course = $this->createCourse();
        $response = $this->patch('/course/edit/'.$course->id.'/submit', $this->editdata());
        $response->assertRedirect('/course/course-detail/'.$course->id);
    }
    /** @test */
    public function a_course_can_be_deleted()
    {
        $user = $this->actingAsUserWithReturn();
        $course = $this->createCourseWithUser($user);
        $response = $this->delete('/course/delete/'.$course->id);
        $response->assertStatus(302);
    }

    /** @test */
    public function an_user_can_sign_for_a_course()
    {
        $user = $this->actingAsUserWithReturn();
        $course = $this->createCourse();
        $response = $this->get('/course/course-detail/'.$course->id.'/'.$user->id.'/signup');
        $response->assertStatus(302);
        $response->assertRedirect('/course/course-detail/'.$course->id);
    }
     /** @test */
     public function an_user_can_unsignsign_for_a_course()
     {
         $user = $this->actingAsUserWithReturn();
         $course = $this->createCourse();
         $this->get('/course/course-detail/'.$course->id.'/'.$user->id.'/signin');
         $response = $this->get('/course/course-detail/'.$course->id.'/'.$user->id.'/signout');
         $response->assertStatus(302);
         $response->assertRedirect('/course/course-detail/'.$course->id);
     }
     /** @test */
    public function a_course_upload_can_be_added_through_the_form()
    {
        $user = $this->actingAsUserWithReturn();
        $course = $this->createCourse();
        $response = $this->post('/course/'.$course->id.'/addcontent/submit', $this->uploaddata());

        $this->assertCount(1, CourseUpload::all());
    }
     /** @test */
     public function an_upload_inhoud_is_min_50()
     {
         $user = $this->actingAsUserWithReturn();
         $course = $this->createCourse();
         $response = $this->post('/course/'.$course->id.'/addcontent/submit', array_merge($this->uploaddata(), ['inhoud' => 'aaaaa']));

         $response->assertSessionHasErrors('inhoud');
         $this->assertCount(0, CourseUpload::all());
     }
     /** @test */
     public function an_upload_title_is_max_200()
     {
         $user = $this->actingAsUserWithReturn();
         $course = $this->createCourse();
         $response = $this->post('/course/'.$course->id.'/addcontent/submit', array_merge($this->uploaddata(), ['title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex']));

         $response->assertSessionHasErrors('title');
         $this->assertCount(0, CourseUpload::all());
     }
    /** @test */
    public function a_course_upload_can_be_deleted()
    {
        $user = $this->actingAsUserWithReturn();
        $course = $this->createCourseWithUser($user);
        $courseupload = $this->createCourseUpload($course);

        $response = $this->delete('/course/upload-overview/'.$course->id.'/delete/'.$courseupload->id);
        $response->assertStatus(302);
    }
    /** @test */
    public function a_course_upload_can_be_edited_through_the_form()
    {
        $user = $this->actingAsUserWithReturn();
        $course = $this->createCourseWithUser($user);
        $courseupload = $this->createCourseUpload($course);

        $response = $this->patch('/course/'.$course->id.'/editupload/'.$courseupload->id.'/submit', $this->uploadeditdata());
        $response->assertStatus(302);
    }



    private function createCourse(){
        $course = Course::factory()->create();
        return $course;
    }
    private function createCourseUpload($course){
        $course = CourseUpload::factory()->create(['course_id' => $course->id]);
        return $course;
    }
    private function createCourseWithUser($user){
        $course = Course::factory()->create(['author_id' => $user->id]);
        return $course;
    }
    private function data(){
        return [
            'title' => 'Article title',
            'info' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex',
            'content' =>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex',
           
        ];
    }
    private function editdata(){
        return [
            'title' => 'Article title2',
            'info' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex2',
            'content' =>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex2',
           
        ];
    }
    private function uploaddata(){
        return [
            'title' => 'Article title',
            'inhoud' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex',
           
        ];
    }
    private function uploadeditdata(){
        return [
            'title' => 'Article title',
            'inhoud' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex',
           
        ];
    }
    private function actingAsUserWithReturn(){
        $user = User::factory()->create();
        $this->actingAs($user);
        File::makeDirectory('images/users/'.$user->id.'/profile-image', 0777, true, true);
        return $user;
    }
}
