<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0,user-scalable=0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
   

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link rel="icon" href="{{asset('images/icon.png') }}" >

    @stack('stylesheets')
</head>
<body>
    <?php  if(!isset($page)){
        $page = 'passreset';
      }
      ?>
    <div id="app">
        @include('layouts/header')   
            <main>
                @yield('content')
                @if(Auth::user());
                    @if($page != 'chat' && Auth::user()->role == 1)
                        @include('layouts/icon')       
                    @endif
                @endif
                @include('layouts/topbutton')       
            </main>
        @include('layouts/footer')
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.tiny.cloud/1/4hjq99czt48etu2elylkz1vp07ptcxfwp79p4hux6pfut685/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script src="{{ asset('js/app.js') }}" defer></script>
@stack('scripts')

</html>
