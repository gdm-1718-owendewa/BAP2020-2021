<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RouteTest extends TestCase
{
    //$response->assertStatus(200);

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
    public function redirect_if_no_user_is_logged_in_on_article_delete()
    {
        $response = $this->call('DELETE', '/article/delete/20')
        ->assertRedirect('/login');
    }
}
