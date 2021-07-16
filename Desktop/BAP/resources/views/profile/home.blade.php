@extends('layouts.app')
@section('title','TattooEase | Profiel Pagina')
@section('content')
{{-- URL Routes --}}
<div class="general-container">
    <div class="general-button-div">
        <div id="url-route-button">
            <p><a href="{{route('dashbord', auth()->user()->id)}}">Dashboard</a> <span>/</span> Profiel</p>
        </div>
    </div>
</div>

{{-- Profile container --}}
<div id="profile-container">
    {{-- Profile informtaion --}}
    <div id="left-side">
        @if(isset($user->image) && $user->image != null )
            <img src="{{asset('images/users/'.$user->id.'/profile-image/'.$user->image)}}" alt="">
        @else
            <img src="{{asset('images/user.svg')}}" alt="">
        @endif
        @if(Cache::has('is_online' . $user->id))
            <span class="text-success" style="margin-bottom:20px;">Online</span>
        @else
            <span class="text-secondary" style="margin-bottom:20px;">Offline, last seen {{ \Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}</span>
        @endif
        
        @if($user->id == auth()->user()->id || auth()->user()->role == 2)
        <a href="{{route('profile-edit',$user->id)}}">Pas aan</a>
        @else
        <a href="{{url('chatify?name='.$user->name)}}">Stuur een bericht</a>

        @endif
        <div class="info-div">
            <p class="label-p">Naam</p>
            <p class="user-p">{{$user->name}}</p>
        </div>
        
        <div class="info-div">
            <p class="label-p">Studio naam</p>
            <p class="user-p">{{$user->shopname}}</p>
        </div>
        <div class="info-div">
            <p class="label-p">Email</p>
            <p class="user-p">{{$user->email}}</p>
        </div>
        
       
        
        <iframe width='700' height='440' frameborder='0'  
        scrolling='no' marginheight='0' marginwidth='0'    
        src='https://maps.google.com/maps?&amp;hl=en&amp;q="{{$user->shoplocation}}"&amp;ie=UTF8&amp;t=&amp;z=15&amp;iwloc=B&amp;output=embed'></iframe>
    </div>
    </div>
</div>

@endsection
