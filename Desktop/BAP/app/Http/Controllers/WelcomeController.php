<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Query;

class WelcomeController extends Controller
{
    //Home pagina
    public function index()
    {
        $page = 'home';
        $user = auth()->user();
        return view('welcome')->with(compact('page','user'));
    }
}
