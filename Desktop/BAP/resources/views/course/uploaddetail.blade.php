@extends('layouts.app')
@section('title','TattooEase | Cursus Upload Details')

@section('content')
<div id="course-detail-container">
    <div id="detail-button-div">
        {{-- URL Routes --}}
        <div class="general-button-div">
            <div id="url-route-button">
                <p><a href="{{route('dashbord', auth()->user()->id)}}">Dashboard</a> <span>/</span> <a href="{{route('course-overview')}}">Cursussen</a> <span>/</span> <a href="{{route('course-detail', $course->id)}}">{{$course->title}}</a> <span>/</span> <a href="{{route('course-upload-overview', $course->id)}}">Uploads</a> <span>/</span> {{$upload->title}}</p>
            </div>
            @if($course->author_id == auth()->user()->id)
            {{-- Edit knop --}}
                <div id="edit-button-div">
                    <a href="{{route('course-editcontent', ['id' => $course->id, 'upload_id' => $upload->id] )}}">Pas Aan</a>
                </div>
            @endif
        </div>
    </div>
    {{-- Upload detail div --}}
    <div id="course-upload-detail-container-content">
        <h1>{{$upload->title}}</h1>
        {!! $upload->content !!}
    </div>
</div>
@endsection