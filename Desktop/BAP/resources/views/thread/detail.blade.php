@extends('layouts.app')
@section('title','TattooEase | Discussie Detail')
@push('scripts')
<script src="{{asset('js/threadforms.js')}}" defer></script>

<script>    
    tinymce.init({
      selector: '#comment',
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
                document.getElementById('comment').dataset.length = editor.contentDocument.body.innerText.length;
            });
            
        }
   });
  </script>  
@endpush
@section('content')
{{-- Thread heading --}}
<div id="thread-heading">
    <div id="user-image">
        @if(isset($thread->profile_image_route))
        <img src="{{asset('images/users/'.$thread->author_id.'/profile-image/'.$thread->profile_image_route)}}">
        @else
        <i class="fas fa-user-ninja"></i>
        @endif
    </div>
    <div id="small-info">
        <h1>{{$thread->title}}</h1>
        <p>Door: {{$thread->author}}</p>
    </div>
</div>
<div class="thread-general-container">
    <div id="detail-button-div">
        {{-- URL Routes --}}
        <div class="general-button-div">
            <div id="url-route-button">
                <p><a href="{{route('dashbord', auth()->user()->id)}}">Dashboard</a> <span>/</span> <a href="{{route('thread-overview')}}">Discussies</a> <span>/</span> {{$thread->title}}</p>
            </div>
            @if($thread->author_id == auth()->user()->id || auth()->user()->role == 2)
                <div id="edit-button-div">
                    <a href="{{route('thread-edit', $thread->id)}}">Pas Aan</a>
                </div>
            @endif
        </div>
    </div>
    {{-- Discussie detail container --}}
    <div id="detail-thread-container" >
        <div class="thread-blackout-div"></div>
        <div class="delete-comment-modal">
            <a id="comment-delete-modal-close-button" href="#">&#10005;</a> 
            <div id="comment-delete-modal-content-div">
            <div id="comment-delete-modal-message-div">
                <p id="comment-delete-modal-message"></p>
            </div>
            <div id="comment-delete-modal-buttons-div">
                <form action="" method="post" id="delete-comment-form">
                    @method('delete');
                    @csrf
                    <button id="comment-delete-accept">Ja</button>
                </form>
                <a href="#" id="comment-delete-decline">Nee</a>
                </div>  
            </div>`
        </div>
        <div id="thread-question-info">
            <p>{!!$thread->question!!}</p>
        </div>
    </div>
    {{-- Discussie commentaar div --}}
    <div id="thread-comment-div">
        <h3>{{$commentcount}} @if($commentcount == 1)Comment @else Comments @endif</h3>
        @foreach($comments as $comment)
            <div class="comment">
                <div id="content">
                    {!!$comment->content!!}
                    <p id="comment-user">Door: {{$comment->user_name}}</p>
                </div>
                @if($comment->author_id == Auth::user()->id || auth()->user()->role == 2)
                    <div id="buttons">
                        <a href="{{route('edit-comment', $comment->id)}}" id="edit-button"><i class="far fa-edit"></i></a>
                        <a href="#" id="delete-button" data-i="{{$comment->id}}" {{--data-content="{!!$comment->content!!}" --}} class="comment-delete-button"><i class="far fa-trash-alt"></i></a>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
    {{-- Commentform --}}
    <div id="comment-form-div">        
        <form method="POST" action="{{route('thread-comment-submit', $thread->id)}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="wysiwyg editor">Comment (min 10)<span id="commentSpan" style="margin-left:5px;"></span></label>
                <textarea name="wysiwyg-editor" id="comment"></textarea>
            </div>
            <button id="commentsubmit">Comment </button>
        </form>    
    </div>
</div>
@endsection



