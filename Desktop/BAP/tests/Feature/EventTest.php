<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;

class EventTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function an_event_can_be_added_through_the_form()
    {
        $user = $this->actingAsUserWithReturn();
        $response = $this->post('/event/create/submit', $this->data());
        $this->assertCount(1, Event::all());
    }
    /** @test */
    public function a_title_is_required()
    {
        $user = $this->actingAsUserWithReturn();
        $response = $this->post('/event/create/submit', array_merge($this->data(), ['title' => '']));
        $response->assertSessionHasErrors('title');
        $this->assertCount(0, Event::all());
    }
     /** @test */
     public function a_general_info_is_required()
     {
         $user = $this->actingAsUserWithReturn();
         $response = $this->post('/event/create/submit', array_merge($this->data(), ['general-info' => '']));
         $response->assertSessionHasErrors('general-info');
         $this->assertCount(0, Event::all());
     }
     /** @test */
     public function a_capacity_is_required()
     {
         $user = $this->actingAsUserWithReturn();
         $response = $this->post('/event/create/submit', array_merge($this->data(), ['capacity' => '']));
         $response->assertSessionHasErrors('capacity');
         $this->assertCount(0, Event::all());
     }
      /** @test */
      public function a_location_is_required()
      {
          $user = $this->actingAsUserWithReturn();
          $response = $this->post('/event/create/submit', array_merge($this->data(), ['location' => '']));
          $response->assertSessionHasErrors('location');
          $this->assertCount(0, Event::all());
      }
       /** @test */
     public function an_image_is_required()
     {
         $user = $this->actingAsUserWithReturn();
         $response = $this->post('/event/create/submit', array_merge($this->data(), ['main-image' => '']));
         $response->assertSessionHasErrors('main-image');
         $this->assertCount(0, Event::all());
     }
      /** @test */
      public function a_date_from_is_required()
      {
          $user = $this->actingAsUserWithReturn();
          $response = $this->post('/event/create/submit', array_merge($this->data(), ['date-from' => '']));
          $response->assertSessionHasErrors('date-from');
          $this->assertCount(0, Event::all());
      }
       /** @test */
       public function a_date_until_is_required()
       {
           $user = $this->actingAsUserWithReturn();
           $response = $this->post('/event/create/submit', array_merge($this->data(), ['date-until' => '']));
           $response->assertSessionHasErrors('date-until');
           $this->assertCount(0, Event::all());
       }
        /** @test */
        public function a_from_hour_is_required()
        {
            $user = $this->actingAsUserWithReturn();
            $response = $this->post('/event/create/submit', array_merge($this->data(), ['time-from-hour' => '']));
            $response->assertSessionHasErrors('time-from-hour');
            $this->assertCount(0, Event::all());
        }
        /** @test */
        public function a_from_minute_is_required()
        {
            $user = $this->actingAsUserWithReturn();
            $response = $this->post('/event/create/submit', array_merge($this->data(), ['time-from-minute' => '']));
            $response->assertSessionHasErrors('time-from-minute');
            $this->assertCount(0, Event::all());
        } 
         /** @test */
         public function a_until_hour_is_required()
         {
             $user = $this->actingAsUserWithReturn();
             $response = $this->post('/event/create/submit', array_merge($this->data(), ['time-until-hour' => '']));
             $response->assertSessionHasErrors('time-until-hour');
             $this->assertCount(0, Event::all());
         }
         /** @test */
         public function a_until_minute_is_required()
         {
             $user = $this->actingAsUserWithReturn();
             $response = $this->post('/event/create/submit', array_merge($this->data(), ['time-until-minute' => '']));
             $response->assertSessionHasErrors('time-until-minute');
             $this->assertCount(0, Event::all());
         } 
        
         /** @test */
        public function an_event_can_be_added_and_image_will_be_added()
        {
            $user = $this->actingAsUserWithReturn();
            $response = $this->createEvent();
            $this->assertCount(1, Event::all());
        }
        /** @test */
        public function an_event_can_be_edited_through_the_form()
        {
            $user = $this->actingAsUserWithReturn();
            $event = $this->createEvent();
            $response = $this->post('/event/edit/'.$event->id.'/submit', $this->data());
            $this->assertCount(1, Event::all());
        }
        /** @test */
        public function an_user_can_sign_in()
        {
            $user = $this->actingAsUserWithReturn();
            $event = $this->createEvent();
            $response = $this->get('/event/sign/'.$user->id.'/'.$event->id);
            $response->assertStatus(302);
        }
         /** @test */
         public function an_user_can_sign_out()
         {
             $user = $this->actingAsUserWithReturn();
             $event = $this->createEvent();
             $this->get('/event/sign/'.$user->id.'/'.$event->id);
             $response = $this->get('/event/unsign/'.$user->id.'/'.$event->id);
             $response->assertStatus(302);
         }
          /** @test */
          public function an_user_can_get_event_pdf()
          {
              $user = $this->actingAsUserWithReturn();
              $event = $this->createEventWithUser($user);
              $response = $this->get('event/event-pdf/'.$event->id);
              $response->assertStatus(200);
          }
    private function data(){
        return [
            'title' => 'Event title',
            'general-info' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex',
            'capacity' => 5,
            'location' => 'brugsevaart 57, 9000 Gent',
            'main-image' => UploadedFile::fake()->image('avatar.jpg'),
            'date-from' => '01-01-2022',
            'date-until' => '01-01-2022',
            'time-from-hour' => '08',
            'time-from-minute' => '00',
            'time-until-hour' => '20',
            'time-until-minute' => '00',
           
        ];
    }
    
    private function actingAsUserWithReturn(){
        $user = User::factory()->create();
        $this->actingAs($user);
        File::makeDirectory('images/users/'.$user->id.'/profile-image', 0777, true, true);
        return $user;
    }
    private function addImage($event){
        File::makeDirectory('images/events/'.$event->id.'/main-image', 0777, true, true);   
        $oldpath = public_path('/images/dummy.jpg');
        $newpath = public_path('/images/events/'.$event->id.'/main-image/image.jpg');
        File::copy($oldpath, $newpath);
    }
    private function createEvent(){
        $event = Event::factory()->create();
        File::makeDirectory('images/events/'.$event->id.'/main-image', 0777, true, true);   
        $oldpath = public_path('/images/dummy.jpg');
        $newpath = public_path('/images/events/'.$event->id.'/main-image/image.jpg');
        File::copy($oldpath, $newpath);
        return $event;
    }
    private function createEventWithUser($user){
        $event = Event::factory()->create(['author_id' => $user->id]);
        File::makeDirectory('images/events/'.$event->id.'/main-image', 0777, true, true);   
        $oldpath = public_path('/images/dummy.jpg');
        $newpath = public_path('/images/events/'.$event->id.'/main-image/image.jpg');
        File::copy($oldpath, $newpath);
        return $event;
    }
}
