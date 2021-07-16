<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Cache;
use App\Models\User;
class LogoutController extends Controller
{
    //Logout
    public function logout(Request $request, $id) {
       
        Cache::forget('is_online'.$id);
        User::where('id',  $id)->update(['last_seen' => Carbon::now()]);
        Auth::logout();
        return redirect('/');
    }
}
