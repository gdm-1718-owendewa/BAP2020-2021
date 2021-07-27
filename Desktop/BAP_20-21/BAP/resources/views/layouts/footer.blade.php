<footer>
    <div id="main-footer-div">
        <div id="content-main-footer-div">
            {{-- Algemene links --}}
            <div>
                <h2>Algemeen</h2>
                <ul>
                    @auth
                        <li><a href="{{route('article-overview')}}">Artikelen</a></li>
                         <li><a href="{{route('course-overview')}}">Cursussen</a></li>
                        <li><a href="{{route('thread-overview')}}">Discussies</a></li>
                        <li><a href="{{route('event-overview')}}">Evenementen</a></li>
                        <li><a href="{{route('tutorial-overview')}}">Tutorials</a></li>
                    @endauth
                    @guest
                        <li><a href="{{route('article-overview')}}">Artikelen</a></li>
                         <li><a href="{{route('course-overview')}}">Cursussen</a></li>
                        <li><a href="{{route('thread-overview')}}">Discussies</a></li>
                        <li><a href="{{route('event-overview')}}">Evenementen</a></li>
                        <li><a href="{{route('tutorial-overview')}}">Tutorials</a></li>
                    @endguest
                </ul>
            </div>
            {{-- Over ons links --}}
            <div>
                <h2>Over ons</h2>
                 <ul>
                    <li><a href="{{route('about-us')}}">Over ons</a></li>
                    <li><a href="{{route('policy')}}">Policy</a></li>
                    @auth<li><a href="{{route('guide')}}">Gids</a></li>@endauth
                    <li><a href="{{route('terms')}}">Termen</a></li>
                </ul>
            </div>
            {{-- Contact link --}}
            <div>
                <h2>Contact</h2>
                 <ul>
                    <li><a href="{{route('contact')}}">Contacteer ons</a></li>
                    
                </ul>
            </div>
            {{-- Register link --}}
            @guest
            <div>
                <h2>Word lid</h2>
                <p>Bent u een artiest die kennis wil opdoen of delen met anderen? Word dan lid van onze community.</p>
                <a id="sign-button-main-footer-div" href="{{route('register')}}">SIGN UP</a>
            </div>
            @endguest
        </div>
    </div>
    {{-- Subfooter --}}
    <div id="sub-footer-div">
        <div id="image-sub-footer-div"> <img src="{{asset('images/logo2.png')}}"></div>
        <div id="copyright-sub-footer-div">&copy; Arteveldehogeschool, opleiding Grafische en digitale media </div>
    </div>
    
</footer>