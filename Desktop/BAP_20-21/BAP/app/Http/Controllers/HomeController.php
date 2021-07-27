<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Query;
use App\Models\Article;
use App\Models\Course;
use App\Models\CourseSignUp;
use App\Models\CourseUpload;
use App\Models\Comment;
use App\Models\Event;
use App\Models\Thread;
use App\Models\Tutorial;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {  
        return view('home');
    }
    //Searchbar resultaten
    public function searchbarResult(Request $request){

        $articles = Article::where('title', 'like' , '%'. $request->searchterm .'%')->orWhere('author', 'like' , '%'. $request->searchterm .'%')->get();
        $events = Event::where('title', 'like' , '%'. $request->searchterm .'%')->orWhere('author', 'like' , '%'. $request->searchterm .'%')->get();
        $threads = Thread::where('title', 'like' , '%'. $request->searchterm .'%')->orWhere('author', 'like' , '%'. $request->searchterm .'%')->get();
        $tutorials = Tutorial::where('title', 'like' , '%'. $request->searchterm .'%')->orWhere('author', 'like' , '%'. $request->searchterm .'%')->get();
        $courses = Course::where('title', 'like' , '%'. $request->searchterm .'%')->orWhere('author', 'like' , '%'. $request->searchterm .'%')->get();
        $users = User::where('name', 'like' , '%'. $request->searchterm .'%')->orWhere('shopname', 'like' , '%'. $request->searchterm .'%')->get();
        $data = [
            'articles' => $articles,
            'events' => $events,
            'threads' => $threads,
            'tutorials' => $tutorials,
            'course' => $courses,
            'users' => $users,
        ];
        return response()->json($data); 
    }
    //Admin searchbar resultaten
    public function AdminSearchbarResult(Request $request){
        $articles = Article::where('title', 'like' , '%'. $request->searchterm .'%')->orWhere('author', 'like' , '%'. $request->searchterm .'%')->get();
        $events = Event::where('title', 'like' , '%'. $request->searchterm .'%')->orWhere('author', 'like' , '%'. $request->searchterm .'%')->get();
        $threads = Thread::where('title', 'like' , '%'. $request->searchterm .'%')->orWhere('author', 'like' , '%'. $request->searchterm .'%')->get();
        $tutorials = Tutorial::where('title', 'like' , '%'. $request->searchterm .'%')->orWhere('author', 'like' , '%'. $request->searchterm .'%')->get();
        $courses = Course::where('title', 'like' , '%'. $request->searchterm .'%')->orWhere('author', 'like' , '%'. $request->searchterm .'%')->get();
        $users = User::where('name', 'like' , '%'. $request->searchterm .'%')->orWhere('shopname', 'like' , '%'. $request->searchterm .'%')->get();
        $comments = Comment::where('content', 'like' , '%'. $request->searchterm .'%')->orWhere('author', 'like' , '%'. $request->searchterm .'%')->get();

        $data = [
            'articles' => $articles,
            'events' => $events,
            'threads' => $threads,
            'tutorials' => $tutorials,
            'course' => $courses,
            'users' => $users,
            'comments' => $comments,
        ];
       
        return response()->json($data); 
    }
}
