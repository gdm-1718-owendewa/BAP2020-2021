
@extends('layouts.app')
@section('title','TattooEase | Artikel Overzicht')

@section('content')
<div class="general-container">
    <div class="overview-container">
        {{-- URL Routes --}}
        <div class="general-button-div">
            <div id="url-route-button">
                <p><a href="{{route('dashbord', auth()->user()->id)}}">Dashboard</a> <span>/</span> Artikels</p>
            </div>
            @if(auth()->user()->role == 1)
            {{-- Create buton --}}
            <div id="add-button-div">
            <a href="{{route('article-create')}}">Aanmaken</a>
            </div>
            @endif
        </div>
        {{-- Overzichts container --}}
        <div class="article-overview-content">
            {{-- Artikelen div --}}
            @foreach($articles as $article)
            <a href="{{route('article-detail', $article->id)}}">
                <div class="article-div">
                    <div class="image-div">
                        @if(isset($article->image))
                            <img src="{{asset('images/articles/'.$article->id.'/main-image/'.$article->image)}}" alt="">
                        @endif
                    </div>
                    <div class="info-div">
                        <h5>{{$article->title}}</h3>
                        <p class="test">{!!$article->smallcontent!!}...</p>

                    </div>
                    <div class="extra-div">
                        <p>{{$article->hashtag}}</p>
                        <p>{{$article->views}} <i class="far fa-eye"></i></p>
                      
                    </div>
                </div>
            </a>
            @endforeach
           
        </div>
        <div class="pagination-links">
            {{$articles->links()}}
        </div>
    </div>
</div>
@endsection
