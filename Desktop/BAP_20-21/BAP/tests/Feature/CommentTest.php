<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Comment;
use App\Models\Thread;
use Illuminate\Support\Facades\File;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_comment_can_be_edited_through_the_form()
    {
        $this->withoutExceptionHandling();
        $user = $this->actingAsUserWithReturn();
        $thread = $this->createThreadWithUser($user);
        $this->post('/thread/thread-detail/'.$thread->id.'/comment', $this->commentdata());
        $comment = Comment::where('thread_id', $thread->id)->first();
        $response = $this->patch('/edit-comment/'.$comment->id.'/submit', $this->editommentdata());
        $response->assertStatus(302);
    }
    /** @test */
    public function a_comment_can_be_deleted()
    {
        $this->withoutExceptionHandling();
        $user = $this->actingAsUserWithReturn();
        $thread = $this->createThreadWithUser($user);
        $this->post('/thread/thread-detail/'.$thread->id.'/comment', $this->commentdata());
        $comment = Comment::where('thread_id', $thread->id)->first();
        $response = $this->delete('/delete-comment/'.$comment->id);
        $response->assertStatus(302);
    }
    private function createThreadWithUser($user){
        $thread = Thread::factory()->create(['author_id' => $user->id]);
        return $thread;
    }
    private function actingAsUserWithReturn(){
        $user = User::factory()->create();
        $this->actingAs($user);
        return $user;
    }
    private function commentdata(){
        return [
            'wysiwyg-editor' => '<p>Dit is een comment</p>',
        ];
    }
    private function editommentdata(){
        return [
            'inhoud' => '<p>Dit is een comment2</p>',
        ];
    }
  
}
