<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\File;

class NotesTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_note_can_be_added_through_the_form()
    {
        $response = $this->post('/notes/noteupload', $this->data());
        $response->assertStatus(200);
    }
    private function actingAsUserWithReturn(){
        $user = User::factory()->create();
        $this->actingAs($user);
        return $user;
    }
    private function data(){
        $user = $this->actingAsUserWithReturn();
        return [
            'user_id' => $user->id,
            'note' => 'dit is een notitie',
        ];
    }
}
