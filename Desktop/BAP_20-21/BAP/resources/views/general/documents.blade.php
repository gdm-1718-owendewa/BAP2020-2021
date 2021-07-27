@extends('layouts.app')
@section('title','TattooEase | Documenten')
@section('content')
    <div id="documents-div">
        <div id="file-div">
            <p>
                Hieronder vind u een links naar een Koninklijke overeenkomst, een Nazorg overzicht en een toestemmingsformulier. Deze zullen op een nieuw venster geopend worden waar u dan de optie krijgt om deze te lezen/bekijken en te downloaden.</p>

            <ul>
            @foreach ($files as $file)
               <li> 
                   <a target="_blank" href="{{route('document-files-download', ['filename' => $file['filename'] ,'extension' => $file['extension']])}}" >{{$file['filename'].'.'.$file['extension']}}</a>
                </li>
            @endforeach
            </ul>
        </div>
    </div>    
@endsection
