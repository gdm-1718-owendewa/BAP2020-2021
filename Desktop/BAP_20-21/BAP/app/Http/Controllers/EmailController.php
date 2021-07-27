<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Query;
use App\Models\User;
use App\Models\PassReset;

use App\Mail\ContactMail;
use App\Mail\PassResetEmail;
use Illuminate\Support\Facades\Hash;

class EmailController extends Controller
{
    //Wachtwoord reset mail
    public function passresetmail(Request $request){
        $isUserEmailInDatabase = User::where('email', $request['email'])->first();
        if($isUserEmailInDatabase == null){
            return back()->with('fail', 'Wij vinden dit emailadres niet terug in onze database');
        }else{
            //Generate token
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $charactersLength; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $checkIfEmailInReset = PassReset::where('email',$request['email'])->first();
            //Maak wwreset aan
            if($checkIfEmailInReset == null){
                $data = [
                    'email' => $request['email'],
                    'token' => $randomString,
                ];
                PassReset::create($data);
            } 
            //Update bestaande ww reset
            if($checkIfEmailInReset != null){
                PassReset::where('email',$request['email'])->update([ 'token' => $randomString]);
            }
            $data = array(
                'title' => 'Password reset email',
                'body' => 'Ga naar volgende link om uw passwoord te resetten',
                'resetlink' => 'https://tattoo-ease.owendewaele.com/password/reset/'.$randomString.'/'.$request['email'],
                'contactlink' => 'https://tattoo-ease.owendewaele.com/contact'
            );
            Mail::to($request["email"])->send(new PassResetEmail($data));
            
            return back()->with('succes', 'Email verzonden vergeet niet in uw spam te kijken');
        }
    }
    //Ga naar reset pagina
    public function passreset(Request $request, $token, $email){
        $checkIfMailAndTokenExistInDatabase = PassReset::where('email',$email)->where('token',$token)->first();
        if($checkIfMailAndTokenExistInDatabase != null){    
            return view('emails.passresetsubmit')->with(compact('email'));

        }else{
            return view('emails.notfound');

        }
    }
    //Geef ww reset door
    public function passresetsubmit(Request $request,$email){
        User::where('email',$email)->update([ 'password' => Hash::make($request["new-pass"]) ]);
        PassReset::where('email',$email)->delete();
        return redirect()->route('login');
    }
    //Ga naar reset mail
    public function gotoresetemail(){
        if(auth()->user() != null){
            return redirect()->back();
        }else{
            return view('auth.passwords.email');
        }
    }
    //Contact mail
    public function contactmail(Request $request){
        $data = array(
            'first-name' => $request['first-name'],
            'last-name' => $request['last-name'],
            'email' => $request['email'],
            'subject' => $request['subject'],
            'message' => $request['message'],
        );
        Mail::to('info.tattooease@gmail.com')->send(new ContactMail($data));
        return back()->with('succes', 'Email is verzonden wij nemen spoedig contact op');
    }
}
