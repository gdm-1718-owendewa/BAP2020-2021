<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Query;
use App\Models\Thread;
use App\Models\User;
use App\Models\Comment;
use App\Models\Views;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ThreadController extends Controller
{
    //Discussie overview
    public function overview()
    {
      if(!auth()->user()){
         return redirect()->route('welcome');
       }
       $page = 'overview';
       $threads = Thread::paginate(3);
       foreach($threads as $thread){
         $thread->author_info = User::where('id',$thread->author_id)->first();
         $profile_image_path = public_path('images/users/'.$thread->author_id.'/profile-image');
         //Check of user een profiel foto heeft
         if(File::exists($profile_image_path)){
            $mainFile = File::allFiles($profile_image_path);
            $profile_image_name = pathinfo($mainFile[0],PATHINFO_FILENAME).'.'.pathinfo($mainFile[0],PATHINFO_EXTENSION);
            $thread->profile_image_route = $profile_image_name;
         }
         $short_text = $thread->question;
         $thread->short_info = $short_text;
         $words = explode(" ", $thread->title);
         $acronym = "";
         foreach ($words as $w) {
            $acronym .= $w[0];
         }
         $thread->hashtag = '#' . strtoupper($acronym);
         $thread->views = count(Views::where('thread_id',$thread->id)->get());

       }
       return view('thread.overview')->with(compact('page', 'threads'));
    }
    //Discussie detail
    public function detail(Request $request, $id)
    {
      if(!auth()->user()){
         return redirect()->route('welcome');
       }
       $page = 'detail';
       $data = [
          'thread_id' =>  $id,
       ];
       Views::create($data);
       $thread =  Thread::where('id',$id)->first();
       if($thread != null){
            $thread->author_info = User::where('id', $thread->author_id);
            $profile_image_path = public_path('images/users/'.$thread->author_id.'/profile-image');
            //Check of user profiel foto bestaat
            if(File::exists($profile_image_path)){
               $mainFile = File::allFiles($profile_image_path);
               $profile_image_name = pathinfo($mainFile[0],PATHINFO_FILENAME).'.'.pathinfo($mainFile[0],PATHINFO_EXTENSION);
               $thread->profile_image_route = $profile_image_name;
            }
            //Haal comments op van de discussie
            $comments = Comment::where('thread_id',$thread->id)->get();
            foreach($comments as $comment){
               $comment->user_name = User::where('id',$comment->author_id)->first()->name;
            }
            $commentcount = count($comments);
            $url = $request->url();
            return view('thread.detail')->with(compact('page','id','thread','comments','commentcount','url'));
         }else{
            return redirect()->back();
         }
   }
   //Discussie create pagina
    public function create()
    {
      if(!auth()->user()){
         return redirect()->route('welcome');
       }
       $page = 'thread-create';
       return view('thread.create')->with(compact('page'));
    }
    //Maak discussie aan
    public function createSubmit(Request $request)
    {
         $user_id = auth()->user()->id;
         $user = User::where('id',$user_id)->first();
         $validator = Validator::make(
         $request->all(),[
            'question' => 'required|max:200',
            'info' => 'required|min:50|max:20000',
            ])->validate();
            $data = [
               'author' => $user->name,
               'author_id' => $user_id,
               'title' => ucfirst($request["question"]),
               'question' => ucfirst($request["info"]),
            ];
         Thread::create($data);
         return redirect()->route('thread-overview');

    }
    //Discussie edit pagina
    public function edit($id)
    {
      if(!auth()->user()){
         return redirect()->route('welcome');
       }
       $page = 'thread-edit';
       $thread =  Thread::where('id',$id)->first();
       if($thread !=null){
         if($thread->author_id == auth()->user()->id || auth()->user()->role == 2){
            return view('thread.edit')->with(compact('page','id', 'thread'));
         }else{
            return redirect()->back();
         }
      }else{
         return redirect()->back();
      }
    }
    //Pas discussie aan
    public function editSubmit(Request $request, $id){
      $thread =  Thread::where('id',$id)->first();
      if($thread->author_id == auth()->user()->id || auth()->user()->role == 2){

         $validator = Validator::make(
            $request->all(),[
               'question' => 'required|max:200',
               'info' => 'required|min:50|max:20000',
            ])->validate();
            $data = [
               'title' => ucfirst($request["question"]),
               'question' => ucfirst($request["info"]),
            ];
            Thread::where('id',$id)->update($data);
         return redirect()->route('thread-detail', ['id' => $id]);
      }else{
         return redirect()->back();
      }
    }
    //Verwijder discussie
    public function delete($id)
    {
       $page = 'thread-delete';
       $thread = Thread::where('id',$id)->first();
       if($thread->author_id == auth()->user()->id || auth()->user()->role == 2){
            Thread::where('id',$id)->delete();
            return redirect()->back()->with('succes', 'Discussie - '. $thread->title .' is verwijderd.');
       }else{
          return redirect()->back();
       }
    }
    //Comment op discussie
    public function comment(Request $request, $id){
      if(!auth()->user()){
         return redirect()->route('welcome');
       }
       $user_id = auth()->user()->id;
       $data = [
         'author' => auth()->user()->name,
         'author_id' => $user_id,
         'thread_id' => $id,
         'content' => $request["wysiwyg-editor"],
       ];
       Comment::create($data);
       return redirect()->back();
    }
    
}
