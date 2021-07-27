@extends('layouts.app')
@section('title','TattooEase | Artikel Detail')

@section('content')
{{-- Artikel hoofding --}}
<div id="article-heading">
    <div id="user-image">
        @if(isset($article->profile_image_route))
        <img src="{{asset('images/users/'.$article->author_id.'/profile-image/'.$article->profile_image_route)}}">
        @else
        <i class="fas fa-user-ninja"></i>
        @endif
    </div>
    <div id="small-info">
        <h1>{{$article->title}}</h1>
        <p>Door: {{$article->author}}</p>
    </div>
</div>
<div id="detail-button-div">
    {{-- Url routes --}}
    <div class="general-button-div">
        <div id="url-route-button">
            <p><a href="{{route('dashbord', auth()->user()->id)}}">Dashboard</a> <span>/</span> <a href="{{route('article-overview')}}">Artikels</a> <span>/</span> {{$article->title}}</p>
        </div>
        {{-- Edit button --}}
        @if($article->author_id == auth()->user()->id || auth()->user()->role == 2)
            <div id="edit-button-div">
                <a href="{{route('article-edit', $article->id)}}">Pas Aan</a>
            </div>
        @endif
    </div>
</div>
{{-- Detail content --}}
<div id="article-detail-content-div">
    <div id="detail-main-content" class="clearfix">
        <img id="main-image" src="{{$main_file_path}}">
        <div id="article-text">
            {!!$article->content!!}
        </div>
    </div>
    {{-- Extra files div --}}
    <div id="support-file-div" class="clearfix">
        @isset($supportFileNames)
            @foreach($supportFileNames as $supportfile)
           <a data-fancybox="gallery" href='{{asset(''.$supportfile)}}'> <img src="{{$supportfile}}"></a>
            @endforeach
        @endif
    </div>
</div>

@endsection


