<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Query;
use App\Models\User;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Exceptions\InvalidOrderException;
use Illuminate\Support\Facades\Response;

class StorageController extends Controller
{
    //Storage Home
    public function index($user_id)
    {
        if(!auth()->user()){
            return redirect()->route('welcome');
        }
          $page = 'storage-index';
          $user = User::where('id',$user_id)->first();
          $user->path = public_path('images/users/'.$user_id.'/designs');
          if(file_exists($user->path)){
            $files = File::allFiles($user->path);
            $filesCount = count($files);
            $filenames = [];
            foreach($files as $file){
               $filename = pathinfo($file,PATHINFO_FILENAME).'.'.pathinfo($file,PATHINFO_EXTENSION);
               $extension = pathinfo($file,PATHINFO_EXTENSION);
               $filepath = "/images/users/".$user_id."/designs/".$filename;
               $data = [
                  'filename' => $filename,
                  'extension' => $extension,
                  'filepath' => $filepath,
               ];
               array_push($filenames, $data);
            }
            return view('storage.home')->with(compact('page','user','filenames','filesCount'));
         }else{
            $filesCount = null;
            $filenames = null ;
            return view('storage.home')->with(compact('page','user','filenames','filesCount'));
         }
    }
    //Voeg design toe
    public function adddesign(Request $request, $user_id)
    {
      if($user_id != auth()->user()->id){
         return redirect()->back();
      }
        $validator = Validator::make(
         $request->all(),[
         'design-files.*' => 'required|file|mimes:png,jpeg,svg,mp4|max:999999999'
         ]);
      if($validator->fails()) {
            return redirect()->back()->with('fail','Een bestand is niet toegevoegd omdat dit geen png,jpg,svg of mp4 is of omdat deze groter is dan 100mb');
      }
      //Voeg bestanden toe als deze bestaan
      if (isset($request['design-files'])){
         $files_array = [];
         foreach($request['design-files'] as $file){
            $filename = strtolower($file->getClientOriginalName());
            $file->move(public_path("/images/users/".$user_id."/designs"), $filename);
         }
    }
    $user = User::where('id',$user_id)->first();
    return redirect()->route('storage', $user->id);
    }
     //Verwijder bestand
     public function deletedesign(Request $request, $user_id, $file)
     {
        if($user_id != auth()->user()->id){
           return redirect()->route('profile', auth()->user()->id)->with('fail', 'Niet uw file');
        }else{
           //check of design bestaat zo ja verwijder het
          if(file_exists(public_path('images/users/'.$user_id.'/designs/'.$file))){
             $path = public_path('images/users/'.$user_id.'/designs/'.$file);
             File::delete($path);
             return redirect()->back()->with('succes','File verwijderd');
          }else{
             return redirect()->back()->with('fail', 'File bestaat niet');
          }   
        }
     }
     //Download bestand
     public function downloadPath($user_id, $filename, $extension)
     {
        if(!auth()->user()){
          return redirect()->route('welcome');
        }
        $file= public_path(). "/images/users/".$user_id."/designs/".$filename;
        $headers = array(
                  'Content-Type: application/'.$extension,
                );
    
        return Response::download($file, $filename, $headers);
 
     }
}
