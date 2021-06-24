@extends('layouts.app')
@section('title','TattooEase | Cursus Upload Overzicht')

@section('content')
<div id="course-detail-container">
    {{-- URL Routes --}}
    <div id="detail-button-div">
        <div class="general-button-div">
            <div id="url-route-button">
                <p><a href="{{route('dashbord', auth()->user()->id)}}">Dashboard</a> <span>/</span> <a href="{{route('course-overview')}}">Cursussen</a> <span>/</span> <a href="{{route('course-detail', $course->id)}}">{{$course->title}}</a> <span>/</span> Uploads</p>
            </div>
            @if($course->author_id == auth()->user()->id)
            <a href="{{route('course-addcontent', $course->id)}}">Voeg Content Toe</a>
        @endif
        </div>
    </div>
    <div id="course-detail-container-content">
        <div id="course-detail-container-info">
            {{-- Cursus side menu --}}
            <div id="left-side">
                <div>
                    <ul id="sidebar-upload">
                        <li><a href="{{route('course-detail', $id)}}">Overview</a></li>
                        <li><a href="{{route('course-upload-overview', $id)}}">Uploads</a></li>
                        <li><a href="{{route('course-files', $id)}}">Bestanden</a></li>
                    </ul>
                </div>
            </div>
            {{-- Cursus main menu --}}
            <div id="right-side">
                    <div id="upload-list">
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
                        {{-- Uploads lijst --}}
                        @if($upload_count > 0)
                            @foreach ($uploads as $upload)
                                <div class="upload-item">
                                    <i class="fas fa-file"></i>
                                    <a id="upload-detail-button" href="{{route('course-upload-detail', ['id' => $course->id, 'upload_id' => $upload->id])}}"><p>{{$upload->title}}</p></a>
                                    @if($course->author_id == auth()->user()->id || auth()->user()->role == 2)
                                    <a href="{{route('course-editcontent', ['id' => $course->id, 'upload_id' => $upload->id])}}" class="edit-button"><i class="far fa-edit"></i></a>
                                    <a href="{{route('course-upload-delete', ['id' => $course->id, 'upload_id' => $upload->id])}}" class="delete-button"><i class="far fa-trash-alt"></i></a>
                                @endif
                                </div>
                            @endforeach
                        @else
                            <div class="no-upload-div">
                                <h2>
                                    Er zijn geen uploads
                                </h2>
                            </div>
                        @endif
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection