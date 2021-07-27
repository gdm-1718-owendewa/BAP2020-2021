@extends('layouts.app')
@section('title','TattooEase | Tutorial Detail')
@section('content')
{{-- Tutorial heading --}}
<div id="tutorial-heading">
    <div id="user-image">
        @if(isset($tutorial->profile_image_route))
            <img src="{{asset('images/users/'.$tutorial->author_id.'/profile-image/'.$tutorial->profile_image_route)}}">
        @else
        <i class="fas fa-user-ninja"></i>
        @endif
    </div>
        <div id="small-info">
            <h1>{{$tutorial->title}}</h1>
            <p>Door: {{$tutorial->author}}</p>
        </div>
</div> 
<div class="general-container tutorial-detail-container-div">
    {{-- URL Routes --}}
    <div id="detail-button-div">
            <div class="general-button-div">
                <div id="url-route-button">
                    <p><a href="{{route('dashbord', auth()->user()->id)}}">Dashboard</a> <span>/</span> <a href="{{route('tutorial-overview')}}">Tutorials</a> <span>/</span>{{$tutorial->title}}</p>
                </div>
                @if($tutorial->author_id == auth()->user()->id || auth()->user()->role == 2)
                    <div id="edit-button-div">
                        <a href="{{route('tutorial-edit', $tutorial->id)}}">Pas Aan</a>
                    </div>
                @endif
            </div>
    </div>
</div>
{{-- Detail content div --}}
<div id="tutorial-content-div">
    <div id="tutorial-info">
        {!!$tutorial->description!!}
    </div>
    {{-- Mixed type  --}}
    @if($tutorial->type == 'mixed-type')
        <div id="video-div">
            @if($filesCount > 0)
                @foreach($filenames as $file)
                    @if(substr($file, strpos($file, ".") + 1) == 'mp4')
                    <div id="video-content-div">
                        <video  controls id="home-video">
                            <source src="{{asset('images/tutorials/'.$tutorial->id.'/video/'.$file)}}" frameBorder="0" type="video/mp4">
                        </video>
                    </div>
                    @endif
                @endforeach
            @endif
        </div>
        <div id="written-div">
            {!! $tutorial->content !!}
        </div>
    {{-- Video type --}}
    @elseif($tutorial->type == 'video-type')
        <div id="video-div">
            @if($filesCount > 0)
                @foreach($filenames as $file)
                    @if(substr($file, strpos($file, ".") + 1) == 'mp4')
                    <div id="video-content-div">
                        <video  controls id="home-video">
                            <source src="{{asset('images/tutorials/'.$tutorial->id.'/video/'.$file)}}" type="video/mp4">
                        </video>
                    </div>
                    @endif
                @endforeach
            @endif
        </div>
    {{-- Written type --}}
    @elseif($tutorial->type == 'written-type')
        <div id="written-div">
            {!! $tutorial->content !!}
        </div>
    @else
    @endif
</div>
@endsection

