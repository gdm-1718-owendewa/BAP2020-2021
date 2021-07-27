@extends('layouts.app')
@section('title','TattooEase | Cursus Video Preview')

@section('content')
    {{-- Preview van video --}}
    <iframe src="{{asset(''.$file)}}" frameborder="0" id="show-video-file-iframe"></iframe>
@endsection