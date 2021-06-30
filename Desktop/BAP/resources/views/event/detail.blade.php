@extends('layouts.app')
@section('title','TattooEase | Evenement Detail Pagina')
@push('scripts')
@endpush
@section('content')
<div class="general-container">
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
    {{-- URL Routes --}}

    <div id="detail-button-div">
        <div class="general-button-div">
            <div id="url-route-button">
                <p><a href="{{route('dashbord', auth()->user()->id)}}">Dashboard</a> <span>/</span> <a href="{{route('event-overview')}}">Evenementen</a> <span>/</span> {{$event->title}}</p>
            </div>
            {{-- Edit knop --}}
            @if($event->author_id == auth()->user()->id || auth()->user()->role == 2)
                <div id="edit-button-div">
                    <a href="{{route('event-edit', $event->id)}}">Pas aan</a>
                </div>
            @else
            {{-- Schrijf je in/uit knop --}}
            <div id="edit-button-div">
                @if($signedIn != null && auth()->user()->role != 2)
                <a href="{{route('event-unsign', [ 'user_id' => auth()->user()->id, 'event_id' => $event->id])}}" id="signed-in-true-button">Schrijf je uit</a>
                @elseif($signedIn == null && auth()->user()->role != 2)
                    @if($event->freeSpaces == 0)
                        
                    @else
                        <a href="{{route('event-sign', [ 'user_id' => auth()->user()->id, 'event_id' => $event->id])}}">Schrijf je in</a>
                    @endif
                @endif
            </div>
            @endif
        </div>
    </div>
    {{-- Event detail div --}}
    <div id="event-detail-container">
        <h1>{{$event->title}}</h1>
        <p id="event-author">Door: {{$event->author}}</p>
        <div id="event-detail-content">
            <div id="left-side">
                <span id="event-description">{!!$event->description!!}</span>
                <div>
                    <p>Aantal vrije plaatsen </p>
                    @if($event->freeSpaces == 0)
                        <p>Er zij geen plaatsen meer vrij</p>
                    @else
                        <p>Er zijn nog {{$event->freeSpaces}} van de {{$event->capacity}} vrij</p>
                    @endif
                </div>
                <div>
                    <p>Loopt van </p>
                    <p>{{$event->start_date}} tot {{$event->end_date}}</p>
                </div>
                <div>
                    <p>Openingsuren</p>
                    <p>{{$event->start_time}} - {{$event->end_time}}</p>
                </div>
            </div>
            <div id="right-side">
                <iframe width='700' height='440' frameborder='0'  
                scrolling='no' marginheight='0' marginwidth='0'    
                src='https://maps.google.com/maps?&amp;hl=en&amp;q="{{$event->location}}"&amp;ie=UTF8&amp;t=&amp;z=15&amp;iwloc=B&amp;output=embed'></iframe>
            </div>
        </div>
        @auth
        @if(Auth::user()->id == $event->author_id)
        

    {{-- <button id="download-list-button">PDF DOWNLOAD</button> --}}
    <div id="signed-in-people">

            <h1>Deze personen zijn ingeschreven</h1>
            <a href="{{route('eventPDF',  ['rows' => json_encode($eventSigns)] )}}">Print PDF</a>
            <table>
                <thead>
                    <tr>
                        <th>Nummer</th>
                        <th>Email</th>
                        <th>Naam</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($eventSigns as $item)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                </tr>  
                    @endforeach
                </tbody>
            </table>
        </div>

    @endif
        @endauth
    </div>
</div>
@endsection

