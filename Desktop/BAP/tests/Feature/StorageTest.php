<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;

class StorageTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function add_item_to_storage_through_form()
    {
        $user = $this->actingAsUserWithReturn();
        $response = $this->post('/storage/'.$user->id.'/design', $this->data());
        $response->assertStatus(302);
    }
    private function actingAsUserWithReturn(){
        $user = User::factory()->create();
        $this->actingAs($user);
        return $user;
    }
    private function data(){
        return [
            'design-files.*' => UploadedFile::fake()->image('avatar.jpg'),
        ];
    }
   
}
