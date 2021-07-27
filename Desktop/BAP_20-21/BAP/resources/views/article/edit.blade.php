@extends('layouts.app')
@section('title','TattooEase | Artikel Edit')

@push('scripts')
<script src="{{asset('js/articleforms.js')}}" defer></script>
<script>
        tinymce.init({
          selector: '#inhoud',
          object_resizing : false,
          plugins: 'advlist autolink lists link  charmap print preview hr anchor pagebreak wordcount',
          toolbar: 'bold italic underline | align casechange checklist code  permanentpen table | link image ',
          toolbar_mode: 'floating',
          tinycomments_mode: 'embedded',
          tinycomments_author: 'Author name',
          branding:false,
          height : "500",
          automatic_uploads:true,
          block_unsupported_drop: true,
          images_reuse_filename: true,

          image_upload_url:'{{url("/article_image_upload")}}',
          
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
{{-- Url routes --}}
<div id="url-create-route-button">
    <p><a href="{{route('dashbord', auth()->user()->id)}}">Dashboard</a> <span>/</span> <a href="{{route('article-overview')}}">Artikels</a> <span>/</span> <a href="{{route('article-detail', $article->id)}}"> {{$article->title}} </a><span>/</span> {{$article->title}} Aanpassen</p>
</div>
{{-- Artikel waar supporting files aanwezig zijn --}}
@if(isset($suportpath))
    {{-- Formulier Div --}}
    <div id="article-edit-div">
        <div id="crud-form-div">
            {{-- Achtergrond --}}
            <div id="background-div"><h3>Pas Artikel Aan</h3></div>
            {{-- <div id="article-edit-div" style="display:none;"></div> --}}

            {{-- Formulier --}}
            <div id="form-div">
                <form action="{{route('article-edit-submit', $article->id)}}" method="POST" enctype="multipart/form-data">
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
                        <label>Titel<span id="titleSpan" style="margin-left:5px;"></span></label>
                        <input type="text" name="title" id="title" required value="{{$article->title}}">
                    </div>
                    <div class="form-item">
                        <label for="inhoud" data-for="content">Inhoud (min. 300)<span id="contentSpan" style="margin-left:5px;"></span></label>
                    </div>
                    <textarea class=" form-control" name="inhoud" id="inhoud">{{$article->content}}</textarea>
                    <div class="form-item">
                        <p>Pas Banner Foto aan<span id="bannerSpan" style="margin-left:5px;"></span></p>
                        <label for="banner-image" class="file-label"><i class="far fa-file-image"></i>Upload Nieuwe Foto</label>
                        <input type="file" name="banner-image" id="banner-image" accept=".jpg,.png,.jpeg">
                        <img id="article-edit-main-image" src="{{asset(''.$article->main_file_path)}}">
                    </div>
                    <div class="form-item">
                        <p>Kies Ondersteunende Bestanden (jpg, png, svg)<span style="color:red;">*</span></p>
                        <label for="supporting-files" class="file-label"><i class="far fa-file-image"></i>Upload Bestanden</label>
                        <input type="file" name="supporting-files[]" id="supporting-files" multiple accept=".jpg,.png,.jpeg,.svg">
                    </div>
                    <div>
                        <button id="submit">Pas Aan</button>
                    </div>
                </form>
            </div>
        </div>
        <div id="supporting-files-div">
            <h3>Ondersteunende Bestanden</h3>
           @foreach($supportFileNames as $file)
            <div class='article-support-image-form-div'>
                <img class="edit-support-image" src="{{asset('images/articles/'.$article->id.'/support-images/'.$file)}}" alt="">  
                <form action="{{route('article-delete-support', ['id' => $article->id, 'oldfilename' => $file])}}" method="post">
                    @method('delete')
                    @csrf
                    <button class="edit-support-image-delete"><i class="far fa-trash-alt"></i> Verwijder Bestand</a>
                </form>
           </div>
           @endforeach
        </div>
    </div>
{{-- Artikel waar supporting files niet aanwezig zijn --}}
@else
{{-- Formulier Div --}}
<div id="crud-form-div">
    {{-- Achtergrond --}}
    <div id="background-div"><h3>Pas Artikel Aan</h3></div>
    <div id="article-edit-div" style="display:none;"></div>
    {{-- Formulier --}}
    <div id="form-div">
        <form action="{{route('article-edit-submit', $article->id)}}" method="POST" enctype="multipart/form-data">
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
                <label>Titel<span id="titleSpan" style="margin-left:5px;"></span></label>
                <input type="text" name="title" id="title" required value="{{$article->title}}">
            </div>
            <div class="form-item">
                <label for="inhoud" data-for="content">Inhoud (min. 300)<span id="contentSpan" style="margin-left:5px;"></span></label>
            </div>
            <textarea class=" form-control" name="inhoud" id="inhoud">{{$article->content}}</textarea>
            <div class="form-item">
                <p>Pas Banner Foto Aan<span id="bannerSpan" style="margin-left:5px;"></span></p>
                <label for="banner-image" class="file-label"><i class="far fa-file-image"></i>Upload Nieuwe Foto</label>
                <input type="file" name="banner-image" id="banner-image" accept=".jpg,.png,.jpeg">
                <img id="article-edit-main-image" src="{{asset(''.$article->main_file_path)}}" >
            </div>
            <div class="form-item">
                <p>Kies supporting files (jpg, png, svg)<span style="color:red;">*</span></p>
                <label for="supporting-files" class="file-label"><i class="far fa-file-image"></i>Upload Bestanden</label>
                <input type="file" name="supporting-files[]" id="supporting-files" multiple accept=".jpg,.png,.jpeg,.svg">
            </div>
            <div>
                <button id="submit">Pas Aan</button>
            </div>
        </form>
    </div>
</div>
@endif
@endsection

