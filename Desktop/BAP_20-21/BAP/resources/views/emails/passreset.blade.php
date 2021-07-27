<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tattooease | Wachtwoord Reset Aanvraag Mail</title>

</head>
<body>
    {{-- Wachtwoord reset email --}}
    <div id="email-container" style="width:100%; background:#e7e7e7;">
        <div style="max-width: 50%; width:100%; margin:0px auto; background:#fff; padding:2rem;">
            <h1>{{$data['title']}}</h1>
            <p>Beste gebruiker wij hebben een wachtwoord reset aanvraag ontvangen van uw email adres</p>
            <p>{{$data['body']}} <a style="background:rgb(203,0,0); padding:.5rem; text-decoration:none; color:#fff;" href="{{$data['resetlink']}}">Reset link</a></p>
            <p>Was u dit niet? neem dan contact op <a style="background:rgb(203,0,0); padding:.5rem; text-decoration:none; color:#fff;" href='{{$data["contactlink"]}}'>hier</a> of via 04 71 03 13 95</p>
            <p>Wij willen u alvast bedanken om gebruikt te maken van ons platform.</p>
        </div>
    <div>
</body>
</html>