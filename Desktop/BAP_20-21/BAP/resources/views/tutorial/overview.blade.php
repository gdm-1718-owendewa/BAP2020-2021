
@extends('layouts.app')
@section('title','TattooEase | Tutorial Overzicht')
@section('content')
<div class="general-container">
    <div class="overview-container">
        {{-- URL Routes --}}
        <div class="general-button-div">
            <div id="url-route-button">
                <p><a href="{{route('dashbord', auth()->user()->id)}}">Dashboard</a> <span>/</span> Tutorials</p>
            </div>
            @if(auth()->user()->role == 1)
            <div id="add-button-div">
            <a href="{{route('tutorial-create')}}">Aanmaken</a>
            </div>
            @endif
        </div>
        {{-- Overview div --}}
        <div class="tutorial-overview overview-content ">
            <div id="filter-div">
                Filter: <a href="/tutorial/tutorial-overview?type=written">Geschreven</a> | <a href="/tutorial/tutorial-overview?type=video">Video</a> | <a href="/tutorial/tutorial-overview?type=mixed">Mixed</a> | <a href="/tutorial/tutorial-overview">Reset</a>

            </div>

            @foreach ($tutorials as $tutorial)
                <a href="{{route('tutorial-detail', $tutorial->id)}}" >
                    <div id="tutorial-card">
                        <div id="thumbnail-div">
                            <img src="{{asset(''.$tutorial->image_path)}}" alt="">
                        
                        </div>
                        <div id="title-div">
                            <p>{{$tutorial->title}}</p>
                        </div>
                </div></a>
            @endforeach
        </div>
        <div class="pagination-links">
            @if(isset($filter))
            {{$tutorials->appends(['type'=> $filter])->links()}}
            @else
            {{$tutorials->links()}}

            @endif
        </div>
    </div>
</div>
@endsection
