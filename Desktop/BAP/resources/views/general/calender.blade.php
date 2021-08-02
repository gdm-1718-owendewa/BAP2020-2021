@extends('layouts.app')
@section('title','TattooEase | Kalender ')
@push('scripts')
    <script src="{{ asset('js/calendar.js') }}" defer></script>
@endpush  
@section('content')
<div id="calendar-delete-modal-div">
    <div class="calendar-full-blackout"></div>
    <div class="delete-task-modal">
        <a id="task-delete-modal-close-button" href="#">&#10005;</a> 
        <div id="task-delete-modal-content-div">
        <div id="task-delete-modal-message-div">
            <p id="task-delete-modal-message"></p>
        </div>
        <div id="task-delete-modal-buttons-div">
            <form action="" id="delete-task-form" method="post">
            @method("delete")
            @csrf
            <button id="task-delete-accept">Ja</button>
            </form>
            <a href="#" id="task-delete-decline">Nee</a>
            </div>  
        </div>
    </div>
</div>
{{-- Kalender edit task model --}}
<div id="calendar-task-edit-div">
    <div id="calendar-blackout"></div>
    <div id="calendar-modal">
        <a href="#" id="close_calendar_modal_edit_button"><i class="fas fa-times"></i></a>
         <h4>Pas taak aan</h4>
         <form method="POST" action="" id="edit-task-form">
            {{ method_field('PATCH') }}
            @if (session('fail'))
                <div class="alert alert-danger col-lg-12">
                    {{ session('fail') }}
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
            <label for="calendar-task-title">Taak naam (max 200) <span id="titleSpan" style="margin-left:5px;"></span></label>
            <input type="text" id="calendar-edit-task-title" name="task-description" required>
            <div id="time-div">
                <p>Kies tijd</p>
                <div>
                    <select name="time-from-hour" id="task-edit-hour" class="time-select" style =" background: url({{asset('images/select-arrow-down-white.png')}}) 96% / 15% no-repeat  rgb(203,0,0);">
                        @for ($i = 0; $i < 24; $i++)
                            @if ($i < 10)
                            <option value="0{{$i}}">0{{$i}}</option>
                            @else
                            <option value="{{$i}}">{{$i}}</option>
                            @endif
                        @endfor
                      </select>
                      <select name="time-from-minute" id="task-edit-minute" class="time-select" style =" background: url({{asset('images/select-arrow-down-white.png')}}) 96% / 15% no-repeat rgb(203,0,0);">
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
            <input id="edit-task-submit-button" type="submit" value="Aanpassen">
         </form>
    </div>
</div>
{{-- Kalender toevoegen taak modal --}}
<div id="calendar-task-add-div">
    <div id="calendar-blackout"></div>
    <div id="calendar-modal">
        <a href="#" id="close_calendar_modal_button"><i class="fas fa-times"></i></a>
        <h4>Voeg taak toe</h4>
        <form method="POST" action="" id="add-task-form">
            @if (session('fail'))
                <div class="alert alert-danger col-lg-12">
                    {{ session('fail') }}
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
            <label for="calendar-task-title">Taak naam (max 200)<span id="titleSpanCreate" style="margin-left:5px;"></span></label>
            <input type="text" id="calendar-task-title" name="calendar-task-title" required>
            <div id="time-div">
                <p>Kies tijd</p>
                <div>
                    <select name="time-from-hour" class="time-select" style =" background: url({{asset('images/select-arrow-down-white.png')}}) 96% / 15% no-repeat  rgb(203,0,0);">
                        @for ($i = 0; $i < 24; $i++)
                            @if ($i < 10)
                            <option value="0{{$i}}">0{{$i}}</option>
                            @else
                            <option value="{{$i}}">{{$i}}</option>
                            @endif
                        @endfor
                      </select>
                      <select name="time-from-minute" class="time-select" style =" background: url({{asset('images/select-arrow-down-white.png')}}) 96% / 15% no-repeat rgb(203,0,0);">
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
            <input id="add-task-submit-button" type="submit" value="Toevoegen">
        </form>
    </div>
</div>
{{-- Einde van Kalender toevoegen taak modal --}}

<div class="general-container">
    @if (session('succes'))
        <div class="alert alert-success col-lg-12">
            {{ session('succes') }}
        </div>
    @endif
    {{-- Url routes --}}
    <div class="general-button-div">
        <div id="url-route-button" class="general-url-route">
            <p><a id="calender-return-button" href="{{route('dashbord', auth()->user()->id)}}">Dashboard</a> <span>/</span> Kalender</p>
        </div>
    </div>
    {{-- Kalender div --}}
    <div id="calender-div">
        {{-- Kalender taak div --}}
        <div id="calender-left">
            <h3 id="month-and-year-left"></h3>
            <div id="tasks-div">  
            </div>
            <div id="events-div">  
            </div>
            {{-- Taak toevoegen --}}
            <div id="add-div">
                    <a href="#" id="add-task-open-modal-button">Voeg taak toe<i class="fas fa-plus-circle"></i></a>
            </div>
        </div>
        {{-- Kalender dagen div --}}
        <div id="calender-right">
            <div class="calender" data-u="{{auth()->user()->id}}">
                <h3 class="card-header" id="month-and-year"></h3>
                <div id="day-div">
                </div>
                <div class="calendar-buttons">
                    <button id="previous-button">Vorige</button>
                    <button id="next-button">Volgende</button>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
  
