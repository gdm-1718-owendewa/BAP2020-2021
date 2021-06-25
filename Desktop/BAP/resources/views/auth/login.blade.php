<?php $page = 'login'; ?>
@extends('layouts.app')
@section('title','TattooEase | Login')
@section('content')
    <div id="auth-form-container">
        {{-- Login top div (machine met achtergrond) --}}
        <div id="top-form-div">
            <div id="top-form-image-div">
                <img src="{{asset('images/machine.png')}}">
            </div>
            <p>Welkom terug</p>
        </div>
        {{-- Login Form --}}
        <div id="lower-form-div">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div  class="control-div">
                    <label for="email" >{{ __('E-Mailadres') }}</label>
                    <div >
                        <input id="email" type="email" class=" effect-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="control-div">
                    <label for="password">{{ __('Wachtwoord') }}</label>
                    <div >
                        <input id="password" type="password" class=" effect-input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

               
                <div  class="control-div">
                    <input  type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label for="remember">
                        {{ __('Onthoud mij  ') }}
                    </label>
                </div>
              

                <div class="control-div">
                    <div id="submit-button-div">
                        <button type="submit" >
                            {{ __('Log In') }}
                        </button>
                    </div>
                    <div id="forgot-pass-div">
                        <p>
                        @if (Route::has('password.request'))
                            <a href="{{ route('gotoresetemail') }}">
                                {{ __('Uw wachtwoord vergeten?') }}
                            </a>
                        @endif
                        Of heeft u nog geen account aangemaakt?
                        <a href="{{ route('register') }}">
                            {{ __('Word lid') }}
                        </a>
                        <p>
                    </div>
                    
                </div>
            </form>
        </div>
    </div>
@endsection
