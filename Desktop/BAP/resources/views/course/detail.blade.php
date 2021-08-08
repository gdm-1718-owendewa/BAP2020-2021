@extends('layouts.app')
@section('title','TattooEase | Cursus Detail')

@section('content')
<div id="course-detail-container">
    <div id="detail-button-div">
        {{-- URL Routes --}}
        <div class="general-button-div">
            <div id="url-route-button">
                <p><a href="{{route('dashbord', auth()->user()->id)}}">Dashboard</a> <span>/</span> <a href="{{route('course-overview')}}">Cursussen</a> <span>/</span> {{$course->title}}</p>
            </div>
            {{-- Edit button --}}
            @if($course->author_id == auth()->user()->id || auth()->user()->role == 2)
                <div id="edit-button-div">
                    <a href="{{route('course-edit', $course->id)}}">Pas Aan</a>
                </div>
            @endif
          
            {{-- Schrijf je in knop --}}
            @if($course->author_id != auth()->user()->id && $signed == null && auth()->user()->role != 2)
                <div id="edit-button-div">
                    <a href="{{route('course-signup', ['id' => $course->id, 'user_id' => auth()->user()->id])}}">Schrijf je in</a>
                </div>
            @endif
            {{-- Schrijf je uit knop --}}
            @if($course->author_id != auth()->user()->id && $signed != null && auth()->user()->role != 2)
                <div id="edit-button-div">
                    <a href="{{route('course-signout', ['id' => $course->id, 'user_id' => auth()->user()->id])}}">Schrijf je uit</a>
                </div>
            @endif
        </div>
    </div>
    {{-- Detail div --}}
    <div id="course-detail-container-content">
        <div id="course-detail-container-info">
            {{-- Cursus side menu --}}
            <div id="left-side">
                <div>
                    <ul id="sidebar-upload">
                        <li><a href="{{route('course-detail', $id)}}">Overview</a></li>
                        @if($signed != null || $course->author_id == auth()->user()->id || auth()->user()->role == 2)
                        <li><a href="{{route('course-upload-overview', $id)}}">Uploads</a></li>
                        <li><a href="{{route('course-files', $id)}}">Bestanden</a></li>
                        @endif
                    </ul>
                </div>
            </div>
            {{-- Cursus main div --}}
            <div id="right-side">
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
                <div id="title-div" class="title-div-detail-page">
                    <h1>{{$course->title}}</h1>
                    {{-- Add knop --}}
                   
                </div>
                <div id="course-info">
                    <h4>Waar zal deze cursus overgaan?</h4>
                    {!! $course->general_info !!}
                </div>
                <div id="course-content">
                    <h4>Wat zal u bijleren?</h4>
                    {!! $course->content !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

