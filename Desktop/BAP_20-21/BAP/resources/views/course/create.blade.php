@extends('layouts.app')
@section('title','TattooEase | Cursus Aanlaken')
@push('scripts')
    <script src="{{ asset('js/datepicker.js') }}" defer></script>
    <script src="{{asset('js/courseforms.js')}}" defer></script>
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
                editor.on('input', function (e) {
                    document.getElementById('info').dataset.length = editor.contentDocument.body.innerText.length;
                });
                
            }
       });
      </script>    
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
    <p><a href="{{route('dashbord', auth()->user()->id)}}">Dashboard</a> / <a href="{{route('course-overview')}}">Cursussen</a> <span>/</span> Cursus Aanmaken</p>
</div>
{{-- Datepicker modal --}}
<div id="datepicker-blackout"></div>
<div id="datepicker-container">
    <a id="date-picker-close-button" href="#">&#10005;</a>
    <div id="datepicker">
        <div id="year-div">
            <div href="#" name="prev-y" id="prev-y" ><i class="fas fa-backward"></i></div>
            <div id="datepicker-year"></div>	
            <div href="#" name="next-y" id="next-y" ><i class="fas fa-forward"></i></div>
        </div>
        <table id="dt-able" >
        <td class="day_val"> </td>
            </table>
        <div id="month-div">
            <div  name="prev"  id="prev-month" ><i class="fas fa-backward"></i></div>
            <div id="datepicker-month"><p id="month-title"></p></div>	
            <div  name="next" id="next-month" ><i class="fas fa-forward"></i></div>
        </div>
    </div>
</div>
{{-- Create Formulier --}}

<div id="crud-form-div">
    {{-- Achtergrond --}}
    <div id="background-div"><h3>Create Course</h3></div>
    <div id="course-create-div" style="display:none;"></div>

    {{-- Formulier --}}
    <div id="form-div">
        <form action="{{route('course-create-submit')}}" method="POST" enctype="multipart/form-data">
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
            <div class="form-item">
                <label for="title" data-for="title" >Titel<span id="titleSpan" style="margin-left:5px;"></span></label>
                <input type="text" name="title" id="title" required>
            </div>

            <div class="form-item">
                <label for="info" data-for="info" >Algemene info (min. 100)<span id="infoSpan" style="margin-left:5px;"></span></label>
                <textarea class=" form-control" name="info" id="info" ></textarea>
            </div>
            <div class="form-item">
                <label for="content" data-for="content" >Wat zal ik bijleren? (min. 100) <span id="contentSpan" style="margin-left:5px;"></span></label>
                <textarea class=" form-control" name="content" id="inhoud"></textarea>
            </div>
            {{-- <div id="date-div" class="form-item clearfix">

                <div>
                    <label for="from" data-for="from" >Van <span id="fromSpan" style="margin-left:5px;"></span></label>
                     <input type="text" class="datepicker-input" readonly name="from" id="from" required autocomplete="off">
                    
                </div>
                <div>
                    <label for="until" data-for="until" >Tot <span id="untilSpan" style="margin-left:5px;"></span></label>
                     <input type="text" class="datepicker-input" readonly name="until" id="until" required autocomplete="off">
                  
                </div>
            </div> --}}
            <div >
                <button id="submit">Aanmaken</button>
            </div>
        </form>
    </div>
</div>
@endsection

