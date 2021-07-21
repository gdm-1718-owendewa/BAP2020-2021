<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\File;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_task_can_be_added_through_the_form()
    {
        $user = $this->actingAsUserWithReturn();
        $response = $this->post('/calender/'.$user->id.'/01-07-2021', $this->data());
        $this->assertCount(1, Task::all());
    }
    /** @test */
    public function a_title_is_required()
    {
        $user = $this->actingAsUserWithReturn();
        $response = $this->post('/calender/'.$user->id.'/01-07-2021', array_merge($this->data(), ['calendar-task-title' => '']));
        $response->assertSessionHasErrors('calendar-task-title');
        $this->assertCount(0, Task::all());
    }
    /** @test */
    public function a_title_is_max_200_characters()
    {
        $user = $this->actingAsUserWithReturn();
        $response = $this->post('/calender/'.$user->id.'/01-07-2021', array_merge($this->data(), ['calendar-task-title' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laborisaliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laborisLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laborisaliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris']));
        $response->assertSessionHasErrors('calendar-task-title');
        $this->assertCount(0, Task::all());
    }
     /** @test */
     public function a_hour_is_required()
     {
         $user = $this->actingAsUserWithReturn();
         $response = $this->post('/calender/'.$user->id.'/01-07-2021', array_merge($this->data(), ['time-from-hour' => '']));
         $response->assertSessionHasErrors('time-from-hour');
         $this->assertCount(0, Task::all());
     }
      /** @test */
    public function a_minute_is_required()
    {
        $user = $this->actingAsUserWithReturn();
        $response = $this->post('/calender/'.$user->id.'/01-07-2021', array_merge($this->data(), ['time-from-minute' => '']));
        $response->assertSessionHasErrors('time-from-minute');
        $this->assertCount(0, Task::all());
    }
    /** @test */
    public function a_task_can_be_editted_through_the_form()
    {
        $user = $this->actingAsUserWithReturn();
        $task = $this->createTaskWithUser($user);
        $this->post('/calender/'.$user->id.'/edittask/'.$task->id.'/submit', $this->data());
        $this->assertCount(1, Task::all());
    }
     /** @test */
     public function a_task_can_be_deleted()
     {
         $user = $this->actingAsUserWithReturn();
         $task = $this->createTaskWithUser($user);
         $this->delete('/calender/'.$user->id.'/deletetask/'.$task->id);
         $this->assertCount(0, Task::all());
     }

    private function actingAsUserWithReturn(){
        $user = User::factory()->create();
        $this->actingAs($user);
        File::makeDirectory('images/users/'.$user->id.'/profile-image', 0777, true, true);
        return $user;
    }
    private function data(){
        return [
            'calendar-task-title' => 'Task title',
            'time-from-hour' => '08',
            'time-from-minute' => '00',

        ];
    }
    private function createTaskWithUser($user){
        $task = Task::factory()->create(['user_id' => $user->id]);
        return $task;
    }
}
