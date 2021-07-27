@extends('layouts.app')
@section('title','TattooEase | Kalender Taak Aanpassen')
@section('content')
{{-- URL Routes --}}
<div id="url-create-route-button">
    <p><a href="{{route('dashbord', auth()->user()->id)}}">Dashboard</a> <span>/</span> <a href="{{route('calendar', auth()->user()->id)}}">Kalender</a> <span>/</span> Taak Aanpassen</p>
</div>
{{-- Form div --}}
<div id="crud-form-div">
    {{-- Background --}}
    <div id="background-div"><h3>Pas Taak Aan</h3></div>
    {{-- Formulier --}}
    <div id="form-div">
        <form action="{{route('calendar-edit-task-submit', ['user_id' => auth()->user()->id, 'task_id' => $task->id])}}" method="POST" enctype="multipart/form-data">
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
                <label>Taak titel</label>
                <input type="text" name="task-description" value="{{$task->description}}">
            </div>
            <div class="form-item clearfix" id="time-div">
                <p>Kies tijd</p>
                    <div>
                        <select name="time-from-hour" class="time-select" style =" background: url({{asset('images/select-arrow-down-white.png')}}) 96% / 15% no-repeat  rgb(203,0,0);
        ">
                            @for ($i = 0; $i < 24; $i++)
                            @if ($i < 10)
                            <option value="0{{$i}}" @if($i == $task->hour) selected @endif >0{{$i}}</option>
                        @else
                            <option value="{{$i}}" @if($i == $task->hour) selected @endif >{{$i}}</option>
                        @endif
                            @endfor
                        </select>
                        <select name="time-from-minute" class="time-select" style =" background: url({{asset('images/select-arrow-down-white.png')}}) 96% / 15% no-repeat rgb(203,0,0);
        ">
                            @for ($i = 0; $i < 60; $i++)
                                @if ($i < 10)
                                    <option value="0{{$i}}" @if($i == $task->minute) selected @endif >0{{$i}}</option>
                                @else
                                    <option value="{{$i}}" @if($i == $task->minute) selected @endif >{{$i}}</option>
                                @endif
                            @endfor
                        </select> 
                    </div>
            </div>
            <div>
                <button id="submit">Pas aan</button>
            </div>
        </form>
    </div>
</div>
@endsection