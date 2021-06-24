@extends('layouts.app')
@section('title','TattooEase | Guide')
@section('content')
<div class="general-container">
    <div id="guide-content-container">
        <h1>Guide</h1> 
        <div>
            @if(auth()->user()->role == 0)
            <h2>Dashboard</h2>
            <p>U zult na het inloggen en/of registreren terecht gekomen zijn op uw dashboard hier zult u verschillende dingen zien. Aan de linker kant van uw scherm zult u de sidebar zien waar de functionaliteiten staan en waar u verder op kan door klikken.</p>
            <p>Rechts zult u uw events en cursussen zien staan waar u voor bent ingeschreven bent u nergens ingeschreven zult u een bericht zien staan onder de respectievelijke titel met de boodschap om te kijken welke er beschikbaar zijn.</p>
            <h2>Notities</h2>
            <p>Op deze pagina kan u notities bijhouden door ze in het rechtse veld in te vullen en op "voeg notitie toe" te klikken.</p>
            <p>Als u een notitie heeft toegevoegd zal deze links in de lijst verschijnen waarna u deze kunt aanpassen door op de knop met het potlood en oranje achtergrond te duwen waarna een venster zal openen, om dit aan te passen. U kan een notitie verwijderen door op de rode knop met de vuilnisbak te duwen.</p>
            <h2>Kalender</h2>
            <p>Op deze pagina kan u taken toevoegen op de gekozen datum. Om te beginnen klik op de gewenste datum als u dit doet zult u het linker veld zien verspringen met de gekozen datum en een knop onderaan "voeg taak toe". Als u hier op klikt, zal een venster openen waar u uw taak naam kunt toevoegen en een uur ingeven (de interpretatie van het uur is vrij om te kiezen). Als u een taak heeft toegevoegd door nogmaals op de gekozen datum te duwen in de kalender zult u zien dat uw taak nu is toegevoegd in het linker veld. </p>
            <p>Nu kunt u net zoals bij de notities uw gekozen taak aanpassen of verwijderen door op de respectievelijke knop te klikken.</p>
            <h2>Profiel</h2>
            <p>Op deze pagina zult u uw algemene info kunnen aanpassen (deze is meegegeven tijdens de registratie) en kunt u video's en of designs toevoegen om deze te bewaren op uw pagina. U kunt deze op een later tijdstip ook downloaden omdat we deze zelf ook bewaren.</p>
            <h2>Artikels, Discussies, Evenementen, Tutorials, Cursussen</h2>
            <p>Deze 5 zijn op basis niveau redelijk gelijk u zult verwezen worden naar de overzicht pagina van uw gekozen functie waar u alle reeds aangemaakte projecten zult zien staan.</p>
            <h3>Gebruik</h3>
            <h4>Artikels</h4>
            <p>Artikels worden gebruikt om nieuws door te geven aan de andere gebruikers van dit platform zoals een bijvoorbeeld een nieuw soort inkt die op de markt is gekomen en u wilt hier iets over schrijven uit eigen ervaring of na onderzoek om te delen met andere mensen dan is dit de functie die u zoekt.</p>
            <h4>Discussies</h4>
            <p>Discussies zijn er om bepaalde onderwerpen te bespreken met andere gebruikers zoals bijvoorbeeld wat de beste manier is om uw materiaal te ontsmetten. Hier kunnen andere gebruikers op reageren en u kunt in discussie of in gesprek gaan met deze gebruikers.</p>
            <h4>Evenementen</h4>
            <p>Evenementen bestaan om u kunt het al raden een evenement te organiseren voor de community dit kan gaan van een sociaal evenement tot een seminar organiseren waar u een tattoo stijl bespreekt.</p>
            <h4>Tutorials</h4>
            <p>De tutorials zullen worden gebruikt om mensen eenmalig bij te leren als voorbeeld kunnen we het onderwerp van discussies nemen "hoe moet ik mijn materiaal ontsmetten" en dan kan u deze tutorials bekijken, er zijn 3 soorten: geschreven tutorials waar de tutorial bestaat uit doorlopende tekst, video tutorials waar u naar een video kan kijken om u te informeren of mixed dit is dan een mix van de twee en kunt u kiezen of u naar de video kijkt, de tekst leest of alle 2 doet.</p>
            <h4>Cursussen</h4>
            <p>Cursussen zijn er om mensen op lange tijd iets bij te leren, dit is voor personen die zichzelf de tijd wilt nemen om diep in te gaan in een onderwerp en andere mensen hierover wilt bijleren deze bestaan uit drie dingen een overzicht pagina waar u kunt kijken of de cursus iets voor u is en u zich kan inschrijven na u in te schrijven kunt u naar de uploads en files pagina gaan. Op deze 2 pagina's zult u de mogelijkheid hebben om 1. Verschillende teksten te lezen waar een bepaald deel van de cursus word uitgelegd en 2. de bestanden die bij de cursus horen te bekijken of downloaden. </p>
            <p>Om dieper in te gaan over de verschillende teksten voor een cursus deze teksten kunnen over verschillende delen van het onderwerp uit de cursus gaan. Laten we "Tribal" als onderwerp nemen dan zou één van de teksten kunnen zijn "Historie van tribal" of "Verschillende betekenissen van tribal tattoos".</p>
            <h2>Extra</h2>
            <h3>Zoekbalk</h3>
            <p>Dit webplatform beschikt over een zoekbalk die u kunt open door op het vergroot glas te klikken bovenaan in de hoofding.</p>
            <p>Na op dit icoon te klikken zal de zoekbalk open gaan en kunt u beginnen met typen. Zoekt u een discussie een bepaalde tattoo stijl geef dan de naam van deze stijl op bijvoorbeeld "Tribal" en kijk of u enige resultaten te zien krijgt. Op deze manier kan u: Artikelen, Cursussen, Discussies, Evenementen, Tutorials en Gebruikers vinden. De gebruikers worden ook getoond op studio naam dus m.a.w zoekt u een bepaalde studio of tattoo shop dan kan u ook die naam ingeven en kijken of deze persoon op het platform zit. </p>
            <h3>Chat</h3>
            <p>Zoals u waarschijnlijk al heeft gezien heeft u rechtsonderdaan op het scherm een chat icon als u hier op klikt zult u doorverwezen worden naar de chat pagina hier kan u door in de "Zoeken" balk een naam in te geven van en gebruiker waar u een privé gesprek met wilt voeren let op u kunt alleen maar de naam van de gebruiker zoeken en niet op studio of shop. </p><p>Na het aanklikken van de persoon die u wilt, zal een chatvenster verschijnen</p>
            @elseif(auth()->user()->role == 1 || auth()->user()->role == 2)
            <h2>Dashboard</h2>
            <p>u zult na het inloggen en/of registreren terecht gekomen zijn op uw dashboard hier zult u verschillende dingen zien. Aan de linker kant van uw scherm zult u de sidebar zien waar de functionaliteiten staan en waar u verder op kan door klikken.</p>
            <p>Rechts zult u kaders zien waar u kunt op doorklikken als u een project van de respectievelijke kader hebt gemaakt (Artikels, Cursussen, Discussies, Evenementen, Tutorials). </p><p>Ook zult u uw events en cursussen zien staan waar u voor bent ingeschreven bent u nergens ingeschreven zult u een bericht zien staan onder de respectievelijke titel met de boodschap om te kijken welke er beschikbaar zijn.</p>
            <h2>Notities</h2>   
            <p>Op deze pagina kan u notities bijhouden door ze in het rechtse veld in te vullen en op "voeg notitie toe" te klikken.</p>
            <p>Als u een notitie heeft toegevoegd zal deze links in de lijst verschijnen waarna u deze kunt aanpassen door op de knop met het potlood en oranje achtergrond te duwen waarna een venster zal openen, om dit aan te passen. U kan een notitie verwijderen door op de rode knop met de vuilnisbak te duwen.</p>
            <h2>Kalender</h2>
            <p>Op deze pagina kan u taken toevoegen op de gekozen datum. Om te beginnen klik op de gewenste datum als u dit doet zult u het linker veld zien verspringen met de gekozen datum en een knop onderaan "voeg taak toe". Als u hier op klikt, zal een venster openen waar u uw taak naam kunt toevoegen en een uur ingeven (de interpretatie van het uur is vrij om te kiezen). Als u een taak heeft toegevoegd door nogmaals op de gekozen datum te duwen in de kalender zult u zien dat uw taak nu is toegevoegd in het linker veld. </p>
            <p>Nu kunt u net zoals bij de notities uw gekozen taak aanpassen of verwijderen door op de respectievelijke knop te klikken.</p>
            <h2>Profiel</h2>
            <p>Op deze pagina zult u uw algemene info kunnen aanpassen (deze is meegegeven tijdens de registratie) en kunt u video's en of designs toevoegen om deze te bewaren op uw pagina. U kunt deze op een later tijdstip ook downloaden omdat we deze zelf ook bewaren.</p>
            <h2>Artikels, Discussies, Evenementen, Tutorials, Cursussen</h2>
            <p>Deze 5 zijn op basis niveau redelijk gelijk u zult verwezen worden naar de overzicht pagina van uw gekozen functie waar u alle reeds aangemaakte projecten zult zien staan, u zult rechts boven ook een knop zien staan waar u naar een pagina verwezen zult worden om zelf één aan te maken.</p>
            <h3>Gebruik</h3>
            <h4>Artikels</h4>
            <p>Artikels worden gebruikt om nieuws door te geven aan de andere gebruikers van dit platform zoals een bijvoorbeeld een nieuw soort inkt die op de markt is gekomen en u wilt hier iets over schrijven uit eigen ervaring of na onderzoek om te delen met andere mensen dan is dit de functie die u zoekt.</p>
            <h4>Discussies</h4>
            <p>Discussies zijn er om bepaalde onderwerpen te bespreken met andere gebruikers zoals bijvoorbeeld wat de beste manier is om uw materiaal te ontsmetten. Hier kunnen andere gebruikers op reageren en u kunt in discussie of in gesprek gaan met deze gebruikers.</p>
            <h4>Evenementen</h4>
            <p>Evenementen bestaan om u kunt het al raden een evenement te organiseren voor de community dit kan gaan van een sociaal evenement tot een seminar organiseren waar u een tattoo stijl bespreekt.</p>
            <h4>Tutorials</h4>
            <p>De tutorials zullen worden gebruikt om mensen eenmalig bij te leren als voorbeeld kunnen we het onderwerp van discussies nemen "hoe moet ik mijn materiaal ontsmetten" en dan kan u deze tutorials aanmaken of bekijken, er zijn 3 soorten: geschreven tutorials waar de tutorial bestaat uit doorlopende tekst, video tutorials waar u naar een video kan kijken om u te informeren of mixed dit is dan een mix van de twee en kunt u kiezen of u naar de video kijkt, de tekst leest of alle 2 doet.</p>
            <h4>Cursussen</h4>
            <p>Cursussen zijn er om mensen op lange tijd iets bij te leren, dit is voor personen die zichzelf de tijd wilt nemen om diep in te gaan in een onderwerp en andere mensen hierover wilt bijleren deze bestaan uit drie dingen een overzicht pagina waar u kunt kijken of de cursus iets voor u is en u zich kan inschrijven na u in te schrijven kunt u naar de uploads en files pagina gaan. Op deze 2 pagina's zult u de mogelijkheid hebben om 1. Verschillende teksten te lezen waar een bepaald deel van de cursus word uitgelegd en 2. de bestanden die bij de cursus horen te bekijken of downloaden. </p>
            <p>Om dieper in te gaan over de verschillende teksten voor een cursus deze teksten kunnen over verschillende delen van het onderwerp uit de cursus gaan. Laten we "Tribal" als onderwerp nemen dan zou één van de teksten kunnen zijn "Historie van tribal" of "Verschillende betekenissen van tribal tattoos".</p>
            <h2>Extra</h2>
            <h3>Zoekbalk</h3>
            <p>Dit webplatform beschikt over een zoekbalk die u kunt open door op het vergroot glas te klikken bovenaan in de hoofding.</p>
            <p>Na op dit icoon te klikken zal de zoekbalk open gaan en kunt u beginnen met typen. Zoekt u een discussie een bepaalde tattoo stijl geef dan de naam van deze stijl op bijvoorbeeld "Tribal" en kijk of u enige resultaten te zien krijgt. Op deze manier kan u: Artikelen, Cursussen, Discussies, Evenementen, Tutorials en Gebruikers vinden. De gebruikers worden ook getoond op studio naam dus m.a.w zoekt u een bepaalde studio of tattoo shop dan kan u ook die naam ingeven en kijken of deze persoon op het platform zit. </p>
            <h3>Chat</h3>
            <p>Zoals u waarschijnlijk al heeft gezien heeft u rechtsonderdaan op het scherm een chat icon als u hier op klikt zult u doorverwezen worden naar de chat pagina hier kan u door in de "Zoeken" balk een naam in te geven van en gebruiker waar u een privé gesprek met wilt voeren let op u kunt alleen maar de naam van de gebruiker zoeken en niet op studio of shop. </p><p>Na het aanklikken van de persoon die u wilt, zal een chatvenster verschijnen.</p>
            @endif
        </div>
    </div>
</div>
@endsection
