@extends('layouts.app')
@section('title','TattooEase | Contact Pagina')
@section('content')
    {{-- Contact Div --}}
    <div id="contact-content">
        <div id="contact-info">
            @if (session('fail'))
                <div class="alert alert-danger col-lg-12">
                    {{ session('fail') }}
                </div>
            @endif
            @if (session('succes'))
                <div class="alert alert-success col-lg-12">
                    {{ session('succes') }}
                </div>
            @endif
            @if($errors->any())
                {{ implode('', $errors->all('<div>:message</div>')) }}
            @endif
            <h2>Contacteer ons</h2>
            <p>Heeft u vragen? Aarzel niet en neem direct contact op met ons. Ons team zal u zo snel en goed mogelijk assisteren.</p>
        </div>
        {{-- Contact Fromulier --}}
        <div id='contact-form-container'>
            <div id="form-info">
                <form method="POST" action="{{route('contact-mail')}}">
                    @csrf
                    <div id="first-name-div">
                        <label for="first-name">Voornaam</label>
                        <input type="text" id="first-name" name="first-name" required>
                    </div>
                    <div id="last-name-div">
                        <label for="last-name">Achternaam</label>
                        <input type="text" id="last-name" name="last-name" required>
                    </div>
                    <div id="subject-div">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div id="subject-div">
                        <label for="subject">Onderwerp</label>
                        <input type="text" id="subject" name="subject" required>
                    </div>
                    <div id="message-div">
                        <label for="message">Vraag</label>
                        <textarea id="message" name="message" required>

                        </textarea>
                    </div>
                    <div id="button-div">
                        <button>Verstuur</button>
                    </div>
                </form>  
            </div>
            {{-- Bedrijf Info --}}
            <div id="busines-info">
                <div>
                    <i class="fas fa-map-marker-alt"></i>
                    <p>België, 9000 Gent, EU</p>
                </div>
                <div>
                    <i class="fas fa-phone"></i>
                    <p>+32 471 03 13 95</p>
                </div>
                <div>
                    <i class="fas fa-envelope"></i>
                    <p>info.tattooease@gmail.com</p>
                </div>
            </div> 
        </div>
    </div>
       
@endsection
