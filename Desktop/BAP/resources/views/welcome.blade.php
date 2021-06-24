@extends('layouts.app')
@section('title','TattooEase | Home')
@section('content')
<div id="home-container">
    
    {{-- Home banner image en tekst --}}
    <div id="home-banner-div">
        <div>
            <h1>TattooEase is een educatie platform voor artiesten waar ze hun kennis met elkaar kunnen delen
            </h1>
        </div>
        <div>
            <button id="home-scroll-down"><i class="fas fa-angle-double-down"></i></button>
        </div>
    </div>
    {{-- Wat doen we div --}}
    <div id="what-we-do-div">   
        <div id="what-we-do-container">
            {{-- Verschillende punten waar dit platform voor dient --}}
            <div id="divs-content-what-we-do-container">
                <div id="our-goal-1">
                    <div class="content">
                        <div class="our-goals-background">
                        <i class="fas fa-globe-europe"></i>
                            <div class="divs-text-content-our-goals-container">
                                <h2>Een community vormen</h2>
                                <p>We zijn een community / educatie platform voor België en we proberen de verschillende tattoo artiesten die België te bieden heeft met elkaar te 'verbinden' zodat we deze community dichter bij elkaar kunnen brengen</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="our-goal-2">  
                    <div class="content"> 
                        <div class="our-goals-background">         
                        <i class="fas fa-user"></i>  
                            <div class="divs-text-content-our-goals-container">    
                                <h2>Artiesten connecteren</h2>
                                <p>Een van de hoofdreden voor dit platform is zodat we verschillende artiesten met elkaar in contact kunnen brengen. Dit kan uiteraard op verschillende manieren en deze worden geïmplementeerd in dit platform</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="our-goal-3">  
                    <div class="content">
                        <div class="our-goals-background">
                        <i class="fas fa-graduation-cap"></i>                
                            <div class="divs-text-content-our-goals-container">
                                <h2>Educatie geven aan artiesten</h2>
                                <p>Dit platform dient ook voor de educatie van alle artiesten ervaring maakt niet uit. Artiesten kunnen op dit platform artikels, evenementen, discussies , tutorials en cursussen aanmaken om dichter bij elkaar te komen en om elkaar de kennis te geven die er te rapen valt</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Home page video --}}
    {{-- <div id="home-video-div">
        <video loop="" autoplay="" id="home-video" muted="">
            <source src="{{asset('/video/home-video.mp4')}}" type="video/mp4">
        </video>
    </div> --}}
    {{-- Quote div --}}
    <div id="quote-div">
        
        <div id="quote">
            <p><span>“</span> 
                Wij als ervaren artiesten moeten er voor zorgen dat de nieuwe generatie toegang heeft tot de informatie en de vakkennis over hoe ze moeten tatoeëren dit kan gaan van een soort stijl tot de dikte van een naald. <span>”</span></p>
        </div>
     
        <div id="image">
            <img src="{{asset('images/ttanne.jpeg')}}" alt="">
            <p id="artist-name">TattooTanne</p>
            <p id="shop-name">BodyDesign</p>
        </div>
    </div>
    
    
    {{-- Event - tutorial div voor +1000 pixels --}}
    <div id="event-tut-div">
        
        <div id="event-tut-text-div">
            <div id="content-div">
                <div id="h1-div">
                    <h1>Ga en bekijk de verschillende tutorials en evenementen die gepland zijn.</h1>
                </div>
                <div id="button-div">
                    @if($user != null)
                        <a href="{{route('event-overview')}}" id="event-link">Evenementen</a>
                        <a href="{{route('tutorial-overview')}}" id="tut-link">Tutorials</a>
                    @else
                        <a href="{{route('login')}}" id="event-link">Evenementen</a>
                        <a href="{{route('login')}}" id="tut-link">Tutorials</a>
                    @endif
                </div>
            </div>
           
        </div>
        <div id="event-tut-show-div">
            <div>
                <div id="event-image-1">
                    <img src="{{asset('images/home-1.jpg')}}">
                </div>
                <div id="event-image-2">
                    <img src="{{asset('images/home-3.jpg')}}">
                </div>
            </div>
            <div>
                <div id="tut-image-1">
                    <img src="{{asset('images/home-4.jpg')}}">
                </div>
                <div id="tut-image-2">
                    <img src="{{asset('images/home-2.jpg')}}">
                </div>
            </div>
        </div>
    </div>
    {{-- Event - tutorial div voor -1000 pixels --}}
    <div id="event-tut-div-small" >
        <div>
            <h1>Ga en bekijk de verschillende tutorials en evenementen die gepland zijn</h1>
            <div id="button-div">
                @if($user != null)
                    <a href="{{route('event-overview')}}" id="event-link">Evenementen</a>
                    <a href="{{route('tutorial-overview')}}" id="tut-link">Tutorials</a>
                @else
                    <a href="{{route('login')}}" id="event-link">Evenementen</a>
                    <a href="{{route('login')}}" id="tut-link">Tutorials</a>
                @endif
            </div>
        </div>
        <div class="clearfix">
            <img src="{{asset('images/home-1.jpg')}}">
            <img src="{{asset('images/home-3.jpg')}}">
            <img src="{{asset('images/home-4.jpg')}}">
            <img src="{{asset('images/home-2.jpg')}}">
        </div>
    </div>
</div>

@endsection
