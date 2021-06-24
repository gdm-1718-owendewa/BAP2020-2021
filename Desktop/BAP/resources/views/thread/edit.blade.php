@extends('layouts.app')
@section('title','TattooEase | Discussie Aanpassen')
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
          height : "300",
          automatic_uploads:true,
          block_unsupported_drop: true,
          images_reuse_filename: true,
          
          init_instance_callback: function (editor) {
                $(editor.getContainer()).find('button.tox-statusbar__wordcount').click();  // if you use jQuery
                document.getElementById('info').dataset.length = editor.contentDocument.body.innerText.length;
                editor.on('input', function (e) {
                    document.getElementById('info').dataset.length = editor.contentDocument.body.innerText.length;
                });
                
            }
       });
      </script>     
@endpush
@section('content')
{{-- URL Route --}}
<div id="url-create-route-button">
    <p><a href="{{route('dashbord', auth()->user()->id)}}">Dashboard</a> <span>/</span> <a href="{{route('thread-overview')}}">Discussies</a> <span>/</span> <a href="{{route('thread-detail', $thread->id)}}"> {{$thread->title}} </a><span>/</span> Discussie Aanpassen</p>
</div>
{{-- Edit form div --}}
<div id="crud-form-div">
    {{-- Background --}}
    <div id="background-div"><h3>Pas Discussie aan</h3></div>
    <div id="thread-edit-div" style="display:none;"></div>

    {{-- Formulier --}}
    <div id="form-div">
        <form action="{{route('thread-edit-submit', $thread->id)}}" method="POST" enctype="multipart/form-data">
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
            <div class="form-item">
                <label>Discussie Vraag <span id="questionSpan" style="margin-left:5px;"></span></label>
                <input type="text" name="question" id="question" value="{{$thread->title}}">
            </div>
            <div class="form-item">
                <label>Discussie info (min 50)<span id="infoSpan" style="margin-left:5px;"></span></label>
                <textarea class=" form-control" name="info" id="info">{{$thread->question}}</textarea>
            </div>
            <div>
                <button id="submit">Pas Aan</button>
            </div>
        </form>
    </div>
</div>
@endsection

