<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\File;

class ProfileTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_user_can_be_added_through_the_form()
    {
        $response = $this->post('/register', $this->userdata());
        $response->assertStatus(302);

    }
    /** @test */
    public function a_name_is_required()
    {
        $response = $this->post('/register', array_merge($this->userdata(),['name' => '']));
        $response->assertSessionHasErrors('name');
        $this->assertCount(0, User::all());
    }
    /** @test */
    public function a_name_is_max_255_characters()
    {
        $response = $this->post('/register', array_merge($this->userdata(),['name' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laborisaliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laborisLorem ipsum dolor sit amet,']));
        $response->assertSessionHasErrors('name');
        $this->assertCount(0, User::all());
    }
    /** @test */
    public function an_email_is_required()
    {
        $response = $this->post('/register', array_merge($this->userdata(),['email' => '']));
        $response->assertSessionHasErrors('email');
        $this->assertCount(0, User::all());
    }
    /** @test */
    public function an_email_is_max_255_characters()
    {
        $response = $this->post('/register', array_merge($this->userdata(),['email' => 'Lorem@ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laborisaliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laborisLorem ipsum dolor sit amet,']));
        $response->assertSessionHasErrors('email');
        $this->assertCount(0, User::all());
    }
    /** @test */
    public function an_email_must_be_of_the_type_email()
    {
        $response = $this->post('/register', array_merge($this->userdata(),['email' => 'Lorem amet,']));
        $response->assertSessionHasErrors('email');
        $this->assertCount(0, User::all());
    }
    /** @test */
    public function a_password_is_required()
    {
        $response = $this->post('/register', array_merge($this->userdata(),['password' => '']));
        $response->assertSessionHasErrors('password');
        $this->assertCount(0, User::all());
    }
    /** @test */
    public function a_password_is_min_8_characters()
    {
        $response = $this->post('/register', array_merge($this->userdata(),['password' => 'aaaa']));
        $response->assertSessionHasErrors('password');
        $this->assertCount(0, User::all());
    }
    /** @test */
    public function a_shopname_is_required()
    {
        $response = $this->post('/register', array_merge($this->userdata(),['shopname' => '']));
        $response->assertSessionHasErrors('shopname');
        $this->assertCount(0, User::all());
    }
    /** @test */
    public function a_shopname_is_max_255_characters()
    {
        $response = $this->post('/register', array_merge($this->userdata(),['shopname' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laborisaliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laborisLorem ipsum dolor sit amet,']));
        $response->assertSessionHasErrors('shopname');
        $this->assertCount(0, User::all());
    }
    /** @test */
    public function a_shoplocation_is_required()
    {
        $response = $this->post('/register', array_merge($this->userdata(),['shoplocation' => '']));
        $response->assertSessionHasErrors('shoplocation');
        $this->assertCount(0, User::all());
    }
    /** @test */
    public function a_shoplocation_is_max_255_characters()
    {
        $response = $this->post('/register', array_merge($this->userdata(),['shoplocation' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laborisaliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laborisLorem ipsum dolor sit amet,']));
        $response->assertSessionHasErrors('shoplocation');
        $this->assertCount(0, User::all());
    }
    /** @test */
    public function a_user_can_be_edited_through_the_form()
    {
        $user = $this->actingAsUserWithReturn();
        $response = $this->patch('/profile/edit/'.$user->id.'/submit', $this->userdata());
        $response->assertStatus(302);

    }
    private function actingAsUserWithReturn(){
        $user = User::factory()->create();
        $this->actingAs($user);
        return $user;
    }
    private function userdata(){
        return [
            'name' => 'user',
            'email' => 'user@email.be',
            'password' => 'password',
            'shopname' => 'shoptastic',
            'shoplocation' => 'brugsevaart 57, 9000 Gent',
            'role' => 1,
            'guide_message' => 0,
        ];
    }
}
