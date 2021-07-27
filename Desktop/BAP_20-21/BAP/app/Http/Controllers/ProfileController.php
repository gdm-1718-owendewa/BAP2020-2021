<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Query;
use App\Models\User;
use App\Models\Article;
use App\Models\Event;
use App\Models\EventSigns;
use App\Models\Thread;
use App\Models\Tutorial;
use App\Models\Course;
use App\Models\CourseSignUp;
use App\Models\CourseUpload;
use App\Models\Comment;
use App\Models\Notes;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Exceptions\InvalidOrderException;
use Illuminate\Support\Facades\Response;

class ProfileController extends Controller
{
    //Profiel pagina
    public function index($user_id)
    {
     
       $page = 'profile-index';
       $user = User::where('id',$user_id)->first();
       if($user != null){
            // Check voor een profiel foto
            $profile_image_path = public_path('images/users/'.$user_id.'/profile-image');
            if(File::exists($profile_image_path)){
               $mainFile = File::allFiles($profile_image_path);
               $profile_image_name = pathinfo($mainFile[0],PATHINFO_FILENAME).'.'.pathinfo($mainFile[0],PATHINFO_EXTENSION);
               $user->image_path = $profile_image_path;
               $user->image = $profile_image_name;
            
            }else{
               $user->image = null;
            }
            return view('profile.home')->with(compact('page','user'));    
       }else{
          return redirect()->back();
       }
   
    }
    //Ga naar edit pagina
    public function edit($user_id)
    {
     
       $page = 'profile-edit';
       $user = User::where('id',$user_id)->first();

       if($user->id == auth()->user()->id || auth()->user()->role == 2){
         $profile_image_path = public_path('images/users/'.$user_id.'/profile-image');
         if(File::exists($profile_image_path)){
            $mainFile = File::allFiles($profile_image_path);
            $profile_image_name = pathinfo($mainFile[0],PATHINFO_FILENAME).'.'.pathinfo($mainFile[0],PATHINFO_EXTENSION);
            $user->image_path = $profile_image_path;
            $user->image = $profile_image_name;
         
         }else{
            $user->image = null;
         }
         return view('profile.edit')->with(compact('page','user', 'user_id'));
      }else{
         return redirect()->back();
      }
    }
    //Pas profiel aan
    public function editSubmit(Request $request, $user_id){
      if($user_id == auth()->user()->id || auth()->user()->role == 2){

      $validator = Validator::make(
         $request->all(),[
            'user-name' => 'required',
            'user-email' => 'required',
            'user-shopname' => 'required',
            'user-shoplocation' => 'required',
            'user-image' => 'file|mimes:jpeg,png,svg',
            ])->validate();
            // Verander de username bij ieder project van de user
            Article::where('author_id', $user_id)->update(['author' => $request['user-name'], ]);
            Comment::where('author_id', $user_id)->update(['author' => $request['user-name'], ]);
            Course::where('author_id', $user_id)->update(['author' => $request['user-name'], ]);
            Event::where('author_id', $user_id)->update(['author' => $request['user-name'], ]);
            Thread::where('author_id', $user_id)->update(['author' => $request['user-name'], ]);
            Tutorial::where('author_id', $user_id)->update(['author' => $request['user-name'], ]);
      //Check of er een profiel foto is geupload
       if(isset($request['user-image'])){
         User::where('id', $user_id)->update(['profile_image' => $request['user-image']->getClientOriginalName() ]);
         $mainpath = public_path("images/users/".$user_id."/profile-image");
         //Check of er al een foto bestaat zo ja vervang deze 
         if(File::exists($mainpath)){
            $mainFile = File::allFiles($mainpath);
            File::delete($mainFile);
            $user_main_image = \Request::file('user-image');
            $user_main_image_name = $user_main_image->getClientOriginalName();
            $user_main_image->move(public_path("/images/users/".$user_id."/profile-image"), $user_main_image_name);
         }else{
            $user_main_image = \Request::file('user-image');
            $user_main_image_name = $user_main_image->getClientOriginalName();
            $user_main_image->move(public_path("/images/users/".$user_id."/profile-image"), $user_main_image_name);
         }
       }
       $data = [
            'name' =>  ucwords($request["user-name"]),
            'email' => $request["user-email"],
            'shopname' => $request["user-shopname"],
            'shoplocation' => $request["user-shoplocation"],
            'role' => 1,
       ];
       User::where('id',$user_id)->update($data);

       if(auth()->user()->role == 2){
         return redirect()->route('dashbord', auth()->user()->id);

       }else{
         return redirect()->route('profile', $user_id)->with('succes','Profiel aangepast');

       }
      }else{
         return redirect()->back();
      }
    }
    //Verwijder user
    public function delete($user_id)
    {
       if(auth()->user()->role == 2){  
          //Check of user events heeft zo ja verwijder deze   
         $events = Event::where('author_id', $user_id)->get();
         foreach($events as $event){
            EventSigns::where('user_id', $user_id)->delete();
            $eventpath = public_path('images/events/'.$event->id);
            File::deleteDirectory($eventpath);
         }
         Event::where('author_id', $user_id)->delete();

         //Check of user tutorials heeft zo ja verwijder deze   
         $tutorials = Tutorial::where('author_id',$user_id)->get();
         foreach($tutorials as $tutorial){
            $tutorialpath = public_path('images/tutorials/'.$tutorial->id);
            File::deleteDirectory($tutorialpath);
         }
         Tutorial::where('author_id', $user_id)->delete();

         $threads = Thread::where('author_id',$user_id)->get();
         Thread::where('author_id',$user_id)->delete();

         //Check of user cursussen heeft zo ja verwijder deze   
         $courses = Course::where('author_id',$user_id)->get();
         foreach($courses as $course){
            CourseUpload::where('course_id',$course->id)->delete();
            CourseSignUp::where('course_id',$course->id)->delete();
            $coursepath = public_path('images/course/'.$course->id);
            File::deleteDirectory($coursepath);
         }
         Course::where('author_id',$user_id)->delete();

         //Check of user artikelen heeft zo ja verwijder deze   
         $articles = Article::where('author_id',$user_id)->get();
         foreach($articles as $article){
            $articlepath = public_path('images/articles/'.$article->id);
            File::deleteDirectory($articlepath);
         }
         Article::where('author_id',$user_id)->delete();
         //Check of user comments heeft zo ja verwijder deze   
         Comment::where('author_id',$user_id)->delete();
         //Check of user een foto/designs heeft zo ja verwijder deze   
         $path = public_path('images/users/'.$user_id);
         if(File::exists($path)){
            File::deleteDirectory($path);
         }
         Notes::where('user_id', $user_id)->delete();
         User::where('id',$user_id)->delete();
       }
       return redirect()->route('dashbord', auth()->user()->id);  
    }
}
