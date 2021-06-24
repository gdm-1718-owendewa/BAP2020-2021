<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

use App\Models\Query;
use App\Models\Tutorial;
use App\Models\User;

class TutorialController extends Controller
{
    //Tutorial overview
    public function overview(Request $request)
    {
      if(!auth()->user()){
         return redirect()->route('welcome');
       }
       if($request->has('type')){
         $type = $request->type.'-type';
         $tutorials = Tutorial::where('type', $type)->paginate(6); 
         $filter = $request->type;
       }else{
         $tutorials = Tutorial::paginate(6);
       }
       $page = 'overview';
      
       //Haal extra turial info op
       foreach($tutorials as $tutorial){
         $image_path = "images/tutorials/".$tutorial->id."/thumbnail/";
         $mainFile = File::allFiles($image_path);
         $tutorial->image_path = "images/tutorials/".$tutorial->id."/thumbnail/".pathinfo($mainFile[0],PATHINFO_FILENAME).'.'.pathinfo($mainFile[0],PATHINFO_EXTENSION);
         $tutorial->intro_desc = substr($tutorial->description, 0, 25);
      }
      if($request->has('type')){
         return view('tutorial.overview')->with(compact('page','tutorials','filter'));

      }else{
         return view('tutorial.overview')->with(compact('page','tutorials'));

      }
    }
    //Tutorial detail pagina
    public function detail($id)
    {
      if(!auth()->user()){
         return redirect()->route('welcome');
       }
       $page = 'detail';
       $tutorial = Tutorial::where('id',$id)->first();
       if($tutorial != null){
            //Haal extra turial info op
            $tutorial->author_info = User::where('id', $tutorial->author_id);
            $profile_image_path = public_path('images/users/'.$tutorial->author_id.'/profile-image');
            //Check of user profiel foto bestaat
            if(File::exists($profile_image_path)){
               $mainFile = File::allFiles($profile_image_path);
               $profile_image_name = pathinfo($mainFile[0],PATHINFO_FILENAME).'.'.pathinfo($mainFile[0],PATHINFO_EXTENSION);
               $tutorial->profile_image_route = $profile_image_name;
            }
            $tutorial->path = public_path('images/tutorials/'.$tutorial->id.'/video/');
            //Check of tutorial een video heeft
            if(file_exists( $tutorial->path)){
               $files = File::allFiles($tutorial->path);
               $filesCount = count($files);
               $filenames = [];
               foreach($files as $file){
                  $fileinfo= basename($file);
               array_push($filenames, $fileinfo);
               }
               return view('tutorial.detail')->with(compact('page','id','tutorial','filenames','filesCount'));
            };
            
            return view('tutorial.detail')->with(compact('page','id','tutorial'));
       }else{
          return redirect()->back();
       } 
    }
    //Tutorial create pagina
    public function create()
    {
      if(!auth()->user()){
         return redirect()->route('welcome');
       }
       $page = 'tutorial-create';
       $user_id = auth()->user()->id;
       $storage_path = public_path('images/users/'.$user_id.'/designs');
       if (file_exists($storage_path)) { 
         $designs = File::allFiles($storage_path);
         $files = [];
         foreach($designs as $design){
            $file = [
               'path' => 'images/users/'.$user_id.'/designs/',
               'filename' => pathinfo($design,PATHINFO_FILENAME),
               'extension' => pathinfo($design,PATHINFO_EXTENSION),
            ];
            array_push($files, $file);
         }
      }else{
         $files = [];
      }
      return view('tutorial.create')->with(compact('page', 'files'));

    }
    //Maak tutorial aan
    public function createSubmit(Request $request)
    {
       
      if(!auth()->user()){
         return redirect()->route('welcome');
       }
         $validator = Validator::make(
            $request->all(),[
            'title' => 'required|max:200',
            'description' => 'required|min:100',
            'content-type' => 'required',
            'main-video' => 'file|mimes:mp4|max:100000000',
            'video-thumbnail' => 'required|file|mimes:jpeg,png,svg,tiff',
            ])->validate();
         
         $tut_type = $request["content-type"];
         //Check of tutorial een written type is
         if($tut_type == "written-type"){
            $validator = Validator::make(
               $request->all(),[
                  'wysiwyg-editor' => 'min:100',
                  ])->validate();
               
            $data = [
               'author' => auth()->user()->name,
               'author_id' => auth()->user()->id,
               'title' => ucfirst($request['title']),
               'description' => ucfirst($request['description']),
               'content' => $request['wysiwyg-editor'],
               'type' =>  $request["content-type"] ,
            ]; 
            Tutorial::create($data);
            $uploaded_tutorial = Tutorial::orderBy('id', 'desc')->first();
            //Haal thumbnail op en upload deze naar de server
            $thumbnail_name = $request["video-thumbnail"]->getClientOriginalName();
            $request["video-thumbnail"]->move(public_path("/images/tutorials/".$uploaded_tutorial->id."/thumbnail"), $thumbnail_name);
            return redirect()->route('tutorial-detail', $uploaded_tutorial->id);
         }
         //Check of tutorial een video type is
         else if($tut_type == "video-type"){
            $validator = Validator::make(
               $request->all(),[
                  'main-video' => 'required',
                  ])->validate();
            $data = [
               'author' => auth()->user()->name,
               'author_id' => auth()->user()->id,
               'title' => ucfirst($request['title']),
               'description' => ucfirst($request['description']),
               'content' => null,
               'type' =>  $request["content-type"] ,
            ]; 
            Tutorial::create($data);
            $uploaded_tutorial = Tutorial::orderBy('id', 'desc')->first();
            //Haal video op en upload deze naar de server
            $filename = $request["main-video"]->getClientOriginalName();
            $request["main-video"]->move(public_path("/images/tutorials/".$uploaded_tutorial->id."/video"), $filename);
            //Haal thumbnail op en upload deze naar de server
             $thumbnail_name = $request["video-thumbnail"]->getClientOriginalName();
            $request["video-thumbnail"]->move(public_path("/images/tutorials/".$uploaded_tutorial->id."/thumbnail"), $thumbnail_name);
            return redirect()->route('tutorial-detail', $uploaded_tutorial->id);
         }
         //Check of tutorial een mixed type is
         else if($tut_type == "mixed-type"){
            $validator = Validator::make(
               $request->all(),[
                  'wysiwyg-editor' => 'min:100',
                  'main-video' => 'required',
                  ])->validate();
            //Check of een video is geupload
           if(!isset($request['main-video'])){
               return redirect()->back()->with('fail', 'U moet een video toevoegen als u dit een mixed tutorial wilt maken');
            }
            $data = [
               'author' => auth()->user()->name,
               'author_id' => auth()->user()->id,
               'title' => ucfirst($request['title']),
               'description' => ucfirst($request['description']),
               'content' => $request['wysiwyg-editor'],
               'type' =>  $request["content-type"] ,
            ]; 
            Tutorial::create($data);
            $uploaded_tutorial = Tutorial::orderBy('id', 'desc')->first();
            //Haal video op en upload deze naar de server
            $filename = $request["main-video"]->getClientOriginalName();
            $request["main-video"]->move(public_path("/images/tutorials/".$uploaded_tutorial->id."/video"), $filename);
            //Haal thumbnail op en upload deze naar de server
            $thumbnail_name = $request["video-thumbnail"]->getClientOriginalName();
            $request["video-thumbnail"]->move(public_path("/images/tutorials/".$uploaded_tutorial->id."/thumbnail"), $thumbnail_name);
            return redirect()->route('tutorial-detail', $uploaded_tutorial->id);
         }else{
            return redirect()->back()->with('fail', 'U moet een type aanduiden');
         }
    }
    //Edit pagina van tutorial
    public function edit($id)
    {
      if(!auth()->user()){
         return redirect()->route('welcome');
       }
       $page = 'tutorial-edit';
       $tutorial = Tutorial::where('id',$id)->first();
       $user_id = auth()->user()->id;
       $storage_path = public_path('images/users/'.$user_id.'/designs');
       if (file_exists($storage_path)) { 
         $designs = File::allFiles($storage_path);
         $files = [];
         foreach($designs as $design){
            $file = [
               'path' => 'images/users/'.$user_id.'/designs/',
               'filename' => pathinfo($design,PATHINFO_FILENAME),
               'extension' => pathinfo($design,PATHINFO_EXTENSION),
            ];
            array_push($files, $file);
         }
      }else{
         $files = [];
      }
       if($tutorial !=null){
         if($tutorial->author_id == auth()->user()->id || auth()->user()->role == 2){
            //Haal thumbnail op
            $mainpath = public_path("images/tutorials/".$id."/thumbnail");
            $mainFile = File::allFiles($mainpath);
            $mainFilename = pathinfo($mainFile[0],PATHINFO_FILENAME).'.'.pathinfo($mainFile[0],PATHINFO_EXTENSION);
            $main_file_path = "/images/tutorials/".$id."/thumbnail/".$mainFilename;
            $tutorial->main_file_path = $main_file_path;
            //Haal video op
            if($tutorial->type != 'written-type'){
               $videopath = public_path("images/tutorials/".$id."/video");
               $mainVideoFile = File::allFiles($videopath);
               $mainVideoFilename = pathinfo($mainVideoFile[0],PATHINFO_FILENAME).'.'.pathinfo($mainVideoFile[0],PATHINFO_EXTENSION);
               $main_videofile_path = "/images/tutorials/".$id."/video/".$mainVideoFilename;
               $tutorial->main_videofile_path = $main_videofile_path;
            }
            return view('tutorial.edit')->with(compact('page','id','tutorial','files'));
         }else{
            return redirect()->back();
         }
       }else{
          return redirect()->back();
       }
      
    }
    //Pas tutorial aan
    public function editSubmit(Request $request, $id)
    {
      if(!auth()->user()){
         return redirect()->route('welcome');
       }
       $tutorial =  Tutorial::findOrFail($id);
       if($tutorial->author_id == auth()->user()->id || auth()->user()->role == 2){
         $validator = Validator::make(
            $request->all(),[
            'title' => 'required|max:200',
            'description' => 'required|min:100',
            'content-type' => 'required',
            'main-video' => 'file|mimes:mp4|max:100000000',
            'video-thumbnail' => 'file|mimes:jpeg,png,svg,tiff',
            ])->validate();
         $page = 'tutorial-edit-submit';
         $tut_type = $request["content-type"];
         //Check of tutorial written type is
         if($tut_type == "written-type"){
            $validator = Validator::make(
               $request->all(),[
                  'wysiwyg-editor' => 'min:100',
                  ])->validate();
               $data = [
                  'title' => ucfirst($request['title']),
                  'description' => ucfirst($request['description']),
                  'content' => $request['wysiwyg-editor'],
                  'type' =>  $request["content-type"] ,
               ]; 
               $tutorial->update($data);
            //Check of een thumbnail is geupload
            if(isset($request['video-thumbnail'])){
               $mainpath = public_path("images/tutorials/".$id."/thumbnail");
               //Check of er al een thumbnail is zo ja verwijder deze
               if(File::exists($mainpath)){
                  $mainFile = File::allFiles($mainpath);
                  File::delete($mainFile);
               }
               $tutorial_main_image = \Request::file('video-thumbnail');
               $tutorial_main_image_name = $tutorial_main_image->getClientOriginalName();
               $tutorial_main_image->move(public_path("/images/tutorials/".$id."/thumbnail"), $tutorial_main_image_name);
            } 
            return redirect()->route('tutorial-detail', $id);
         }
         //Check of tutorial video type is
         else if($tut_type == "video-type"){
               $videocheckpath = public_path("images/tutorials/".$id."/video");
               //Check of een video is toegevoegd
               if(!isset($request['main-video']) && !File::exists($videocheckpath)){
                  return redirect()->back()->with('fail', 'U moet een video toevoegen als u dit een video tutorial wilt maken');
               }
               $data = [
                  'title' => ucfirst($request['title']),
                  'description' => ucfirst($request['description']),
                  'content' => $request['wysiwyg-editor'],
                  'type' =>  $request["content-type"] ,
               ]; 
               $tutorial->update($data);               //Check of een thumbnail is geupload
               if(isset($request['video-thumbnail'])){
                  $mainpath = public_path("images/tutorials/".$id."/thumbnail");
                  //Check of er al een thumbnail is zo ja verwijder deze
                  if(File::exists($mainpath)){
                     $mainFile = File::allFiles($mainpath);
                     File::delete($mainFile);
                  }
                  $tutorial_main_image = \Request::file('video-thumbnail');
                  $tutorial_main_image_name = $tutorial_main_image->getClientOriginalName();
                  $tutorial_main_image->move(public_path("/images/tutorials/".$id."/thumbnail"), $tutorial_main_image_name);
                  }
               //Verwijder oude video en voeg nieuwe toe
               if(isset($request['main-video'])){
                  $mainpath = public_path("images/tutorials/".$id."/video");
                  if(File::exists($mainpath)){
                     $mainFile = File::allFiles($mainpath);
                     File::delete($mainFile);
                  }
                  $tutorial_main_image = \Request::file('main-video');
                  $tutorial_main_image_name = $tutorial_main_image->getClientOriginalName();
                  $tutorial_main_image->move(public_path("/images/tutorials/".$id."/video"), $tutorial_main_image_name);
               } 
            return redirect()->route('tutorial-detail', $id);
         }
         //Check of tutorial mixed type is
         else if($tut_type == "mixed-type"){
            $validator = Validator::make(
               $request->all(),[
                  'wysiwyg-editor' => 'min:100',
                  ])->validate();
            $videocheckpath = public_path("images/tutorials/".$id."/video");
            //Check of een video is toegevoegd
            if(!isset($request['main-video']) && !File::exists($videocheckpath) ){
               return redirect()->back()->with('fail', 'U moet een video toevoegen als u dit een mixed tutorial wilt maken');
            }
            $data = [
               'title' => ucfirst($request['title']),
               'description' => ucfirst($request['description']),
               'content' => $request['wysiwyg-editor'],
               'type' =>  $request["content-type"] ,
            ]; 
            $tutorial->update($data);
            //Check of een thumbnail is geupload            
            if(isset($request['video-thumbnail'])){
            $mainpath = public_path("images/tutorials/".$id."/thumbnail");
            //Check of er al een thumbnail is zo ja verwijder deze
            if(File::exists($mainpath)){
               $mainFile = File::allFiles($mainpath);
               File::delete($mainFile);
            }
            $tutorial_main_image = \Request::file('video-thumbnail');
            $tutorial_main_image_name = $tutorial_main_image->getClientOriginalName();
            $tutorial_main_image->move(public_path("/images/tutorials/".$id."/thumbnail"), $tutorial_main_image_name);
            }
            //Verwijder oude video en voeg nieuwe toe
            if(isset($request['main-video'])){
               $mainpath = public_path("images/tutorials/".$id."/video");
               if(File::exists($mainpath)){
                  $mainFile = File::allFiles($mainpath);
                  File::delete($mainFile);
               }
               $tutorial_main_image = \Request::file('main-video');
               $tutorial_main_image_name = $tutorial_main_image->getClientOriginalName();
               $tutorial_main_image->move(public_path("/images/tutorials/".$id."/video"), $tutorial_main_image_name);
            }  
            return redirect()->route('tutorial-detail', $id);
         }else{
            return redirect()->back()->with('fail', 'U moet een type aanduiden');
         }
      }else{
         return redirect()->back();
      }
    }
    //Verwijder tutorial
    public function delete($id)
    {
       $page = 'tutorial-delete';
       $tutorial = Tutorial::where('id',$id)->first();
         if($tutorial){
            if($tutorial->author_id == auth()->user()->id || auth()->user()->role == 2){
               $tutorialdirpath = public_path("images/tutorials/".$id);
               if(File::exists($tutorialdirpath)){
                  Tutorial::where('id',$id)->delete();
                  File::deleteDirectory($tutorialdirpath);
                  return redirect()->back()->with('succes', 'Tutorial - '. $tutorial->title .' is verwijderd.');
               }else{
                  return redirect()->back();   
               }
            }
         }else{
            return redirect()->route('tutorial-overview');   
         }
   }
}
