@auth
{{-- Sidebar div --}}
<div id="sidebar-div">
    <a href="{{route('article-overview')}}">
        <div>
            <i class="far fa-newspaper"></i><p>Artikelen</p>
        </div> 
    </a>
    <a href="{{route('course-overview')}}"> 
        <div>
            <i class="fas fa-book"></i><p>Cursussen</p>
        </div>
    </a>
    <a href="{{route('event-overview')}}">
        <div>
            <i class="far fa-handshake"></i><p>Evenementen</p>
        </div>  
    </a>
    <a href="{{route('thread-overview')}}">
        <div>
            <i class="fas fa-bullhorn"></i><p>Discussies</p>
        </div>
    </a>
    <a href="{{route('tutorial-overview')}}"> 
        <div>    
        <i class="fas fa-photo-video"></i><p>Tutorials</p>
        </div>
    </a>

</div>  
@endauth