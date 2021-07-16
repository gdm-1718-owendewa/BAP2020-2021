<header>
    <div id="headerblackout-big"></div>
    {{-- Big Header +900px --}}
    <div id="header-content-big">
        <div id="header-top-div">
            <div id="header-logo">
                <a href="{{route('welcome')}}"><img src="{{asset('images/logo.png')}}"></a>
            </div>
            @auth<div id="searchbar">
                <input type="text" class="header-search-input-big" id="big-search-input" placeholder="Wat zoek je?">
                <div class="header-search-results-big" id="header-search-results-big"></div>
            </div>@endauth
            <div id="links">
                @guest
        
                    <a href="{{route('login')}}">Inloggen</a>
                    
                @endguest
                @auth
                    <p>Welkom <br><span> {{ Auth::user()->name }}</span> </p>
                    <div class="dropdown">
                        <button  class="dropbtn">
                            @php
                                $userimage = File::exists(public_path('images/users/'.Auth::user()->id.'/profile-image'));
                                if($userimage === true){
                                    $filecount = count(File::allfiles('images/users/'.Auth::user()->id.'/profile-image'));
                                    if($filecount == 0){
                                        $profilepicname = null;
                                    }else{
                                        $files = File::allfiles('images/users/'.Auth::user()->id.'/profile-image');            
                                        $profilepicname = $files[0]->getFilename();
                                    }
                                }else{
                                    $profilepicname = null;
                                }
                            @endphp
                            @if($profilepicname)
                                <img src="{{asset('images/users/'.Auth::user()->id.'/profile-image/'.$profilepicname)}}" alt="">
                            @else
                            <i class="fas fa-user"></i>
                            @endif
                        </button>
                        <div class="dropdown-content">
                            <a href="{{route('dashbord', Auth::user()->id)}}">Mijn Dashboard</a>
                            <a href="{{route('profile', Auth::user()->id)}}">Profiel</a>
                            <a href="{{route('logout', Auth::user()->id)}}">Logout</a>
                          </div>
                    </div>
                @endauth
            </div>
        </div>
        <div id="header-lower-div">
            <div id="header-lower-div-content">
                <div id="auth-functions">
                    @auth
                    <a href="{{route('article-overview')}}">
                            Artikels
                    </a>
                    <a href="{{route('course-overview')}}"> 
                           Cursussen
                    </a>
                    <a href="{{route('event-overview')}}">
                           Evenementen
                    </a>
                    <a href="{{route('thread-overview')}}">
                            Discussies
                    </a>
                    <a href="{{route('tutorial-overview')}}"> 
                            Tutorials
                    </a>
                    <a href="{{route('calendar', Auth::user()->id)}}"> 
                            Kalender
                    </a>
                    <a href="{{route('notes', Auth::user()->id)}}"> 
                            Notities
                    </a>
                    <a href="{{route('storage', Auth::user()->id)}}"> 
                            Storage
                    </a>
                    <a href="{{route('documents', Auth::user()->id)}}"> 
                        Documenten
                    </a>
                    @endauth
                </div>
                <div id="dropdown-links">
                    <div class="dropdown">
                        <button  class="dropbtn">
                            Algemeen<i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-content">
                            <a href="{{route('policy')}}">Policy</a>
                            @auth <a href="{{route('guide')}}">Gids</a> @endauth
                            <a href="{{route('terms')}}">Voorwaarden</a>
                          </div>
                    </div>
                    <div class="dropdown">
                        <button  class="dropbtn">
                            Over Ons<i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-content">
                            <a href="{{route('about-us')}}">Over ons</a>
                            <a href="{{route('contact')}}">Contacteer ons</a>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Small header -900px --}}
    <div id="headerblackout-small"></div>
    <div id="header-content-small">
        <div id="header-top-div">
            <div id="header-logo">
                <button id="header-open-menu-button"><i class="fas fa-bars fa-1x"></i></span></button>
                <a href="{{route('welcome')}}"><img src="{{asset('images/logo2.png')}}"></a>
            </div>
            <div id="links">
                @guest
                    <a href="{{route('login')}}">Inloggen</a>
                @endguest
                @auth
                    <p>Welkom <span> {{ Auth::user()->name }}</span> </p>
                    <div class="dropdown">
                        <button  class="dropbtn">
                            @php
                                $userimage = File::exists(public_path('images/users/'.Auth::user()->id.'/profile-image'));
                                if($userimage === true){
                                    $filecount = count(File::allfiles('images/users/'.Auth::user()->id.'/profile-image'));
                                    if($filecount == 0){
                                        $profilepicname = null;
                                    }else{
                                        $files = File::allfiles('images/users/'.Auth::user()->id.'/profile-image');            
                                        $profilepicname = $files[0]->getFilename();
                                    }
                                    
                                }else{
                                    $profilepicname = null;
                                }
                            @endphp
                            @if($profilepicname)
                                <img src="{{asset('images/users/'.Auth::user()->id.'/profile-image/'.$profilepicname)}}" alt="">
                            @else
                            <i class="fas fa-user"></i>
                            @endif
                        </button>
                        <div class="dropdown-content">
                            <a href="{{route('dashbord', Auth::user()->id)}}">Mijn Dashboard</a>
                            <a href="{{route('profile', Auth::user()->id)}}">Profiel</a>
                            <a href="{{route('logout', Auth::user()->id)}}">Logout</a>    
                          </div>
                    </div>
                @endauth
            </div>
        </div>
        @auth
        <div id="header-lower-div">
            <div id="searchbar">
                <input type="text" class="header-search-input-small" id="small-search-input" placeholder="Wat zoek je?">
                <div class="header-search-results-small" id="header-search-results-small"></div>
            </div>
        </div>
        @endauth
    </div>
    <div id="small-menu-blackout"></div>
    <div id="small-header-menu">
        <div id="close-menu-div">
            <button id="close-small-header-menu"> &#10005; </button>
        </div>
        <ul>
            @auth
            <li><h2>Dashboard</h2></li>
            <li class="menu-link"><a href="{{route('article-overview')}}">Artikels</a></li>
            <li class="menu-link"><a href="{{route('course-overview')}}">Cursussen</a></li>
            <li class="menu-link"><a href="{{route('event-overview')}}">Evenementen</a></li>
            <li class="menu-link"><a href="{{route('thread-overview')}}">Discussies</a></li>
            <li class="menu-link"><a href="{{route('tutorial-overview')}}">Tutorials</a></li>
            <li class="menu-link"><a href="{{route('calendar', Auth::user()->id )}}">Kalender</a></li>
            <li class="menu-link"><a href="{{route('notes', Auth::user()->id)}}">Notities</a></li>
            <li class="menu-link"><a href="{{route('storage', Auth::user()->id)}}">Storage</a></li>
            <li class="menu-link"><a href="{{route('documents')}}">Documenten</a></li>

            @endauth
            <li><h2>Algemeen</h2></li>
            @auth <li class="menu-link"><a href="{{route('guide')}}">Gids</a></li>@endauth
            <li class="menu-link"><a href="{{route('policy')}}">Policy</a></li>
            <li class="menu-link"><a href="{{route('terms')}}">Voorwaarden</a></li>
            <li><h2>Over Ons</h2></li>
            <li class="menu-link"><a href="{{route('about-us')}}">Over ons</a></li>
            <li class="menu-link"><a href="{{route('contact')}}">Contact</a></li>
        </ul>
    </div>
</header>