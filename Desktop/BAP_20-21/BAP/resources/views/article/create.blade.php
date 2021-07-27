

@extends('layouts.app')
@section('title','TattooEase | Artikel Aanmaken')

@push('scripts')
    
    <script src="{{asset('js/articleforms.js')}}" defer></script>
   <script>    
    tinymce.init({
      selector: '#inhoud',
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
      image_upload_url:'{{url("/article_image_upload")}}',
      
      init_instance_callback: function (editor) {
            $(editor.getContainer()).find('button.tox-statusbar__wordcount').click();  // if you use jQuery
            editor.on('input', function (e) {
                document.getElementById('inhoud').dataset.length = editor.contentDocument.body.innerText.length;
            });
            
        }
   });
  </script>    
@endpush
@push('stylesheets')

@endpush
@section('content')
{{-- Url Routes --}}
<div id="url-create-route-button">
    <p><a href="{{route('dashbord', auth()->user()->id)}}">Dashboard</a> <span>/</span> <a href="{{route('article-overview')}}">Artikels</a> <span>/</span> Artikel Aanmaken</p>
</div>
{{-- Formulier Div --}}
<div id="crud-form-div">
    {{-- Achtergrond --}}
    <div id="background-div"><h3>Creër Artikel</h3></div>
    <div id="article-create-div" style="display:none;"></div>
    {{-- Formulier --}}
    <div id="form-div">
        <form action="{{route('article-create-submit')}}" method="POST" enctype="multipart/form-data">
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
                <label for="title" data-for="title">Titel<span id="titleSpan" style="margin-left:5px;"></span></label>
                <input type="text" name="title" id="title">
            </div>
            <div class="form-item">
                <label for="inhoud" data-for="content"  >Inhoud (min. 300)<span id="contentSpan" style="margin-left:5px;"></span></label>
            </div>
            <textarea class=" form-control" name="inhoud" id="inhoud" data-length="0"></textarea>

            <div class="form-item">
                <p data-for="banner" >Kies Banner Foto<span id="bannerSpan" style="margin-left:5px;"></span></p>
                <label for="banner-image" class="file-label" ><i class="far fa-file-image"></i>Upload Foto</label>
                <input type="file" name="banner-image" id="banner-image" accept=".jpg,.png,.jpeg">
            </div>
            <div class="form-item">
                <p data-for="support">Kies Ondersteunende Bestanden (jpg, png, svg)<span style="color:red;">*</span></p>
                <label for="supporting-files" class="file-label"><i class="far fa-file-image"></i>Upload Bestanden</label>
                <input type="file" name="supporting-files[]" id="supporting-files" multiple accept=".jpg,.png,.jpeg,.svg">
            </div>
            <div>
                <button id="submit">Aanmaken</button>
            </div>
        </form>

    </div>
</div>

@endsection

