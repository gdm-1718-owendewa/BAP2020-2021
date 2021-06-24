@extends('layouts.app')
@section('title','TattooEase | Gebruiker Notities')
@push('scripts')
    <script src="{{ asset('js/notes.js') }}" defer></script>
@endpush  
@section('content')
{{-- Notitie modal --}}
<div id="notes-modal-div">
    
</div>
<div class="general-container">
    {{-- Url routes --}}
    <div class="general-button-div">
        <div id="url-route-button">
            <p><a id="notes-return-button" href="{{route('dashbord', auth()->user()->id)}}">Dashboard</a> <span>/</span> Notities</p>
        </div>
    </div>
    {{-- Notitie container --}}
    <div id="notes-container">
        {{-- Verwijder alle notities modal --}}
        <div id="notes-delete-all-modal-div">
            <div id="delete-all-modal-content">
                <div id="delete-all-modal-message">
                    <h1>Verwijder alles</h1>
                    <p>Bent u zeker dat u alle notites wilt verwijderen? Dit kan niet ongedaan worden gemaakt.</p>
                </div>
                <div id="delete-all-modal-links">
                    <a id="confirm-delete-all" href="{{route('note-delete-all', $user_id)}}">Ja</a>
                    <a id="cancel-delete-all-notes" href="#">Nee</a>
                </div>
            </div>
        </div>
        {{-- Notitie div (tonen) --}}
        <div id="show-notes-container">
            <div id="notes-header">
                <h3>Uw Notities</h3>
                {{-- @if($note_count > 0)
                <a href="#" id="delete-all-notes-button" data-u={{$user_id}}>Verwijder alle notities</a>
                @endif --}}
            </div>
            <div id="display-notes-container">
                <textarea name="notes-field" id="notes-field" data-i="{{$user_id}}">@if($userNotes){{$userNotes->content}}@endif
                </textarea>
                {{-- @foreach($userNotes as $note)
                    <div class="note-div">
                        <div class="note-content">
                            {{$note->content}}
                        </div>
                        <div class="note-buttons">
                            @if(auth()->user()->id == $user_id)
                            <a class="edit-note-button" href="#" data-u={{$user_id}} data-n={{$note->id}} ><i class="far fa-edit"></i></a>
                            <a class="delete-note-button" href="{{route('note-delete', [ 'note_id' => $note->id , 'user_id' => $user_id] )}}"><i class="far fa-trash-alt"></i></a>     
                            @endif
                        </div>
                     
                    </div>
                @endforeach --}}
            </div>

        </div>
        {{-- Notitie div (aanmaken)
        <div id="add-notes-container">
            <h3>Maak nieuwe notitie</h3>
            <form method="POST" action="{{route('note-create-submit',$user_id)}}">
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
                @csrf
                <textarea name="notitie">
                </textarea>
                <button>Voeg notitie toe</button>
            </form>
        </div> --}}
    </div>
</div>
@endsection
