@extends('layouts.app')
@section('title','TattooEase | Discussie Commentaar Aanpassen')

@push('scripts')
<script src="{{asset('js/threadforms.js')}}" defer></script>

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
    <div class="general-container">
        {{-- URL Routes --}}
        <div id="url-create-route-button">
            <p><a href="{{route('dashbord', auth()->user()->id)}}">Dashboard</a> <span>/</span> <a href="{{route('thread-overview')}}">Discussies</a> <span>/</span> <a href="{{route('thread-detail', $thread->id)}}"> {{$thread->title}} </a><span>/</span> Comment Aanpassen</p>
        </div>
        {{-- Comment edit formulier --}}
        <div id="comment-edit-form">
            <form method="post" action="{{route('edit-comment-submit', $comment->id)}}" enctype="multipart/form-data">
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
                <div class="form-group">
                    <p>Comment (min 10)</p>
                <textarea class=" form-control" name="inhoud" id="inhoud">{{$comment->content}}</textarea>
                </div>
                <button id="commenteditsubmit">Pas aan</button>
            </form>   
        </div> 
    </div>
@endsection 