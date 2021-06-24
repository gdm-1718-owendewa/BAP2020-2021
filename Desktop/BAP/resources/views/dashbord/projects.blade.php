@extends('layouts.app')
@section('title','TattooEase | Gebruikers projecten')

@section('content')
{{-- Delete modal voor project --}}
<div id="projects-delete-modal">
    <div id="delete-project-content">
        <div id="projects-modal-message">
        </div>
        <div id="project-modal-buttons">
            <a id="project-modal-confirm" href="#">Ja</a>
            <a id="projects-modal-decline" href="#">Nee</a>
        </div>
    </div>
</div>
{{-- URL Routes --}}
<div id="url-create-route-button">
    <p><a href="{{route('dashbord', auth()->user()->id)}}">Dashboard</a> <span> / </span>Projects</p>
</div>
{{-- Projects container --}}
<div id="user-project-container-div">
    <div id='project-list-div'>
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
        {{-- Projecten --}}
        @foreach ($projects as $project)
            <div class="project-item-div">    
                    <div class="id-div">     
                        <p>{{$project->id}}</p>
                    </div>   
                    <div class="title-div">       
                        <p>{{$project->title}}</p>
                    </div>
                    <div class="button-div">  
                        <a href="{{route($project_type.'-detail', $project->id)}}" class="detail-button"><i class="fas fa-info-circle"></i></a>
                        <a href="{{route($project_type.'-edit', $project->id)}}" class="edit-button"><i class="far fa-edit"></i></a>
                        <a href="#" class="delete-project-button" data-t="{{$project->title}}" data-l="{{'/'.$project_type.'/delete/'.$project->id}}"><i class="far fa-trash-alt"></i></a>
                    </div>     
            </div>
        @endforeach
    </div>
</div>
@endsection