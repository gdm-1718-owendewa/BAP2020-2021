<?php $page = 'pass-not-found'; ?>

@extends('layouts.app')
@section('title','TattooEase | Wachtwoord Reset Aanvraag Niet Gevonden')

@section('content')
{{-- Reset link failed div --}}
<div id="resetnotfound">
    <div id="card">
        <div id="not-found-title"><h1>Reset link niet meer geldig!</h1></div>
        <div id="not-found-content">
        <p>Beste gebruiker wij willen u bij deze melden dat deze link niet meer geldig is.</p>
        <p>Gelieve naar volgende link te gaan om een nieuwe <a href="{{route('gotoresetemail')}}">password reset</a> aan te vragen</p>
        </div>
    </div>
</div>
@endsection
