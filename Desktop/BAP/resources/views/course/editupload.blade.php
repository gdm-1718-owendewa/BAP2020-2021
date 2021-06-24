@extends('layouts.app')
@section('title','TattooEase | Cursus Upload Aanpassen')
@push('scripts')
<script src="{{ asset('js/coursecontentforms.js') }}" defer></script>
<script>    
    tinymce.init({
      selector: '#inhoud',
      plugins: 'advlist autolink lists link  charmap print preview hr anchor pagebreak wordcount',
      toolbar: 'bold italic underline | align casechange checklist code  permanentpen table | link  ',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      branding:false,
      height : "300",
      automatic_uploads:true,
      block_unsupported_drop: true,
      images_reuse_filename: true,
      
      init_instance_callback: function (editor) {
            $(editor.getContainer()).find('button.tox-statusbar__wordcount').click();  // if you use jQuery
            document.getElementById('inhoud').dataset.length = editor.contentDocument.body.innerText.length;
            editor.on('input', function (e) {
                document.getElementById('inhoud').dataset.length = editor.contentDocument.body.innerText.length;
            });
            
        }
   });
  </script>   
@endpush
@section('content')
{{-- URL Routes --}}
<div id="url-create-route-button">
    <p><a href="{{route('dashbord', auth()->user()->id)}}">Dashboard</a> <span>/</span> <a href="{{route('course-overview')}}">Cursussen</a> <span>/</span> <a href="{{route('course-detail', $course->id)}}">{{$course->title}}</a> <span>/</span> <a href="{{route('course-upload-overview', $course->id)}}">Uploads</a> <span>/</span> {{$upload->title}} Aanpassen</p>
</div>
{{-- Edit upload formulier --}}
<div id="crud-form-div">
    {{-- Background --}}
    <div id="background-div"><h3>Pas Cursus Inhoud Aan</h3></div>
    <div id="course-content-edit-div" style="display:none;"></div>
    {{-- Formulier --}}
    <div id="form-div">
        <form action="{{route('course-editcontent-submit', ['id' => $id, 'upload_id' => $upload->id])}}" method="POST" enctype="multipart/form-data">
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
            <p>Uw bent niet verplicht om teksten en bestanden tergelijk te uploaden u kan dit ook apart doen door gewoon de velden in te vullen van wat u wenst te uploaden maar een titel is wel vereist als u een tekst wilt invoegen.</p>
            @csrf
            <div class="form-item">
                <label>Titel <span id="titleSpan" style="margin-left:5px;"></span></label>
                <input type="text" name="title" id="title" value="{{$upload->title}}" required>
            </div>
            <div class="form-item">
                <label>Plaats hier de tekst die u wilt uploaden (min 50)<span id="contentSpan" style="margin-left:5px;"></span></label>
                <textarea class="form-control" name="inhoud" id="inhoud">{!!$upload->content!!}</textarea>
            </div>
            <div>
                <button id="submit">Pas Content Aan</button>
            </div>
        </form>
    </div>
</div>
@endsection