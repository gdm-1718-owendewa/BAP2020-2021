@extends('layouts.app')

@section('title','TattooEase | Evenement Aanpassen')
@push('scripts')
    <script src="{{asset('js/eventforms.js')}}" defer></script> 
    <script src="{{ asset('js/datepicker.js') }}" defer></script>
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
                document.getElementById('inhoud').dataset.length = editor.contentDocument.body.innerText.length;
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
    <p><a href="{{route('dashbord', auth()->user()->id)}}">Dashboard</a> <span>/</span> <a href="{{route('event-overview')}}">Evenementen</a><span>/</span> <a href="{{route('event-detail', $event->id)}}">{{$event->title}}</a> <span>/</span> {{$event->title}} Aanpassen</p>
</div>
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
{{-- Edit form --}}
<div id="crud-form-div">
    {{-- Background --}}
    <div id="background-div"><h3>Pas Evenement Aan</h3></div>
    <div id="event-edit-div" style="display:none;"></div>

    {{-- Formulier --}}
    <div id="form-div">
        <form action="{{route('event-edit-submit', $event->id)}}" method="POST" enctype="multipart/form-data">
            {{ method_field('PATCH') }}
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
                <input type="text" name="title" value='{{$event->title}}' id="title">
            </div>
            <div class="form-item">
                <label for="general-info" data-for="general-info">Algemene info (min.50)<span id="contentSpan" style="margin-left:5px;"></span></label>
                <textarea class="form-control" name="general-info" id="inhoud">{{$event->description}}</textarea>
            </div>
            <div class="form-item">
                @if (session('fail'))
                    <div class="alert alert-danger col-lg-12">
                        {{ session('fail') }}
                    </div>
                @endif
                <label for="capacity" data-for="capacity">Max. Aantal Deelnemers (min.1)<span id="capacitySpan" style="margin-left:5px;"></span></label>
                <input type="number" name="capacity" value='{{$event->capacity}}' id="capacity">
            </div>
            <div class="form-item">
                <label for="location" data-for="location">Locatie<span id="locationSpan" style="margin-left:5px;"></span></label>
                <input type="text" name="location" value='{{$event->location}}' id="location">
            </div>
            <div class="form-item">
                <p>Verander uw foto<span id="mainimageSpan" style="margin-left:5px;"></span></p>
                <label for="main-image" class="file-label"><i class="far fa-file-image"></i>Upload Foto</label>
                <input type="file" name="main-image" id="main-image" accept=".jpg,.png,.jpeg">
                <img id="edit-event-image" src="{{asset(''.$event->main_file_path)}}">
            </div>
            <div class="form-item clearfix" id="date-div">
                <p>Kies datum</p>
                <div>
                    <label for="date-from" data-for="date-from">Van<span id="datefromSpan" style="margin-left:5px;"></span></label>
                     <input type="text" class="datepicker-input" readonly name="date-from" required value='{{$event->start_date}}' id="date-from" autocomplete="off">
                    
                </div>
                <div>
                    <label for="date-unitl" data-for="date-until">Tot<span id="dateuntilSpan" style="margin-left:5px;"></span></label>
                     <input type="text"  class="datepicker-input" readonly name="date-until" required value='{{$event->end_date}}' id="date-until" autocomplete="off">
                  
                </div>
            </div>
            <div id="time-div" class="form-item clearfix" >
                <p>Kies tijd</p>
                <div>
                    <label for="time-from-hour" data-for="time-from-hour">Van<span id="timefromhourSpan" style="margin-left:5px;"></span></label>
                    <select name="time-from-hour" class="time-select" style =" background: url({{asset('images/select-arrow-down-white.png')}}) 96% / 15% no-repeat  rgb(203,0,0);
">
                        @for ($i = 0; $i < 24; $i++)
                            @if ($i < 10)
                            <option value="0{{$i}}" @if($i == $event->start_hour) selected @endif>0{{$i}}</option>
                            @else
                            <option value="{{$i}}" @if($i == $event->start_hour) selected @endif>{{$i}}</option>
                            @endif
                        @endfor
                      </select>
                      <select name="time-from-minute" class="time-select" style =" background: url({{asset('images/select-arrow-down-white.png')}}) 96% / 15% no-repeat rgb(203,0,0);
">
                        @for ($i = 0; $i < 60; $i++)
                            @if ($i < 10)
                            <option value="0{{$i}}" @if($i == $event->start_minute) selected @endif>0{{$i}}</option>
                            @else
                            <option value="{{$i}}" @if($i == $event->start_minute) selected @endif>{{$i}}</option>
                            @endif
                        @endfor
                      </select> 
                </div>
                <div>
                    <label for="time-until-hour" data-for="time-until-hour">Tot<span id="timeuntilhourSpan" style="margin-left:5px;"></span></label>
                    <select name="time-until-hour" class="time-select" style="background: url({{asset('images/select-arrow-down-white.png')}}) 96% / 15% no-repeat rgb(203,0,0)">
                        @for ($i = 0; $i < 24; $i++)
                            @if ($i < 10)
                                <option value="0{{$i}}" @if($i == $event->end_hour) selected @endif>0{{$i}}</option>
                            @else
                                <option value="{{$i}}" @if($i == $event->end_hour) selected @endif>{{$i}}</option>
                            @endif
                        @endfor
                      </select>
                      <select name="time-until-minute" class="time-select" style="background: url({{asset('images/select-arrow-down-white.png')}}) 96% / 15% no-repeat rgb(203,0,0)">
                        @for ($i = 0; $i < 60; $i++)
                            @if ($i < 10)
                                <option value="0{{$i}}" @if($i == $event->end_minute) selected @endif>0{{$i}}</option>
                            @else
                                <option value="{{$i}}" @if($i == $event->end_minute) selected @endif>{{$i}}</option>
                            @endif
                        @endfor
                      </select> 
                </div>
               
            </div>  
            <div>
                <button id="submit">Pas Aan</button>
            </div>
        </form>
    </div>
</div>
@endsection

