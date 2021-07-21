<?php

namespace App\Http\Controllers;
use App\Models\Query;
use App\Models\Article;
use App\Models\Course;
use App\Models\CourseSignUp;
use App\Models\CourseUpload;
use App\Models\Comment;
use App\Models\Event;
use App\Models\EventSigns;
use App\Models\Thread;
use App\Models\Tutorial;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashbordController extends Controller
{
    //Index

    public function index($id){
        $page = 'dashbord';
        $user = User::where('id',$id)->first();
        if($user->id != auth()->user()->id){
            return redirect()->back();
        }
        //Ingeschreven cursussen
        $following_courses = CourseSignUp::where('user_id',$user->id)->get();
        foreach($following_courses as $fcourse){
            $fcourse->course_info = Course::where('id',$fcourse->course_id)->first();
        }
        $following_courses_count = count($following_courses);
        //Ingeschreven evenementen
        $following_events = EventSigns::join('events', 'events.id', '=', 'event-signs.event_id')->where('event-signs.user_id' ,'=', $user->id)->orderBy('event-signs.event_id')->get();
        foreach($following_events as $fevent){
            $fevent->event_info = Event::where('id',$fevent->event_id)->first();
            $fevent->show = Carbon::parse($fevent->event_info->start_date)->gt(Carbon::now());
        }
        $following_events_count = count( $following_events);
        // Haal alles op als admin
        if($user->role == 2){
            $data = [   
                'event' => Event::all(),
                'article' => Article::all(),
                'tutorial' => Tutorial::all(),
                'thread' => Thread::all(),
                'course' => Course::all(),
                'user' => User::all(),
                'comment' => Comment::all(),
            ];
            $countdata = [
                'events' => count($data['event']),
                'articles' => count($data['article']),
                'tutorials' => count($data['tutorial']),
                'threads' => count($data['thread']),
                'courses' => count($data['course']),
                'users' => count($data['user']),
                'comments' => count($data['comment']),
            ];
            return view('admin.dashbord')->with(compact('page','id','data','countdata'));
        }else{
            //Haal uw persoonlijke projecten op als gebruiker
            if($user->role == 1){
                $data = [
                    'events' => Event::where('author_id', $user->id)->get(),
                    'articles' => Article::where('author_id', $user->id)->get(),
                    'tutorials' => Tutorial::where('author_id',$user->id)->get(),
                    'threads' => Thread::where('author_id',$user->id)->get(),
                    'courses' => Course::where('author_id', $user->id)->get(),
                ];
                $countdata = [
                    'events' => [ 'count' => count($data['events']), 'title' => 'Mijn Evenementen', 'project_type' => 'event' ],
                    'articles' => [ 'count' => count($data['articles']), 'title' => 'Mijn Artikels', 'project_type' => 'article' ],
                    'tutorials' => [ 'count' => count($data['tutorials']), 'title' => 'Mijn Tutorials', 'project_type' => 'tutorial' ],
                    'threads' => [ 'count' => count($data['threads']), 'title' => 'Mijn Discussies', 'project_type' => 'thread' ],
                    'courses' => [ 'count' => count($data['courses']), 'title' => 'Mijn Cursussen', 'project_type' => 'course' ],
                ];
                return view('dashbord.dashbord')->with(compact('page','id','user', 'countdata','following_courses', 'following_courses_count','following_events', 'following_events_count'));
            }
            return view('dashbord.dashbord')->with(compact('page','id','user','following_courses', 'following_courses_count','following_events', 'following_events_count'));
        }
    }
    //Zet dashbord bericht uit
    public function noGuideMessage($id){
        $user = User::where('id',$id)->first();
        if($user->id != auth()->user()->id){
            return redirect()->back();
        }else{
            User::where('id', $id)->update(array('guide_message' => true));
            return redirect()->route('dashbord', $user->id);
        }
    }
    //User projecten pagina
    public function myProjects($id, $project_type){
        if(auth()->user()->id != $id){
            return redirect()->back();  
        }
        $page = 'user-projects';
        $user = User::where('id',$id)->first();
        //Check of je events ophaalt
        if($project_type == 'event'){
            $projects = Event::where('author_id', $id)->get();
            if(count($projects) <= 0){
                return redirect()->route('dashbord', $id)->with('fail','U heeft geen evenementen meer maak een nieuwe aan om de knop te kunnen gebruiken');
            }else{
                return view('dashbord.projects')->with(compact('page','id','user','projects','project_type'));
            }

        }
        //Check of je artikelen ophaalt
        elseif($project_type == 'article'){
            $projects =  Article::where('author_id', $user->id)->get();
            if(count($projects) <= 0){
                return redirect()->route('dashbord', $id)->with('fail','U heeft geen artikels meer maak een nieuwe aan om de knop te kunnen gebruiken');
            }else{
                return view('dashbord.projects')->with(compact('page','id','user','projects','project_type'));
            }
            
        }
        //Check of je tutorials ophaalt
        elseif($project_type == 'tutorial'){
            $projects = Tutorial::where('author_id',$user->id)->get();
            if(count($projects) <= 0){
                return redirect()->route('dashbord', $id)->with('fail','U heeft geen tutorials meer maak een nieuwe aan om de knop te kunnen gebruiken');
            }else{
                return view('dashbord.projects')->with(compact('page','id','user','projects','project_type'));
            }
            
        }
        //Check of je cursussen ophaalt
        elseif($project_type == 'course'){
            $projects = Course::where('author_id', $id)->get();
            if(count($projects) <= 0){
                return redirect()->route('dashbord', $id)->with('fail','U heeft geen cursussen meer maak een nieuwe aan om de knop te kunnen gebruiken');
            }else{
                return view('dashbord.projects')->with(compact('page','id','user','projects','project_type'));
            }
            
        }
        //Check of je discussies ophaalt
        elseif($project_type == 'thread'){
            $projects = Thread::where('author_id',$id)->get();
            if(count($projects) <= 0){
                return redirect()->route('dashbord', $id)->with('fail','U heeft geen discussies meer maak een nieuwe aan om de knop te kunnen gebruiken');
            }else{
                return view('dashbord.projects')->with(compact('page','id','user','projects','project_type'));
            }
            
        }else{
            return redirect()->back();
        }

    }
}
