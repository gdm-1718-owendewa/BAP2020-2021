<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Thread;
use Illuminate\Support\Facades\File;
class ThreadTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_thread_can_be_added_through_the_form()
    {
        $user = $this->actingAsUserWithReturn();
        $response = $this->post('/thread/create/submit', $this->data());
        $this->assertCount(1, Thread::all());
    }
    /** @test */
    public function a_title_is_required()
    {
        $user = $this->actingAsUserWithReturn();
        $response = $this->post('/thread/create/submit', array_merge($this->data(), ['question' => '']));
        $response->assertSessionHasErrors('question');
        $this->assertCount(0, Thread::all());
    }
     /** @test */
     public function a_title_is_max_200_characters()
     {
         $user = $this->actingAsUserWithReturn();
         $response = $this->post('/thread/create/submit', array_merge($this->data(), ['question' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex']));
         $response->assertSessionHasErrors('question');
         $this->assertCount(0, Thread::all());
     }
    /** @test */
    public function a_content_is_required()
    {
        $user = $this->actingAsUserWithReturn();
        $response = $this->post('/thread/create/submit', array_merge($this->data(), ['info' => '']));
        $response->assertSessionHasErrors('info');
        $this->assertCount(0, Thread::all());
    }
      /** @test */
      public function a_content_is_min_50()
      {
          $user = $this->actingAsUserWithReturn();
          $response = $this->post('/thread/create/submit', array_merge($this->data(), ['info' => 'aaaaa']));
          $response->assertSessionHasErrors('info');
          $this->assertCount(0, Thread::all());
      }

     /** @test */
     public function a_thread_can_be_edited_through_the_form()
     {
         
         $user = $this->actingAsUserWithReturn();
         $thread = $this->createThreadWithUser($user);
         $response = $this->patch('/thread/edit/'.$thread->id.'/submit', $this->editdata());
         $response->assertRedirect('/thread/thread-detail/'.$thread->id);
     }

     /** @test */
     public function a_comment_can_be_added_through_the_form()
     {
         $user = $this->actingAsUserWithReturn();
         $thread = $this->createThread();
         $response = $this->post('/thread/thread-detail/'.$thread->id.'/comment', $this->commentdata());
         $response->assertStatus(302);
     }
    private function actingAsUserWithReturn(){
        $user = User::factory()->create();
        $this->actingAs($user);
        File::makeDirectory('images/users/'.$user->id.'/profile-image', 0777, true, true);
        return $user;
    }
    private function createThread(){
        $thread = Thread::factory()->create();
        return $thread;
    }
    private function createThreadWithUser($user){
        $thread = Thread::factory()->create(['author_id' => $user->id]);
        return $thread;
    }
    private function data(){
        return [
            'question' => 'Thread title',
            'info' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris',
           
        ];
    }
    private function editdata(){
        return [
            'question' => 'Thread title2',
            'info' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris2',
           
        ];
    }
    private function commentdata(){
        return [
            'wysiwyg-editor' => '<p>Dit is een comment</p>',
        ];
    }
}
