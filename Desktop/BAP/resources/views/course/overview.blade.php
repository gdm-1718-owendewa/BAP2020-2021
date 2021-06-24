
@extends('layouts.app')
@section('title','TattooEase | Cursus Overzicht')

@section('content')
<div class="general-container">
    <div class="overview-container">
        <div class="general-button-div">
            {{-- URL Routes --}}
            <div id="url-route-button">
                <p><a href="{{route('dashbord', auth()->user()->id)}}">Dashboard</a> <span>/</span> Cursussen</p>
            </div>
            @if(auth()->user()->role == 1)
            {{-- Create knop --}}
            <div id="add-button-div">
                <a href="{{route('course-create')}}">Aanmaken</a>
            </div>
            @endif
        </div>
        {{-- Overview Div --}}
        <div class="course-overview-content">
            @foreach ($courses as $course)
                <a href="{{route('course-detail', $course->id)}}" class="course-detail-link">
                    <div class="course-div">
                        <div class="logo" ><i class="fas fa-book"></i></div>
                        <div class="title" ><h4>{{$course->title}}</h4></div>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="pagination-links">
            {{$courses->links()}}
        </div>
    </div>
</div>
@endsection
