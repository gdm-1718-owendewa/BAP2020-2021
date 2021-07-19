<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Query;
use App\Models\Task;
use App\Models\EventSigns;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CalenderController extends Controller
{
    //Kalender pagina
    public function index($user_id)
    {
        if(!auth()->user()){
            return redirect()->route('welcome');
          }
            $page = 'calender-index';
            if($user_id != auth()->user()->id){
                return redirect()->back();
            }
            return view('general.calender')->with(compact('page','user_id'));
       
    }
    //Maak taak aan
    public function createTask(Request $request, $user_id, $date)
    {
            if($user_id != auth()->user()->id){
                return redirect()->back();
            }else{
                $validator = Validator::make(
                    $request->all(),[
                    'calendar-task-title' => 'required|max:200',
                    'time-from-hour' => 'required',
                    'time-from-minute' => 'required',
                    ])->validate();
           
                $data = [
                    'user_id' => $user_id,
                    'date' => $date,
                    'description' => ucfirst($request["calendar-task-title"]),
                    'hour' => $request["time-from-hour"],
                    'minute' => $request["time-from-minute"],
                ];
                Task::create($data);
                return redirect()->back()->with('succes','Taak: '.$request["calendar-task-title"].' is nu toegevoegd, u kan deze nu bekijken');
            }
    }
    // Haal taken op 
    public function getTasks(Request $request)
    {
            $user_id = $request->user_id;
            if($user_id != auth()->user()->id){
                return redirect()->back();
            }
            $date = $request->date;
            $data = Task::where('user_id',$user_id)->where('date', $date)->get();
            return response()->json($data);
    }
    public function getEvents(Request $request)
    {
        $user_id = $request->user_id;
        $date = $request->date;
        $data = EventSigns::leftjoin('events', 'events.id', '=', 'event-signs.event_id')->where('event-signs.user_id','=',$user_id)->where('events.start_date','=', $date)->get();
        if($user_id != auth()->user()->id){
            return redirect()->back();
        }
        return response()->json($data);
    }
     // Haal alle taken op 
     public function getAllTasks(Request $request)
     {
             $user_id = $request->user_id;
             if($user_id != auth()->user()->id){
                 return redirect()->back();
             }
             $data = Task::where('user_id',$user_id)->get();
             return response()->json($data);
     }
     public function getAllEvents(Request $request)
     {
             $user_id = $request->user_id;
             $data = EventSigns::leftjoin('events', 'events.id', '=', 'event-signs.event_id')->where('event-signs.user_id','=',$user_id)->get();
             if($user_id != auth()->user()->id){
                 return redirect()->back();
             }
             return response()->json($data);
     }
    //Pas taak aan pagina
    public function editTask($user_id, $task_id)
    {
        if($user_id != auth()->user()->id){
            return redirect()->back();
        }
        $task = Task::where('user_id',$user_id)->where('id', $task_id)->first();
        $page = 'task-edit';
        return view('tasks.edit')->with(compact('page','task'));
    }
    //Pas taak aan
    public function editTaskSubmit(Request $request, $user_id, $task_id)
    {
        if($user_id != auth()->user()->id){
            return redirect()->back();
        }
        $validator = Validator::make(
            $request->all(),[
            'task-description' => 'required|max:200',
            'time-from-hour' => 'required',
            'time-from-minute' => 'required',
            ])->validate();
        $data = [
            'description' =>  ucfirst($request["task-description"]),
            'hour' => $request["time-from-hour"],
            'minute' => $request["time-from-minute"]
        ];
        Task::where('id',$task_id)->where('user_id', $user_id)->update($data);
        return redirect()->route('calendar', ['user_id' => $user_id])->with('succes','Taak '. $request["task-hour"].' - '.$request["task-description"].' is aangepast');
    }
    //Verwijder taak
    public function deleteTask(Request $request, $user_id, $task_id)
    {
        if($user_id != auth()->user()->id){
            return redirect()->back();
        }
        $task = Task::where('user_id',$user_id)->where('id', $task_id)->delete();
        return redirect()->back()->with('succes', 'Taak verwijdert');
    }
}
