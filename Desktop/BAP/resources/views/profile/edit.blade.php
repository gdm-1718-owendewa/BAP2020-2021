@extends('layouts.app')
@section('title','TattooEase | Profiel Aanpassen')
@section('content')
@push('scripts')
<script src="{{ asset('js/profileforms.js') }}" defer></script>
@endpush
{{-- URL Routes --}}
<div id="url-create-route-button">
    <p><a href="{{route('profile', $user->id)}}">Profiel</a> <span>/</span> Profiel Aanpassen</p>
</div>
{{-- Form div --}}
    <div id="user-edit-form-div">
        {{-- Profile edit top part --}}
        <div id="top-form-div">
            <div id="top-form-image-div">
                @if(isset($user->image) && $user->image != null)
                    <img id="pic" src="{{asset('images/users/'.$user->id.'/profile-image/'.$user->image)}}">
                @else
                    <img id="no-pic" src="{{asset('images/machine.png')}}">
                @endif
            </div>
            <p></p>
        </div>
        {{-- Profile edit form --}}
        <div id="lower-form-div">
            <form action="{{route('profile-edit-submit', $user->id)}}" method="POST" id="user-edit-form" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
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
                <div class="control-div">
                    <p>Kies Profiel Foto<span id="imageSpan" style="margin-left:5px;"></span></p>
                    <label for="user-image" class="file-label"><i class="far fa-file-image"></i>Upload Nieuwe Foto</label>
                    <input type="file" name="user-image" id="user-image" >
                    <img id="user-edit-main-image" src="">
                </div>
                <div class="control-div">
                    <label for="user-name">Naam<span id="nameSpan" style="margin-left:5px;"></span></label>
                    <input type="text" name="user-name" id="user-name" class=" effect-input" value="{{$user->name}}">
                </div>
                <div class="control-div">
                     <label for="user-name">Email<span id="emailSpan" style="margin-left:5px;"></span></label>
                    <input type="email" name="user-email" id="user-email" class=" effect-input" value="{{$user->email}}">
                </div>
                <div class="control-div">
                     <label for="user-name">Studio naam<span id="studioSpan" style="margin-left:5px;"></span></label>
                    <input type="text" name="user-shopname" id="user-shopname" class=" effect-input" value="{{$user->shopname}}">
                </div>
                <div class="control-div">
                     <label for="user-name">Studio locatie<span id="locationSpan" style="margin-left:5px;"></span></label>
                    <input type="text" name="user-shoplocation" id="user-shoplocation" class=" effect-input" value="{{$user->shoplocation}}">
                </div>
               
                <div class="control-div">
                    <div id="submit-button-div">
                        <button id="editsubmit">Pas aan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
