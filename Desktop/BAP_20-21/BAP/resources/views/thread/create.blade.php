@extends('layouts.app')
@section('title','TattooEase | Discussie Aanmaken')
@push('scripts')
<script src="{{asset('js/threadforms.js')}}" defer></script>
<script>    
    tinymce.init({
      selector: '#info',
      plugins: 'advlist autolink lists link  charmap print preview hr anchor pagebreak wordcount',
      toolbar: 'bold italic underline | align casechange checklist code  permanentpen table | link  ',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      branding:false,
      height : "500",
      automatic_uploads:true,
      block_unsupported_drop: true,
      images_reuse_filename: true,
      
      init_instance_callback: function (editor) {
            $(editor.getContainer()).find('button.tox-statusbar__wordcount').click();  // if you use jQuery
            editor.on('input', function (e) {
                document.getElementById('info').dataset.length = editor.contentDocument.body.innerText.length;
            });
            
        }
   });
  </script>    
@endpush
@section('content')
{{-- URL Routes --}}
<div id="url-create-route-button">
    <p><a href="{{route('dashbord', auth()->user()->id)}}">Dashboard</a> <span>/</span> <a href="{{route('thread-overview')}}">Discussies</a> <span>/</span> Discussie Aanmaken</p>
</div>
{{-- Form div --}}
<div id="crud-form-div">
    {{-- Background --}}
    <div id="background-div"><h3>Creër Discussie</h3></div>
    <div id="thread-create-div" style="display:none;"></div>

    {{-- Formulier --}}
    <div id="form-div">
        <form action="{{route('thread-create-submit')}}" method="POST" enctype="multipart/form-data">
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
            <div class="form-item">
                <label for="question" data-for="question">Discussie Vraag <span id="questionSpan" style="margin-left:5px;"></span></label>
                <input type="text" name="question" id="question">
            </div>
            <div class="form-item">
                <label for="info" data-for="info" >Discussie info (min 50)<span id="infoSpan" style="margin-left:5px;"></span></label>
                <textarea class="form-control" name="info" id="info"></textarea>
            </div>
            <div>
                <button id="submit">Aanmaken</button>
            </div>
        </form>
    </div>
</div>
@endsection

