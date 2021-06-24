<?php

namespace App\Http\Controllers;
use App\Models\Query;
use App\Models\Thread;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //Comment edit pagina
    public function edit( Request $request, $id){
        $page="comment-edit";
        $comment = Comment::where('id',$id)->first();
        $thread = Thread::where('id',$comment->thread_id)->first();
        if($comment->author_id == auth()->user()->id || auth()->user()->role == 2){
           return view('comment.edit')->with(compact('id','comment','page','thread'));   
        }else{
            return redirect()->back();
        }
       
    }
    //Edit submit
    public function editSubmit( Request $request, $id){
        $comment = Comment::where('id',$id)->first();
        $thread = Thread::where('id',$comment->thread_id)->first();
        if($comment->author_id == auth()->user()->id || auth()->user()->role == 2){
            $validator = Validator::make(
                $request->all(),[
                'inhoud' => 'required',
                ])->validate();
            $data = [
                'content' => ucfirst($request["inhoud"]),
            ];
            $comment->update($data);
            return redirect()->route('thread-detail', ['id' => $thread->id]);

            }else{
                return redirect()->back();
            }
    }
    //Verwijder comment
    public function delete($id){
        $comment = Comment::where('id',$id)->first();
        if($comment->author_id == auth()->user()->id || auth()->user()->role == 2){
            $comment->delete();
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }
}
