@extends('layouts.app')
@section('title','TattooEase | Tutorial Aanmaken')
@push('scripts')
    <script src="{{ asset('js/tutorialforms.js') }}" defer></script>
    <script>    
        tinymce.init({
          selector: '#description',
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
                    document.getElementById('description').dataset.length = editor.contentDocument.body.innerText.length;
                });
                
            }
       });
      </script>    
       <script>    
        tinymce.init({
          selector: '#inhoud',
          plugins: 'advlist autolink lists link  charmap print preview hr anchor pagebreak wordcount image',
          toolbar: 'bold italic underline | align casechange checklist code  permanentpen table | link image',
          toolbar_mode: 'floating',
          tinycomments_mode: 'embedded',
          tinycomments_author: 'Author name',
          branding:false,
          height : "300",
          automatic_uploads:true,
          block_unsupported_drop: true,
          images_reuse_filename: true,
          relative_urls : false,
          remove_script_host : false,
          document_base_url : "http://127.0.0.1:8000",

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
    <p><a href="{{route('dashbord', auth()->user()->id)}}">Dashboard</a> <span>/</span> <a href="{{route('tutorial-overview')}}">Tutorials</a> <span>/</span> Tutorial Aanmaken</p>
</div>
{{-- Create form --}}
<div id="crud-form-div">
    {{-- Background --}}
    <div id="background-div"><h3>Creëer Tutorial</h3></div>
    <div id="tutorial-create-div" style="display:none;"></div>

    {{-- Formulier --}}
    <div id="form-div">
        <form action="{{route('tutorial-create-submit')}}" method="POST" enctype="multipart/form-data">
            @csrf
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

            <div class="">  
                <label for="title" data-for="title">Titel<span id="titleSpan" style="margin-left:5px;"></span></label>
                <input type="text" name="title" id="title" value="{{old('title')}}" required>
            </div>
            <div class="form-item" id="tutorial-thumbnail-div">
                <p>Kies thumbnail<span id="thumbnailSpan" style="margin-left:5px;"></span>  </p>
                <label for="video-thumbnail" class="file-label"><i class="far fa-file-video"></i>Upload Thumbnail</label>
                <input type="file" name="video-thumbnail" id="video-thumbnail"  value="{{old('video-thumbnail')}}" accept=".jpg,.png,.jpeg">
            </div>
            <div>
                <label for="description" data-for="description">Beschrijving (min 100)<span id="descriptionSpan" style="margin-left:5px;"></span></label>
                <textarea type="text" class=" form-control" name="description" id="description" >{{old('description')}}</textarea>
            </div>

            <div id="tutorial-content-type-div" class="clearfix">
                <p>Kies Soort Tutorial<span id="kindSpan" style="margin-left:5px;"></span></p>
                <div>
                    <input type="radio" name="content-type" id="video-type" value="video-type" required value="{{old('video-type')}}">
                    <label for="video-type">Video</label><br>
                </div>
                <div>
                    <input type="radio" name="content-type" id="written-type" value="written-type" required  value="{{old('written-type')}}">
                    <label for="written-type">Geschreven</label><br>
                </div>
                <div>
                    <input type="radio" name="content-type" id="mixed-type" value="mixed-type" required value="{{old('mixed-type')}}">
                    <label for="mixed-type">Mixed</label><br>
                </div>
            </div>
            <div class="form-item" id="tutorial-file-div">
                <p>Kies video (Max 100MB)<span id="tutvideoSpan" style="margin-left:5px;"></span></p>
                <label for="main-video" class="file-label"><i class="far fa-file-video"></i>Upload Video</label>
                <input type="file" name="main-video" id="main-video" value="{{old('main-video')}}" accept="video/*">
                <span id="tut-file-size-error"></span>
            </div>
            <div class="form-item" id="tutorial-written-div">
                <div id="dropdowndiv">
                    <label class="form-item" for="wysiwyg-editor" data-for="wysiwyg-editor">Inhoud (min 100)<span id="tutcontentSpan" style="margin-left:5px;"></span></label>
                    <p id='image-select-message'>Beste gebruiker omwille van het niet verliezen van afbeeldingen die u eventueel wilt toevoegen kan u bij onderstaande dropdown een afbeelding url kopiëren als deze in uw storage zit en deze dan plakken. Dit gebeurt door deze url te plakken in de image pop-up die getoond word als u een afbeelding wilt invoegen in het onderstaande tesktveld. Weet u niet waar uw storage is of wilt u een afbeelding toevoegen klik <a href="{{route('storage', auth()->user()->id)}}">hier</a>.</p>
                    @if(count($files) <= 0) <p>U heeft geen foto's gelieve naar bovenstaande link te gaan om foto's toe te voegen.</p>
                    @else
                    <div id="openDropdownButton"><p><i class="far fa-file-video"></i> Uw foto's</p></div>
                    @endif
                    <div id="imagedropdown" class="notactive">
                        <div id="imagedropdown-close-button"> <p>&times;</p> </div>
                        <div id="imagedropdown-results">
                        @foreach ($files as $file)
                            <img class="tutorial-dropdown-image" src="{{URL::to('/'.$file["path"].''.$file["filename"].'.'.$file["extension"].'')}}">
                        @endforeach
                        </div>
                    </div>
                </div>
                
                <textarea class="form-control" name="wysiwyg-editor" id="inhoud">{{old('wysiwyg-editor')}}</textarea>
            </div>
           
            <div>
                <button id="submit">Aanmaken</button>
            </div>
        </form>
    </div>
</div>

@endsection