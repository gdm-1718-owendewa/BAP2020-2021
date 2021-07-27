<?php $page = 'resetpass'; ?>

@extends('layouts.app')
@section('title','TattooEase | Nieuw Gebruikers Wachtwoord Ingeven')

@section('content')
   
{{-- Wachtwoord reset form --}}
    <div id="resetnotfound">
        <div id="card">
            <div id="found-title"><h1>Reset uw wachtwoord!</h1></div>
            <div id="found-content">
                <form action="{{route('passresetsubmit', $email)}}" method="POST">
                    @csrf
                    <label for="new-pass">Geef uw nieuw wachtwoord in</label>
                    <input type="password" name="new-pass" id="new-pass">
                    <input type="submit" value="Reset wachtwoord">
                </form>
            </div>
        </div>
    </div>
@endsection