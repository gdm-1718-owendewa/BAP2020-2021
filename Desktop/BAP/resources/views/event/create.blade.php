@extends('layouts.app')
@section('title','TattooEase | Evenement Aanmaken')
@push('scripts')
    <script src="{{ asset('js/datepicker.js') }}" defer></script>
    <script src="{{asset('js/eventforms.js')}}" defer></script>
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
    <p><a href="{{route('dashbord', auth()->user()->id)}}">Dashboard</a> <span>/</span> <a href="{{route('event-overview')}}">Evenementen</a> <span>/</span> Evenement Aanmaken</p>
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
{{-- Event Formulier --}}
<div id="crud-form-div">
    {{-- Background --}}
    <div id="background-div"><h3>Creër Evenement</h3></div>
    <div id="event-create-div" style="display:none;"></div>

    {{-- Formulier --}}
    <div id="form-div">
        <form action="{{route('event-create-submit')}}" method="POST" enctype="multipart/form-data">
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
                <input type="text" name="title" id="title" required>
            </div>
            <div class="form-item">
                <label for="general-info" data-for="general-info">Algemene info (min.50)<span id="contentSpan" style="margin-left:5px;"></span></label>
                <textarea name="general-info" id="inhoud"></textarea>
            </div>
            <div class="form-item">
                <label for="capacity" data-for="capacity">Max. Aantal Deelnemers (min.1)<span id="capacitySpan" style="margin-left:5px;"></span></label>
                <input type="number" name="capacity" id="capacity" required min="1">
            </div>
            <div class="form-item">
                <label for="location" data-for="location">Locatie<span id="locationSpan" style="margin-left:5px;"></span></label>
                <input type="text" name="location" id="location" required>
            </div>
            <div class="form-item">
                <p>Evenement foto<span id="mainimageSpan" style="margin-left:5px;"></span></p>
                <label for="main-image" data-for="main-image" class="file-label"><i class="far fa-file-image"></i>Upload Foto</label>
                <input type="file" name="main-image" id="main-image" accept=".jpg,.png,.jpeg">
            </div>
            <div class="form-item clearfix" id="date-div">
                <p>Kies datum</p>
                <div>
                    <label for="date-from" data-for="date-from">Van<span id="datefromSpan" style="margin-left:5px;"></span></label>
                     <input type="text" class="datepicker-input" readonly name="date-from" id="date-from" required autocomplete="off">
                    
                </div>
                <div>
                    <label for="date-unitl" data-for="date-until">Tot<span id="dateuntilSpan" style="margin-left:5px;"></span></label>
                     <input type="text"  class="datepicker-input" readonly name="date-until" id="date-until" required autocomplete="off">
                  
                </div>
            </div>
            <div class="form-item clearfix" id="time-div">
                <p>Kies tijd</p>
                <div>
                    <label for="time-from-hour" data-for="time-from-hour">Van<span id="timefromhourSpan" style="margin-left:5px;"></span></label>
                    <select name="time-from-hour" class="time-select" id="time-from-hour" style =" background: url({{asset('images/select-arrow-down-white.png')}}) 96% / 15% no-repeat  rgb(203,0,0);">
                        @for ($i = 0; $i < 24; $i++)
                            @if ($i < 10)
                            <option value="0{{$i}}">0{{$i}}</option>
                            @else
                            <option value="{{$i}}">{{$i}}</option>
                            @endif
                        @endfor
                      </select>
                      <select name="time-from-minute" class="time-select" id="time-from-minute" style =" background: url({{asset('images/select-arrow-down-white.png')}}) 96% / 15% no-repeat rgb(203,0,0);">
                        @for ($i = 0; $i < 60; $i++)
                            @if ($i < 10)
                            <option value="0{{$i}}">0{{$i}}</option>
                            @else
                            <option value="{{$i}}">{{$i}}</option>
                            @endif
                        @endfor
                      </select> 
                </div>
                <div>
                    <label for="time-until-hour" data-for="time-until-hour">Tot<span id="timeuntilhourSpan" style="margin-left:5px;"></span></label>
                    <select name="time-until-hour" class="time-select" id="time-until-hour" style="background: url({{asset('images/select-arrow-down-white.png')}}) 96% / 15% no-repeat rgb(203,0,0)">
                        @for ($i = 0; $i < 24; $i++)
                            @if ($i < 10)
                            <option value="0{{$i}}">0{{$i}}</option>
                            @else
                            <option value="{{$i}}">{{$i}}</option>
                            @endif
                        @endfor
                      </select>
                      <select name="time-until-minute" class="time-select" id="time-until-minute" style="background: url({{asset('images/select-arrow-down-white.png')}}) 96% / 15% no-repeat rgb(203,0,0)">
                        @for ($i = 0; $i < 60; $i++)
                            @if ($i < 10)
                            <option value="0{{$i}}">0{{$i}}</option>
                            @else
                            <option value="{{$i}}">{{$i}}</option>
                            @endif
                        @endfor
                      </select> 
                </div>
               
            </div>  
            
            <div>
                <button id="submit">Aanmaken</button>
            </div>
        </form>
    </div>
</div>
@endsection

