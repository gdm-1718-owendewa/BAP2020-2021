<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class RouteRedirectTest extends TestCase
{
    //$response->assertStatus(200);
    use RefreshDatabase;
    /** @test */
    public function redirect_if_no_user_is_logged_in_on_guide_page()
    {
        $response = $this->get('/guide')
        ->assertRedirect('/login');
    }
    /** @test */
    public function redirect_if_no_user_is_logged_in_on_documents_page()
    {
        $response = $this->get('/documents')
        ->assertRedirect('/login');
    }
    /** @test */
    public function redirect_if_no_user_is_logged_in_on_dashboard_page()
    {
        $response = $this->get('/dashbord/1')
        ->assertRedirect('/login');
    }
    /** @test */
    public function redirect_if_no_user_is_logged_in_on_dashboard_project_page()
    {
        $response = $this->get('/dashbord/1/projects/events')
        ->assertRedirect('/login');
    }
    /** @test */
    public function redirect_if_no_user_is_logged_in_on_notes_page()
    {
        $response = $this->get('/notes/1')
        ->assertRedirect('/login');
    }
    /********************** ARTICLE **********************/

    /** @test */
    public function redirect_if_no_user_is_logged_in_on_article_overview_page()
    {
        $response = $this->get('/article/article-overview')
        ->assertRedirect('/login');
    }
    /** @test */
    public function redirect_if_no_user_is_logged_in_on_article_detail_page()
    {
        $response = $this->get('/article/article-detail/1')
        ->assertRedirect('/login');
    }
    /** @test */
    public function redirect_if_no_user_is_logged_in_on_article_create_page()
    {
        $response = $this->get('/article/create')
        ->assertRedirect('/login');
    }
    /** @test */
    public function redirect_if_no_user_is_logged_in_on_article_edit_page()
    {
        $response = $this->get('/article/edit/1')
        ->assertRedirect('/login');
    }
    /** @test */
    public function redirect_if_no_user_is_logged_in_on_article_edit_submit_page()
    {
        $response = $this->call('PATCH', '/article/edit/1/submit')
        ->assertRedirect('/login');
    }
    /** @test */
    public function redirect_if_no_user_is_logged_in_on_article_delete()
    {
        $response = $this->call('DELETE', '/article/delete/20')
        ->assertRedirect('/login');
    }
    /********************** Tutorial **********************/
    public function redirect_if_no_user_is_logged_in_on_tutorial_overview_page()
    {
        $response = $this->get('/tutorial/tutorial-overview')
        ->assertRedirect('/login');
    }
    /** @test */
    public function redirect_if_no_user_is_logged_in_on_tutorial_detail_page()
    {
        $response = $this->get('/tutorial/detail/1')
        ->assertRedirect('/login');
    }
    /** @test */
    public function redirect_if_no_user_is_logged_in_on_tutorial_create_page()
    {
        $response = $this->get('/tutorial/create')
        ->assertRedirect('/login');
    }
    /** @test */
    public function redirect_if_no_user_is_logged_in_on_tutorial_edit_page()
    {
        $response = $this->get('/tutorial/edit/1')
        ->assertRedirect('/login');
    }
    /** @test */
    public function redirect_if_no_user_is_logged_in_on_tutorial_edit_submit_page()
    {
        $response = $this->call('PATCH', '/tutorial/edit/1/submit')
        ->assertRedirect('/login');
    }
    /** @test */
    public function redirect_if_no_user_is_logged_in_on_tutorial_delete()
    {
        $response = $this->call('DELETE', '/tutorial/delete/20')
        ->assertRedirect('/login');
    }
    /********************** Event **********************/
    public function redirect_if_no_user_is_logged_in_on_event_overview_page()
    {
        $response = $this->get('/event/event-overview')
        ->assertRedirect('/login');
    }
    /** @test */
    public function redirect_if_no_user_is_logged_in_on_event_detail_page()
    {
        $response = $this->get('/event/event-detail/1')
        ->assertRedirect('/login');
    }
    /** @test */
    public function redirect_if_no_user_is_logged_in_on_event_create_page()
    {
        $response = $this->get('/event/create')
        ->assertRedirect('/login');
    }
    /** @test */
    public function redirect_if_no_user_is_logged_in_on_event_edit_page()
    {
        $response = $this->get('/event/edit/1')
        ->assertRedirect('/login');
    }
    /** @test */
    public function redirect_if_no_user_is_logged_in_on_event_edit_submit_page()
    {
        $response = $this->call('PATCH', '/event/edit/1/submit')
        ->assertRedirect('/login');
    }
    /** @test */
    public function redirect_if_no_user_is_logged_in_on_event_delete()
    {
        $response = $this->call('DELETE', '/event/delete/20')
        ->assertRedirect('/login');
    }
    /** @test */
    public function redirect_if_no_user_is_logged_in_on_event_pdf_download()
    {
        $response = $this->get('/event/event-pdf/20')
        ->assertRedirect('/login');
    }
     /** @test */
     public function redirect_if_no_user_is_logged_in_on_event_sign()
     {
         $response = $this->get('/event/sign/1/20')
         ->assertRedirect('/login');
     }
      /** @test */
    public function redirect_if_no_user_is_logged_in_on_event_unsign()
    {
        $response = $this->get('/event/unsign/1/20')
        ->assertRedirect('/login');
    }
    /********************** Thread **********************/
    public function redirect_if_no_user_is_logged_in_on_thread_overview_page()
    {
        $response = $this->get('/thread/thread-overview')
        ->assertRedirect('/login');
    }
    /** @test */
    public function redirect_if_no_user_is_logged_in_on_thread_detail_page()
    {
        $response = $this->get('/thread/thread-detail/1')
        ->assertRedirect('/login');
    }
    /** @test */
    public function redirect_if_no_user_is_logged_in_on_thread_create_page()
    {
        $response = $this->get('/thread/create')
        ->assertRedirect('/login');
    }
    /** @test */
    public function redirect_if_no_user_is_logged_in_on_thread_edit_page()
    {
        $response = $this->get('/thread/edit/1')
        ->assertRedirect('/login');
    }
    /** @test */
    public function redirect_if_no_user_is_logged_in_on_thread_edit_submit_page()
    {
        $response = $this->call('PATCH', '/thread/edit/1/submit')
        ->assertRedirect('/login');
    }
    /** @test */
    public function redirect_if_no_user_is_logged_in_on_thread_delete()
    {
        $response = $this->call('DELETE', '/thread/delete/20')
        ->assertRedirect('/login');
    }
    /********************** Course **********************/
    public function redirect_if_no_user_is_logged_in_on_course_overview_page()
    {
        $response = $this->get('/course/course-overview')
        ->assertRedirect('/login');
    }
    /** @test */
    public function redirect_if_no_user_is_logged_in_on_course_detail_page()
    {
        $response = $this->get('/course/course-detail/1')
        ->assertRedirect('/login');
    }
    /** @test */
    public function redirect_if_no_user_is_logged_in_on_course_create_page()
    {
        $response = $this->get('/course/create')
        ->assertRedirect('/login');
    }
    /** @test */
    public function redirect_if_no_user_is_logged_in_on_course_edit_page()
    {
        $response = $this->get('/course/edit/1')
        ->assertRedirect('/login');
    }
    /** @test */
    public function redirect_if_no_user_is_logged_in_on_course_edit_submit_page()
    {
        $response = $this->call('PATCH', '/course/edit/1/submit')
        ->assertRedirect('/login');
    }
    /** @test */
    public function redirect_if_no_user_is_logged_in_on_course_delete()
    {
        $response = $this->call('DELETE', '/course/delete/20')
        ->assertRedirect('/login');
    }
     /** @test */
     public function redirect_if_no_user_is_logged_in_on_course_sign()
     {
         $response = $this->get('/course/course-detail/20/1/signup')
         ->assertRedirect('/login');
     }
     /** @test */
     public function redirect_if_no_user_is_logged_in_on_course_unsign()
     {
         $response = $this->get('/course/course-detail/20/1/signout')
         ->assertRedirect('/login');
     }
     /** @test */
     public function redirect_if_no_user_is_logged_in_on_course_upload_overview()
     {
         $response = $this->get('/course/upload-overview/20')
         ->assertRedirect('/login');
     }
    /** @test */
    public function redirect_if_no_user_is_logged_in_on_course_upload_detail()
    {
        $response = $this->get('/course/upload-overview/20/upload/4')
        ->assertRedirect('/login');
    }
    /** @test */
    public function redirect_if_no_user_is_logged_in_on_course_upload_delete()
    {
        $response = $this->call('DELETE', '/course/upload-overview/20/delete/4')
        ->assertRedirect('/login');
    }
    /** @test */
    public function redirect_if_no_user_is_logged_in_on_course_uploadcontent_form()
    {
        $response = $this->get('/course/20/addcontent')
        ->assertRedirect('/login');
    }
    /** @test */
    public function redirect_if_no_user_is_logged_in_on_course_uploadcontent_edit_form()
    {
        $response = $this->get('/course/20/editupload/2')
        ->assertRedirect('/login');
    }
    /** @test */
    public function redirect_if_no_user_is_logged_in_on_course_files_page()
    {
        $response = $this->get('/course/files/20')
        ->assertRedirect('/login');
    }
    /********************** Profile **********************/
    public function redirect_if_no_user_is_logged_in_on_profile()
    {
        $response = $this->get('/profile/1')
        ->assertRedirect('/login');
    }
    public function redirect_if_no_user_is_logged_in_on_profile_edit()
    {
        $response = $this->get('/profile/edit/1')
        ->assertRedirect('/login');
    }
    public function redirect_if_no_user_is_logged_in_on_profile_delete()
    {
        $response = $this->call('DELETE','/profile/delete/1')
        ->assertRedirect('/login');
    }
    /********************** Storage **********************/
    public function redirect_if_no_user_is_logged_in_on_storage()
    {
        $response = $this->get('/storage/1')
        ->assertRedirect('/login');
    }
    /********************** Calender **********************/
    public function redirect_if_no_user_is_logged_in_on_calender()
    {
        $response = $this->get('/calender/1')
        ->assertRedirect('/login');
    }
}
