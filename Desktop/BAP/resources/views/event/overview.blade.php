
@extends('layouts.app')
@section('title','TattooEase | Evenementen Overzicht')
@section('content')
<div class="general-container">
    <div class="overview-container">
        {{-- URL Routes --}}
        <div class="general-button-div">
            <div id="url-route-button">
                <p><a href="{{route('dashbord', auth()->user()->id)}}">Dashboard</a> <span>/</span> Evenementen</p>
            </div>
            @if(auth()->user()->role == 1)
            {{-- Create button --}}
            <div id="add-button-div">
            <a href="{{route('event-create')}}">Aanmaken</a>
            </div>
            @endif
        </div>
        {{-- Overview container --}}
        <div class="overview-content">
            @foreach($events as $event)
            <div class="event-overview-div">
                <a href="{{route('event-detail', $event->id)}}">
                    <div class='event-card'>
                        <div class='event-card-image-div'> 
                            <img src="{{asset(''.$event->image_path)}}" alt="">
                        </div>
                        
                        <div class='event-card-info-div'>
                            <h4>{{$event->title}}</h4>
                            <p>{!!$event->intro_desc!!}...</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <div class="pagination-links">
            {{$events->links()}}
        </div>
    </div>
</div>
@endsection
