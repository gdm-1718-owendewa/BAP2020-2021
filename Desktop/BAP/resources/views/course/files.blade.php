@extends('layouts.app')
@section('title','TattooEase | Cursus Bestanden Pagina')

@section('content')
<div id="course-detail-container">
    {{-- URL Routes --}}
    <div id="detail-button-div">
        <div class="general-button-div">
            <div id="url-route-button">
                <p><a href="{{route('dashbord', auth()->user()->id)}}">Dashboard</a> <span>/</span> <a href="{{route('course-overview')}}">Cursussen</a> <span>/</span> <a href="{{route('course-detail', $course->id)}}">{{$course->title}}</a><span>/</span> Files</p>
            </div>
             {{-- Add knop --}}
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
            {{-- Cursus main div --}}
            <div id="right-side">
                <div id="file-list">
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
                    {{-- Cursus bestanden --}}
                    @if(isset($supportFileNames))
                        @foreach ($supportFileNames as $supportfile)
                            <div class="file-div">

                                @if($supportfile['extension'] == 'jpg' || $supportfile['extension'] == 'png' || $supportfile['extension'] == 'jpeg')
                                    <div class="file-image-display">
                                        <img src="{{asset(''.$supportfile['filepath'])}}" >
                                    </div>
                                    <a data-fancybox="gallery" href='{{asset(''.$supportfile['filepath'])}}' class="filename"  target="_blank"><p>{{$supportfile['filename']}}</p></a>
                                    <a href="{{route('course-files-download', ['id' => $id, 'filename' => $supportfile['filename'], 'extension' => $supportfile['extension'] ])}}" class="download"><i class="fas fa-download"></i></a>
                                   

                                @elseif($supportfile['extension'] == 'mp4')
                                    <i class="fas fa-file-video"></i>
                                    <a  href="{{route('course-video', [ 'id' => $id, 'videoname' => $supportfile['filename'] ])}}" class="filename" target="_blank"><p>{{$supportfile['filename']}}</p></a>
                                    <a href="{{route('course-files-download', ['id' => $id, 'filename' => $supportfile['filename'], 'extension' => $supportfile['extension'] ])}}" class="download"><i class="fas fa-download"></i></a>
                                   

                                @elseif($supportfile['extension'] == 'pdf')
                                    <i class="fas fa-file-pdf"></i>
                                    <a href="{{route('course-generate-pdf', [ 'id' => $id, 'pdfname' => $supportfile['filename'] ])}}" class="filename" target="_blank"><p>{{$supportfile['filename']}}</p></a>
                                    <a href="{{route('course-files-download', ['id' => $id, 'filename' => $supportfile['filename'], 'extension' => $supportfile['extension'] ])}}" class="download"><i class="fas fa-download"></i></a>
                                @endif
                                @if($course->author_id == auth()->user()->id)
                                <form action="{{route('course-delete-file', ['id' => $id, 'path' => $supportfile['filename']])}}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button id="delete-upload-file" type="submit"><i class="far fa-trash-alt"></i></button>
                                </form>
                                @endif
                            </div>
                        @endforeach
                    @else
                    <div class="no-upload-div">
                        <h2>
                            Er zijn geen bestanden
                        </h2>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection