@extends('layouts.app')
@section('title','TattooEase | About Pagina')
@section('content')
    {{-- Over ons div --}}
    <div id="about-us-container">
        {{-- Over ons div content --}}
        <div id="content-about-us-container">
            
            <div id="text-content-about-us-container">
                <h3>Welkom bij Tattoo-Ease</h3>
                <h1>Over Mezelf</h1>
               <p>
                   Hallo, mijn naam is Owen De Waele en ik ben een student aan de Artevelde Hogeschool.
               
                   Ik volg de richting New Media Development en wil graag afstuderen als developer.
               
                   De reden dat ik dit platform heb ontwikkeld is omdat ik iets wou terug doen voor de tattoo communtiy en had het idee om dit ook als bachelorproef te laten dienen.
              
                   Na overleg met verschillende coaches en artiesten is het einddoel geland op een educatie platform voor tattoo artiesten.
                   Mijn focus op tattoos komt voort van een redelijk grote interesse in tattoos en hoe ik de tattoo wereld kan verbeteren.
               </p>
            </div>
            <div id="image-content-about-us-container">
                <img src="{{asset('images/me.jpg')}}">
            </div>
        </div>
    </div>
    <iframe width='100%' height='400' frameborder='0' scrolling='no' marginheight='0' marginwidth='0' src='https://maps.google.com/maps?&amp;hl=en&amp;q="België, 9000 Gent, EU"&amp;ie=UTF8&amp;t=&amp;z=15&amp;iwloc=B&amp;output=embed' id="contact-iframe"></iframe>
       
    {{-- Onze doelen div --}}
    <div id="content-our-goals-container">
        {{-- Onze doelen divs --}}
        <div id="divs-content-our-goals-container">
            <div>
                
                <h2><img src="{{asset('images/world.svg')}}">Een community vormen</h2>
                <div class="divs-text-content-our-goals-container">
                    <p>We zijn een community / educatie platform voor België en we proberen de verschillende tattoo artiesten die België te bieden heeft met elkaar te 'verbinden' zodat we deze community dichter bij elkaar kunnen brengen</p>
                </div>
            </div>
            <div>
               
                <h2> <img src="{{asset('images/user.svg')}}">Artiesten connecteren</h2>
                <div class="divs-text-content-our-goals-container">
                    <p>Een van de hoofdreden voor dit platform is zodat we verschillende artiesten met elkaar in contact kunnen brengen. Dit kan uiteraard op verschillende manieren en deze worden geïmplementeerd in dit platform</p>
                </div>
            </div>
            <div>
               
                <h2> <img src="{{asset('images/edu.svg')}}">Educatie geven aan artiesten</h2>
                <div class="divs-text-content-our-goals-container">
                    <p>Dit platform dient ook voor de educatie van alle artiesten ervaring maakt niet uit. Artiesten kunnen op dit platform artikels, evenementen, discussies , tutorials en cursussen aanmaken om dichter bij elkaar te komen en om elkaar de kennis te geven die er te rapen valt</p>
                </div>
            </div>
        </div>
    </div>
@endsection