@extends('layouts.app')
@section('title','TattooEase | Gebruikers Dashboard')
@push('scripts')
    <script src="{{ asset('js/dashboard.js') }}" defer></script>
@endpush  
@section('content')
<div id="dasbord-container">
    {{-- URL Routes --}}
  
   
    {{-- Sidebar --}}
    <div id="dashbord-sidebar-div">
        <a href="{{route('article-overview')}}">
            <div>
                <i class="far fa-newspaper"></i><p>Artikelen</p>
            </div> 
        </a>
        <a href="{{route('course-overview')}}"> 
            <div>
                <i class="fas fa-book"></i><p>Cursussen</p>
            </div>
        </a>
        <a href="{{route('event-overview')}}">
            <div>
                <i class="far fa-handshake"></i><p>Evenementen</p>
            </div>  
        </a>
        <a href="{{route('thread-overview')}}">
            <div>
                <i class="fas fa-bullhorn"></i><p>Discussies</p>
            </div>
        </a>
        <a href="{{route('tutorial-overview')}}"> 
        <div>    
           
           <i class="fas fa-photo-video"></i><p>Tutorials</p>
        </div>
        </a>
        <a href="{{route('calendar', $id)}}"> 
        <div>    
           
            <i class="far fa-calendar-alt"></i><p>Kalender</p>
        </div>
        </a>
        <a href="{{route('notes', $id)}}"> 
            <div>    
               
                <i class="far fa-clipboard"></i><p>Notities</p>
            </div>
        </a>
        <a href="{{route('profile', $id)}}"> 
            <div>    
               
                <i class="fas fa-user-circle"></i></i><p>Profiel</p>
            </div>
        </a>
        
  
    </div>  
    @if(auth()->user()->guide_message == 0)
        {{-- Bericht voor nieuwe gebruikers --}}
        <div id="guide-message-div">
            <a id="no-show-button" href="{{route('no-guide-message', $id)}}">&#10005;</a>
            <div id="content-div">
                <p>
                    Weet u niet zeker hoe dit platform werkt en welke functionaliteiten het heeft klik <a href="{{route('guide')}}">hier</a>, bent u op de hoogte hoe dit platform werkt en wilt u dit bericht niet meer zien klik dit venster weg.
                </p>
                
            </div>
        </div>
        @endif
    {{-- Main div --}}
    <div id="dashbord-main-div">
       
        
        {{-- Funtionaliteiten voor user met rol 1 --}}
        @if($user->role == 1)
        <div id="user-projects-div" class="clearfix">
            @if (session('fail'))
            <div class="alert alert-danger col-lg-12">
                    {{ session('fail') }}
                </div>
            @endif
            @if (session('succes'))
                <div class="alert alert-success col-lg-12">
                    {{ session('succes') }}
                </div>
            @endif
            @if(session('errors'))
            <div class="alert alert-danger col-lg-12">
                @foreach ($errors->all() as $message) 
                    <p>{{$message}}</p>
                @endforeach
            </div>
            @endif
            @foreach ($countdata as $item)
                <a @if($item['count'] > 0) href="{{route('dashbord-my-projects', ['id' => $user->id, 'project_type' => $item['project_type']])}}" class="project-link-div" @else class="project-link-div inactive-link" @endif>
                    <div class="project-content-div">
                        <div class="project-logo-div">
                            @if($item['project_type']== 'event') <i class="far fa-handshake"></i> @endif
                            @if($item['project_type']== 'article') <i class="far fa-newspaper"></i> @endif
                            @if($item['project_type']== 'thread') <i class="fas fa-bullhorn"></i> @endif
                            @if($item['project_type']== 'course') <i class="fas fa-book"></i> @endif
                            @if($item['project_type']== 'tutorial') <i class="fas fa-photo-video"></i> @endif
                        </div>
                        <div class="project-title-div">
                            <h4>{{$item['title']}}</h4>
                        </div>
                    </div>
                </a>
            @endforeach
            <a href="{{route('storage', Auth::user()->id)}}" class="project-link-div">
                <div class="project-content-div">
                    <div class="project-logo-div">
                        <i class="fas fa-box-open"></i>
                    </div>
                <div class="project-title-div">
                    <h4>Storage</h4>
                </div>
                </div>
            </a>
        </div>
        @endif
        {{-- Ingeschreven cursussen en evenementen --}}
        <div id="dashbord-signup-div" class="clearfix">
            <div id="course-div">
                <h3>Ingeschreven cursussen</h3>
                @if($following_courses_count > 0)
                    @foreach ($following_courses as $course)
                        <div class="course-item">
                            <i class="fas fa-book"></i>
                            <a href="{{route('course-detail', $course->course_id)}}">{{$course->course_info->title}}</a>
                        </div>
                    @endforeach
                @else
                        <p>U heeft geen cursussen waar u voor bent ingeschreven klik <a href="{{route('course-overview')}}">hier</a> om op zoek te gaan naar een cursus</p>
                @endif
            </div>
            <div id="event-div">
                <h3>Opkomende evenementen</h3>
                @if($following_events_count > 0)
                    @foreach ($following_events as $event)
                        @if($event->show == true)
                            <div class="event-item">
                                <p>{{$event->event_info->start_date}}</p>
                                <p class="signed-event-title"><a href="{{route('event-detail', $event->event_id)}}">{{$event->event_info->title}}</a></p>
                                <p><a class="sign-out-of-event-button" href="#" data-uid="{{auth()->user()->id}}" data-eid="{{$event->event_id}}"><i class="fas fa-sign-out-alt"></i></a></p>
                            </div>
                        @endif
                    @endforeach
                @else
                        <p>U heeft geen evenementen waar u voor bent ingeschreven klik <a href="{{route('event-overview')}}">hier</a> om op zoek te gaan naar een evenement</p>
                @endif
            </div>
        </div>
    </div>

</div>
@endsection