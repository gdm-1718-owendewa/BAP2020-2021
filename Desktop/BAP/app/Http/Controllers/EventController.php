<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Query;
use App\Models\Event;
use App\Models\EventSigns;
use App\Models\User;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class EventController extends Controller
{
    //Overview pagina
    public function overview()
    {
      
       $page = 'overview';
       $events = Event::paginate(6);
       foreach($events as $event){
          $image_path = "images/events/".$event->id."/main-image/";
          $mainFile = File::allFiles($image_path);
          $event->image_path = "images/events/".$event->id."/main-image/".pathinfo($mainFile[0],PATHINFO_FILENAME).'.'.pathinfo($mainFile[0],PATHINFO_EXTENSION);
          $event->intro_desc = substr($event->description, 0, 25);
       }
       return view('event.overview')->with(compact('page', 'events'));
    }
    //Detail pagina
    public function detail($id)
    {
      
       $page = 'event-detail';
       $event = Event::where('id',$id)->first();
       if($event != null){
         $eventSigns = EventSigns::leftjoin('events', 'events.id', '=', 'event-signs.event_id')->leftjoin('users', 'users.id', '=', 'event-signs.user_id')->where('event-signs.event_id' ,'=', $event->id)->orderBy('event-signs.event_id')->get();
         $totalEventSigns = count(EventSigns::where('event_id',$event->id)->get());
         $event->freeSpaces = $event->capacity - $totalEventSigns;
         if($event->author_id == auth()->user()->id || auth()->user()->role == 2){
            return view('event.detail')->with(compact('page','id', 'event', 'eventSigns'));
         }else{
            $signedIn = EventSigns::where('user_id', auth()->user()->id)->where('event_id', $id)->first();
            return view('event.detail')->with(compact('page','id', 'event','signedIn'));
         }
      }else{
         return redirect()->back();
      }
    }
    //Create pagina
    public function create()
    {
      
       $page = 'event-create';
       return view('event.create')->with(compact('page'));
    }
    //Maak event aan
    public function createSubmit(Request $request)
    {
      
       $validator = Validator::make(
         $request->all(),[
         'title' => 'required|max:200',
         'general-info' => 'required|min:50|max:10000',
         'capacity' => 'required',
         'location' => 'required',
         'main-image' => 'required|file|mimes:jpeg,png,svg',
         'date-from' => 'required',
         'date-until' => 'required',
         'time-from-hour' => 'required',
         'time-from-minute' => 'required',
         'time-until-hour' => 'required',
         'time-until-minute' => 'required',
         ])->validate();
         $user_id = auth()->user()->id;
         $user = User::where('id',$user_id)->first();
         $complete_from_time = $request["time-from-hour"].':'.$request["time-from-minute"];
         $complete_until_time = $request["time-until-hour"].':'.$request["time-until-minute"];
         $eventData = [
            'author' => $user->name,
            'author_id' => $user_id,
            'title' => ucfirst($request["title"]),
            'description' => $request["general-info"],
            'capacity' => $request["capacity"],
            'location' => $request["location"],
            'start_date' => $request["date-from"],
            'end_date' => $request["date-until"],
            'start_time' => $complete_from_time,
            'start_hour' => $request["time-from-hour"],
            'start_minute' => $request["time-from-minute"],
            'end_time' => $complete_until_time,
            'end_hour' => $request["time-until-hour"],
            'end_minute' => $request["time-until-minute"],
         ];
         Event::create($eventData);

         $event_id = Event::orderBy('created_at', 'desc')->first();
         $event_image_name = $request['main-image']->getClientOriginalName();
         $request['main-image']->move(public_path("/images/events/".$event_id->id."/main-image"), $event_image_name);
         return redirect()->route('event-overview');
    }
    //Ga naar edit pagina
    public function edit($id)
    {
      
       $page = 'event-edit';
       $event = Event::where('id',$id)->first();
       //Check of event bestaat
       if($event != null){
          //Check of user author is of een admin
         if($event->author_id == auth()->user()->id || auth()->user()->role == 2){
            $mainpath = public_path("images/events/".$id."/main-image");
            $mainFile = File::allFiles($mainpath);
            $mainFilename = pathinfo($mainFile[0],PATHINFO_FILENAME).'.'.pathinfo($mainFile[0],PATHINFO_EXTENSION);
            $main_file_path = "/images/events/".$id."/main-image/".$mainFilename;
            $event->main_file_path = $main_file_path;
            return view('event.edit')->with(compact('page','id','event'));
         }else{
               return redirect()->back();
         }
      }else{
         return redirect()->back();
      }
    }
    //Pas event aan
    public function editSubmit(Request $request, $id)
    {
      
      $event = Event::findOrFail($id);
      if($event->author_id == auth()->user()->id || auth()->user()->role == 2){

         $validator = Validator::make(
            $request->all(),[
            'title' => 'required|max:200',
            'general-info' => 'required|min:50|max:10000',
            'capacity' => 'required|integer|min:0',
            'location' => 'required',
            'main-image' => 'file|mimes:jpeg,png,svg',
            'date-from' => 'required',
            'date-until' => 'required',
            'time-from-hour' => 'required',
            'time-from-minute' => 'required',
            'time-until-hour' => 'required',
            'time-until-minute' => 'required',
            ])->validate();
         $totalEventSigns = count(EventSigns::where('event_id',$event->id)->get());
         if($request['capacity'] < $totalEventSigns){
            return redirect()->back()->with('fail', 'Uw aantal deelnemers is kleiner dan het aantal mensen die al ingeschreven zijn en moet hoger zijn dan '. $totalEventSigns);
         }else{
            if(isset($request['main-image'])){  
                  $mainpath = public_path("images/events/".$id."/main-image");
                  $mainFile = File::allFiles($mainpath);
                  File::delete($mainFile);
                  $mainpath = public_path("images/events/".$id."/main-image");
                  $event_main_image = \Request::file('main-image');
                  $event_main_image_name = $event_main_image->getClientOriginalName();
                  $event_main_image->move(public_path("/images/events/".$id."/main-image"), $event_main_image_name);
               
            }
            $complete_from_time = $request["time-from-hour"].':'.$request["time-from-minute"];
            $complete_until_time = $request["time-until-hour"].':'.$request["time-until-minute"];
            $data = [
               'title' => ucfirst($request['title']),
               'description' => $request['general-info'],
               'capacity' => $request['capacity'],
               'location' => $request['location'],
               'start_date' => $request['date-from'],
               'end_date' => $request['date-until'],
               'start_time' => $complete_from_time,
               'start_hour' => $request["time-from-hour"],
               'start_minute' => $request["time-from-minute"],
               'end_time' => $complete_until_time,
               'end_hour' => $request["time-until-hour"],
               'end_minute' => $request["time-until-minute"],
            ];
            $event->update($data);
            return redirect()->route('event-detail', $id);
         }
      }else{
         return redirect()->route('event-detail', $id);
      }
    }
    //Verwijder event
    public function delete($id)
    {
      
       $page = 'event-delete';
       $event = Event::where('id',$id)->first();

       if($event->author_id == auth()->user()->id || auth()->user()->role == 2){
         $eventdirpath = public_path("images/events/".$id);
         //Verwijder event en signs
         if(File::exists($eventdirpath)){
            Event::where('id', $id)->delete();
            EventSigns::where('event_id', $id)->delete();
            File::deleteDirectory($eventdirpath);
            return redirect()->back()->with('succes', 'Evenement - '. $event->title .' is verwijderd.');
         }else{
            return redirect()->back();
         }
    }
   }
   //Inschrijving event
    public function eventSignUp($user_id, $event_id){
      
       
      if($user_id != auth()->user()->id || auth()->user()->role == 2){
         return redirect()->back();
      }else{
         $event = Event::where('id',$event_id)->first();
         $totalEventSigns = count(EventSigns::where('event_id',$event->id)->get());
         $freeSpaces = $event->capacity - $totalEventSigns;
         if($freeSpaces > 0){
            $data = [
               'user_id' => $user_id,
               'event_id' => $event_id,
            ];
            EventSigns::create($data);
            return redirect()->route('event-detail', $event_id)->with('succes', 'U bent ingeschreven bekijk dit nu op uw kalender');
         }else{
            return redirect()->route('event-detail', $event_id)->with('fail', 'Er zijn geen plaatsen meer');
         }
        
      }
   }
   //Event uitschrijven
   public function eventSignOut($user_id, $event_id){
      
       $event = Event::where('id',$event_id)->first();

       if($user_id == auth()->user()->id || auth()->user()->role == 2){
         EventSigns::where('user_id', $user_id)
         ->where('event_id', $event_id)
         ->delete();
         return redirect()->route('event-detail', $event_id)->with('succes', 'U bent uitgeschreven');
      }else{
         return redirect()->route('event-detail', $event_id)->with('fail', 'Er liep iets mis');
      }
      }
   
}
