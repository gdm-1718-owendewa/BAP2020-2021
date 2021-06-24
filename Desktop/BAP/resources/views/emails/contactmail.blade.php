<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tattooease | Contact Mail</title>

</head>
<body>
    {{-- Contact mail div --}}
    <div id="email-container">
        <div>
            <h1>{{$data['subject']}}</h1>
            <p>De gebruiker met naam {{$data['first-name']}} {{$data['last-name']}}</p>
            <p>Met email {{$data['email']}}</p>
            <p>Heeft volgende vraag:</p>
            <p>{{$data['message']}}</p>
        </div>
    <div>
</body>
</html>