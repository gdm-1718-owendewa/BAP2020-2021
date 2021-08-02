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
        <div id="url-route-button" class="general-url-route">
            <p><a id="notes-return-button" href="{{route('dashbord', auth()->user()->id)}}">Dashboard</a> <span>/</span> Notities</p>
        </div>
    </div>
    {{-- Notitie container --}}
    <div id="notes-container">
        {{-- Notitie div (tonen) --}}
        <div id="show-notes-container">
            <div id="notes-header">
                <h3>Uw Notities</h3>
              
            </div>
            <div id="display-notes-container">
                <textarea name="notes-field" id="notes-field" data-i="{{$user_id}}">@if($userNotes){{$userNotes->content}}@endif
                </textarea>
                
            </div>

        </div>
       
    </div>
</div>
@endsection
