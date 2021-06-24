<?php

namespace App\Http\Controllers;
use App\Models\Query;
use App\Models\Notes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotesController extends Controller
{
    //Notitie pagina
    public function index($user_id)
    {
        if(!auth()->user()){
            return redirect()->route('welcome');
          }
            $page = 'notes-index';
            if($user_id != auth()->user()->id){
                return redirect()->back();
            }else{
                $userNotes = Notes::where('user_id',$user_id)->first();
                return view('general.notes')->with(compact('page','user_id','userNotes'));
       
            }
    }
   
    public function uploadNote(Request $request){
        $user_id = $request->user_id;
        $note = $request->note;
        if($user_id == auth()->user()->id){
            $gotnotes = Notes::where('user_id',$user_id)->first();
            if($gotnotes == null){
                $data = [
                    'user_id' => $user_id,
                    'content' => $note,
                ];
                Notes::Create($data);
            }else{
                Notes::where('user_id',$user_id)->where('id',$gotnotes->id)->update(['content' => $note ]);
            }
        }else{
            return redirect()->back(); 
        }
       
    }
}
