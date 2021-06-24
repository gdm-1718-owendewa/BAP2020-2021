@extends('layouts.app')
@section('title','TattooEase | Gebruiker opslag')
@section('content')
@push('scripts')

@endpush
{{-- Storage Delete Modal --}}
<div id="storage-delete-blackout"></div>
<div id="storage-delete-modal">
    <a id="storage-delete-modal-close-button" href="#">&#10005;</a>
    <div id="storage-delete-modal-content-div">
        <div id="storage-delete-modal-message-div">
            <p id="storage-delete-modal-message"></p>
        </div>
        <div id="storage-delete-modal-buttons-div">
            <a href="#" id="storage-delete-accept">Ja</a>
            <a href="#" id="storage-delete-decline">Nee</a>
        </div>  
    </div>
</div>
{{-- URL Routes --}}
<div class="general-container">
    <div class="general-button-div">
        <div id="url-route-button">
            <p><a href="{{route('dashbord', auth()->user()->id)}}">Dashboard</a> <span>/</span> Storage</p>
        </div>
    </div>
</div>
{{-- Storage container --}}
<div id="storage-container">
    {{-- File upload div --}}
    <div id="right-side">
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
            @if($errors->any())
                {{ implode('', $errors->all('<div>:message</div>')) }}
            @endif

        {{-- Upload form --}}
        <div id="storage-upload-div">
            <h1>Uw designs & video's</h1>
            <div id="design-form-div">
                @if($user->id == auth()->user()->id)
                <form action="{{route('storage-design-add', $user->id)}}" method="POST" enctype="multipart/form-data" id="design-form">
                    @csrf
                    <div>
                        <label for="design-files" class="file-label"><i class="far fa-file-image"></i>Voeg Bestand toe</label>
                        <input type="file" name="design-files[]" id="design-files" required multiple>
                    </div>
                </form> 
                
            @endif
            </div>
        </div>

        {{-- Design show div --}}
        <div id="designs-showcase">
            <div id="design-container" class="clearfix">
                @if($filesCount > 0)
                    @foreach($filenames as $file)
                        @if( $file['extension'] != 'mp4')
                            <div><a data-fancybox="gallery" href="{{asset('images/users/'.$user->id.'/designs/'.$file["filename"])}}"   ><img src=" {{asset('images/users/'.$user->id.'/designs/'.$file["filename"])}} " alt=""></a>
                                @if($user->id == auth()->user()->id)
                                <a class="delete-design-button" data-id="{{$user->id}}" data-name="{{$file['filename']}}" href="#"><i class="far fa-trash-alt"></i></a>
                                <a class="download-design-button" href="{{route('storage-download-file', ['user_id' => $user->id, 'filename' => $file["filename"], 'extension' => $file["extension"]])}}" ><i class="fas fa-download"></i></a>
                                @endif
                            </div>
                        @elseif($file['extension'] == 'mp4')
                        <div>
                            <video controls class="storage-video">
                                <source src="{{asset('images/users/'.$user->id.'/designs/'.$file["filename"])}}" type="video/mp4">
                            </video>
                            @if($user->id == auth()->user()->id)
                            <a class="delete-design-button" data-id="{{$user->id}}" data-name="{{$file['filename']}}" href="#"><i class="far fa-trash-alt"></i></a>
                            <a class="download-design-button" href="{{route('storage-download-file', ['user_id' => $user->id, 'filename' => $file["filename"], 'extension' => $file["extension"]])}}" ><i class="fas fa-download"></i></a>
                            @endif
                        </div>
                        @endif
                    @endforeach
                @else
                <div id="no-upload-div">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <p>Begin met uploaden</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
