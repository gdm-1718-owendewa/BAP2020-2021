
@extends('layouts.app')
@section('title','TattooEase | Discussie Overzicht')
@section('content')
<div class="general-container">
    <div class="overview-container">
        {{-- URL Routes --}}
        <div class="general-button-div">
            <div id="url-route-button">
                <p><a href="{{route('dashbord', auth()->user()->id)}}">Dashboard</a> <span>/</span> Discussies</p>
            </div>
            @if(auth()->user()->role == 1)
            {{-- Create button --}}
            <div id="add-button-div">
            <a href="{{route('thread-create')}}">Aanmaken</a>
            </div>
            @endif
        </div>
        {{-- Dicussie overview --}}
        <div class="thread-overview-content">
            @foreach($threads as $thread)
            <div class="single-thread">
                <div class="author-div">
                    @if(isset($thread->profile_image_route))
                    <img src="{{asset('images/users/'.$thread->author_id.'/profile-image/'.$thread->profile_image_route)}}" alt="">
                    @else
                        <i class="fas fa-user-ninja"></i>
                    @endif
                </div>
                <div class="info-div">
                    <a href="{{route('thread-detail', $thread->id)}}"><h3>{{$thread->title}}</h3></a>
                    <span class="thread-overview-text" >{!!$thread->short_info!!}</span>
                </div>
               <div class="extra-info-div">
                   <p>{{$thread->hashtag}}</p>
                   <p>{{$thread->views}}<i class="far fa-eye"></i></p>
               </div>
            </div>
            @endforeach
        </div>
        <div class="pagination-links">
            {{$threads->links()}}
        </div>
    </div>
</div>
@endsection
