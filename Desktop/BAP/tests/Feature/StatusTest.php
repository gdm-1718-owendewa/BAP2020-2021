<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Article;
use App\Models\Tutorial;
use App\Models\Event;
use App\Models\Thread;
use App\Models\Course;
use App\Models\CourseUpload;
use App\Models\Comment;

use Illuminate\Support\Facades\File;

class StatusTest extends TestCase
{
    use RefreshDatabase;
    /********************** General **********************/
    /** @test*/
    public function check_if_home_gives_200_status()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    /** @test*/
    public function check_if_about_us_gives_200_status()
    {
        $response = $this->get('/about-us');
        $response->assertStatus(200);
    }
    /** @test*/
    public function check_if_policy_gives_200_status()
    {
        $response = $this->get('/policy');
        $response->assertStatus(200);
    }
    /** @test*/
    public function check_if_terms_gives_200_status()
    {
        $response = $this->get('/terms');
        $response->assertStatus(200);
    }
    /** @test*/
    public function check_if_contact_gives_200_status()
    {
        $response = $this->get('/contact');
        $response->assertStatus(200);
    }
    /** @test*/
    public function check_if_documents_gives_200_status()
    {
        $this->actingAsUser();
        $response = $this->get('/documents');
        $response->assertStatus(200);
    }
     /** @test*/
     public function check_if_guide_gives_200_status()
     {
         $this->actingAsUser();
         $response = $this->get('/guide');
         $response->assertStatus(200);
     }
    /********************** DASHBOARD **********************/
    /** @test*/
    public function check_if_dashboard_gives_200_status()
    {
        $user = $this->actingAsUserWithReturn();
        $response = $this->get('/dashbord/'.$user->id);
        $response->assertStatus(200);
    }
     /** @test*/
     public function check_if_dashboard_guide_message_redirects_to_dashbord()
     {
         $user = $this->actingAsUserWithReturn();
         $response = $this->get('/dashbord/'.$user->id.'/no-guide-message');
         $response->assertRedirect('/dashbord/'.$user->id);
     }
    /********************** NOTES **********************/
     /** @test*/
     public function check_if_notes_gives_200_status()
     {
         $user = $this->actingAsUserWithReturn();
         $response = $this->get('/notes/'.$user->id);
         $response->assertStatus(200);
     }
    /********************** ARTICLE **********************/
    /** @test*/
    public function check_if_article_overview_gives_200_status()
    {
        $this->actingAsUser();
        $response = $this->get('/article/article-overview');
        $response->assertStatus(200);
    }
    /** @test*/
    public function check_if_article_detail_gives_200_status()
    {
        
        $this->actingAsUser();
        $article = $this->createArticle();
        $response = $this->get('/article/article-detail/'.$article->id);
        $response->assertStatus(200);
    }

    /** @test*/
    public function check_if_article_create_gives_200_status()
    {
        $this->actingAsUser();
        $response = $this->get('/article/create');
        $response->assertStatus(200);
    }
    /** @test*/
    public function check_if_article_edit_gives_200_status()
    {
        $this->actingAsUser();
        $article = $this->createArticle();
        $response = $this->get('/article/edit/'.$article->id);
        $response->assertStatus(200);
    }
    /********************** TUTORIALS **********************/
    /** @test*/
    public function check_if_tutorial_overview_gives_200_status()
    {
        $this->actingAsUser();
        $response = $this->get('/tutorial/tutorial-overview');
        $response->assertStatus(200);
    }
    /** @test*/
    public function check_if_tutorial_detail_gives_200_status()
    {
        $this->actingAsUser();
        $tutorial = $this->createTutorial();
        $response = $this->get('/tutorial/detail/'.$tutorial->id);
        $response->assertStatus(200);
    }
     /** @test*/
     public function check_if_tutorial_create_gives_200_status()
     {
         $this->actingAsUser();
         $response = $this->get('/tutorial/create');
         $response->assertStatus(200);
     }
     /** @test*/
    public function check_if_tutorial_edit_gives_200_status()
    {
        $this->actingAsUser();
        $tutorial = $this->createTutorial();
        $response = $this->get('/tutorial/edit/'.$tutorial->id);
        $response->assertStatus(200);
    }
    /********************** EVENT **********************/
     /** @test*/
     public function check_if_event_overview_gives_200_status()
     {
         $this->actingAsUser();
         $response = $this->get('/event/event-overview');
         $response->assertStatus(200);
     }
    /** @test*/
    public function check_if_event_detail_gives_200_status()
    {
        $this->actingAsUser();
        $event = $this->createEvent();
        $response = $this->get('/event/event-detail/'.$event->id);
        $response->assertStatus(200);
    }
    /** @test*/
     public function check_if_event_create_gives_200_status()
     {
         $this->actingAsUser();
         $response = $this->get('/event/create');
         $response->assertStatus(200);
     }
    /** @test*/
    public function check_if_event_edit_gives_200_status()
    {
        $this->actingAsUser();
        $event = $this->createEvent();
        $response = $this->get('/event/edit/'.$event->id);
        $response->assertStatus(200);
    }
    /** @test*/
    public function check_if_event_pdf_gives_200_status()
    {
        $this->actingAsUser();
        $event = $this->createEvent();
        $response = $this->get('/event/event-pdf/'.$event->id);
        $response->assertStatus(200);
    }
    /** @test*/
    public function check_if_event_sign_works_and_redirects_to_detail_page()
    {
        $user = $this->actingAsUserWithReturn();
        $event = $this->createEvent();

        $response = $this->get('/event/sign/'.$user->id.'/'.$event->id);
        $response->assertRedirect('/event/event-detail/'.$event->id);
    }
    /** @test*/
    public function check_if_event_unsign_works_and_redirects_to_detail_page()
    {
        $user = $this->actingAsUserWithReturn();
        $event = $this->createEvent();
        $response = $this->get('/event/unsign/'.$user->id.'/'.$event->id);
        $response->assertRedirect('/event/event-detail/'.$event->id);
    }

    /********************** THREAD **********************/
    /** @test*/
    public function check_if_thread_overview_gives_200_status()
    {
        $this->actingAsUser();
        $response = $this->get('/thread/thread-overview');
        $response->assertStatus(200);
    }
    /** @test*/
    public function check_if_thread_detail_gives_200_status()
    {
        $this->actingAsUser();
        $thread = $this->createThread();
        $response = $this->get('/thread/thread-detail/'.$thread->id);
        $response->assertStatus(200);
    }
     /** @test*/
     public function check_if_thread_create_gives_200_status()
     {
         $this->actingAsUser();
         $response = $this->get('/thread/create');
         $response->assertStatus(200);
     }
     /** @test*/
    public function check_if_thread_edit_gives_200_status()
    {
        $this->actingAsUser();
        $thread = $this->createThread();
        $response = $this->get('/thread/edit/'.$thread->id);
        $response->assertStatus(200);
    }
    /********************** COURSE **********************/
    /** @test*/
    public function check_if_course_overview_gives_200_status()
    {
        $this->actingAsUser();
        $response = $this->get('/course/course-overview');
        $response->assertStatus(200);
    }
    /** @test*/
    public function check_if_course_detail_gives_200_status()
    {
        $this->actingAsUser();
        $course = $this->createCourse();
        $response = $this->get('/course/course-detail/'.$course->id);
        $response->assertStatus(200);
    }
     /** @test*/
     public function check_if_course_sign_works_and_redirects_to_detail_page()
     {
         $user = $this->actingAsUserWithReturn();
         $course = $this->createCourse();
 
         $response = $this->get('/course/course-detail/'.$course->id.'/'.$user->id.'/signup');
         $response->assertRedirect('/course/course-detail/'.$course->id);
     }
      /** @test*/
      public function check_if_course_unsign_works_and_redirects_to_detail_page()
      {
          $user = $this->actingAsUserWithReturn();
          $course = $this->createCourse();
  
          $response = $this->get('/course/course-detail/'.$course->id.'/'.$user->id.'/signout');
          $response->assertRedirect('/course/course-detail/'.$course->id);
      }
    /** @test*/
    public function check_if_course_create_gives_200_status()
    {
        $this->actingAsUser();
        $response = $this->get('/course/create');
        $response->assertStatus(200);
    }
    /** @test*/
    public function check_if_course_edit_gives_200_status()
    {
        $this->actingAsUser();
        $course = $this->createCourse();
        $response = $this->get('/course/edit/'.$course->id);
        $response->assertStatus(200);
    }
     /** @test*/
     public function check_if_course_upload_gives_200_status()
     {
         $this->actingAsUser();
         $course = $this->createCourse();
         $response = $this->get('/course/upload-overview/'.$course->id);
         $response->assertStatus(200);
     }
      /** @test*/
      public function check_if_course_upload_detail_gives_200_status()
      {
          $this->actingAsUser();
          $course = $this->createCourse();
          $upload = $this->createCourseUpload($course);
          $response = $this->get('/course/upload-overview/'.$course->id.'/upload/'.$upload->id);
          $response->assertStatus(200);
      }
      /** @test*/
      public function check_if_course_content_upload_gives_200_status()
      {
          $this->actingAsUser();
          $course = $this->createCourse();
          $response = $this->get('/course/'.$course->id.'/addcontent');
          $response->assertStatus(200);
      }
      /** @test*/
      public function check_if_course_content_edit_gives_200_status()
      {
          $this->actingAsUser();
          $course = $this->createCourse();
          $upload = $this->createCourseUpload($course);
          $response = $this->get('/course/'.$course->id.'/editupload/'.$upload->id);
          $response->assertStatus(200);
      }
      /** @test*/
      public function check_if_course_files_gives_200_status()
      {
          $this->actingAsUser();
          $course = $this->createCourse();
          $response = $this->get('/course/files/'.$course->id);
          $response->assertStatus(200);
      }
    /********************** PROFILE **********************/
    /** @test*/
    public function check_if_profile_gives_200_status()
    {
        $user = $this->actingAsUserWithReturn();
        $response = $this->get('/profile/'.$user->id);
        $response->assertStatus(200);
    }
    /** @test*/
    public function check_if_profile_edi_gives_200_status()
    {
        $user = $this->actingAsUserWithReturn();
        $response = $this->get('/profile/edit/'.$user->id);
        $response->assertStatus(200);
    }
    /********************** STORAGE **********************/
    /** @test*/
    public function check_if_storage_gives_200_status()
    {
        $user = $this->actingAsUserWithReturn();
        $response = $this->get('/storage/'.$user->id);
        $response->assertStatus(200);
    }
    /********************** COMMENT **********************/
    /** @test*/
    public function check_if_comment_edit_200_status()
    {
        $this->withoutExceptionHandling();
        $user = $this->actingAsUserWithReturn();
        $thread = $this->createThread();
        $comment = $this->createComment($thread,$user);
        $response = $this->get('/edit-comment/'.$comment->id);
        $response->assertStatus(200);
    }
    /********************** CALENDER **********************/
    /** @test*/
    public function check_if_calender_gives_200_status()
    {
        $user = $this->actingAsUserWithReturn();
        $response = $this->get('/calender/'.$user->id);
        $response->assertStatus(200);
    }
   /********************** PASSRESET **********************/
    /** @test*/
    public function check_if_pass_reset_gives_200_status()
    {
        $response = $this->get('/password/reset-password');
        $response->assertStatus(200);
    }
    /********************** LOGOUT **********************/
    /** @test*/
    public function check_if_logout_returns_to_home()
    {
        $user = $this->actingAsUserWithReturn();
        $response = $this->get('/logout/'.$user->id);
        $response->assertRedirect('/');
    }


    private function actingAsUser(){
        $user = User::factory()->create();
        $this->actingAs($user);
        File::makeDirectory('images/users/'.$user->id.'/profile-image', 0777, true, true);
    }
    private function actingAsUserWithReturn(){
        $user = User::factory()->create();
        $this->actingAs($user);
        File::makeDirectory('images/users/'.$user->id.'/profile-image', 0777, true, true);
        return $user;
    }
    private function createArticle(){
        $article = Article::factory()->create();
        File::makeDirectory('images/articles/'.$article->id.'/main-image', 0777, true, true);   
        $oldpath = public_path('/images/dummy.jpg');
        $newpath = public_path('/images/articles/'.$article->id.'/main-image/image.jpg');
        File::copy($oldpath, $newpath);
        return $article;
    }
    private function createTutorial(){
        $tutorial = Tutorial::factory()->create();
        File::makeDirectory('images/tutorials/'.$tutorial->id.'/thumbnail', 0777, true, true);   
        $oldpath = public_path('/images/dummy.jpg');
        $newpath = public_path('/images/tutorials/'.$tutorial->id.'/thumbnail/image.jpg');
        File::copy($oldpath, $newpath);
        return $tutorial;
    }
    private function createEvent(){
        $event = Event::factory()->create();
        File::makeDirectory('images/events/'.$event->id.'/main-image', 0777, true, true);   
        $oldpath = public_path('/images/dummy.jpg');
        $newpath = public_path('/images/events/'.$event->id.'/main-image/image.jpg');
        File::copy($oldpath, $newpath);
        return $event;
    }
    private function createThread(){
        $thread = Thread::factory()->create();
        return $thread;
    }
    private function createCourse(){
        $course = Course::factory()->create();
        return $course;
    }
    private function createCourseUpload($course){
        $courseupload = CourseUpload::factory()->create(['course_id' => $course->id]);
        return $courseupload;
    }
    private function createComment($thread, $user){
        $comment = Comment::factory()->create(['author_id' => $user->id, 'thread_id' => $thread->id]);
        return $comment;
    }
}
