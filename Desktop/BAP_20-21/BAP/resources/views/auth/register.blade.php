<?php $page = 'register'; ?>
@extends('layouts.app')
@section('title','TattooEase | Register')

@section('content')
    <div id="auth-form-container">
            {{-- Register top div (machine met achtergrond) --}}
        <div id="top-form-div">
            <div id="top-form-image-div">
                <img src="{{asset('images/machine.png')}}">
            </div>
            <p>Hello again</p>
        </div>
        {{-- Register form --}}
        <div id="lower-form-div">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="control-div">
                    <label for="name" >{{ __('Naam') }}</label>

                    <div>
                        <input id="name" type="text" class=" effect-input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="control-div">
                    <label for="email">{{ __('E-Mailadres') }}</label>

                    <div >
                        <input id="email" type="email" class=" effect-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                        <input id="password" type="password" class=" effect-input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="control-div">
                    <label for="password-confirm" >{{ __('Verifieer Wachtwoord') }}</label>

                    <div >
                        <input id="password-confirm" type="password" class="effect-input" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>
                <div class="control-div">
                    <label for="shopname">{{ __('Studio naam') }}</label>

                    <div >
                        <input id="shopname" type="shopname" class=" effect-input @error('shopname') is-invalid @enderror" name="shopname" value="{{ old('shopname') }}" required autocomplete="shopname">

                        @error('shopname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="control-div">
                    <label for="shoplocation">{{ __('Studio locatie') }}</label>

                    <div >
                        <input id="shoplocation" type="shoplocation" class=" effect-input @error('shoplocation') is-invalid @enderror" name="shoplocation" value="{{ old('shoplocation') }}" required autocomplete="shoplocation">

                        @error('shoplocation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="control-div">
                    <div id="submit-button-div">
                        <button type="submit">
                            {{ __('Registreer') }}
                        </button>
                    </div>
                </div>
                <div id="forgot-pass-div">
                    <p>
                        
                        Heeft u al een account?
                        <a href="{{ route('login') }}">
                            {{ __('Log In') }}
                        </a>
                        <p>
                </div>
            </form>
        </div>
    </div>             
@endsection
