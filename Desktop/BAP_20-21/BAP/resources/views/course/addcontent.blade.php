@extends('layouts.app')
@section('title','TattooEase | Cursus Inhoud Toevoegen')

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
    <p><a href="{{route('dashbord', auth()->user()->id)}}">Dashboard</a> <span>/</span> <a href="{{route('course-overview')}}">Cursussen</a> <span>/</span> <a href="{{route('course-detail', $course->id)}}">{{$course->title}}</a> <span>/</span> Cursus Inhoud Aanmaken</p>
</div>
{{-- Toevoegen van cursus inhoud formulier --}}
<div id="crud-form-div">
    {{-- Achtergrond --}}
    <div id="background-div"><h3>Creër Cursus Inhoud</h3></div>
    <div id="course-content-create-div" style="display:none;"></div>
    {{-- Formulier --}}
    <div id="form-div">
        <form action="{{route('course-addcontent-submit', $id)}}" method="POST" enctype="multipart/form-data">
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
            <div class="form-item" >
                <label>Titel <span id="titleSpan" style="margin-left:5px;"></span></label>
                <input type="text" name="title" id="title">
            </div>
            <div class="form-item">
                <label>Plaats hier de tekst die u wilt uploaden (min 50)<span id="contentSpan" style="margin-left:5px;"></span></label>
                <textarea class=" form-control" name="inhoud" id="inhoud"></textarea>
            </div>
            <div class="form-item">
                <p id="course-file-size">Kies cursus bestanden (jpg,png,mp4,pdf, Max 100MB)<span id="fileSpan" style="margin-left:5px;"></span></p>
                <label for="supporting-files" class="file-label"><i class="far fa-file-image"></i>Upload Bestanden</label>
                <input type="file" name="supporting-files[]" id="supporting-files" multiple accept=".jpg,.png,.jpeg,.pdf,.mp4">
                <span id="course-content-size-error" ></span>
            </div>
            <div>
                <button id="submit">Voeg content toe</button>
            </div>
        </form>
    </div>
</div>
@endsection