<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\EventSigns;
use App\Models\User;

class PDFController extends Controller
{
    //
    public function index(Request $request, $id){
        $signs = EventSigns::where('event_id', $id)->get();
        $dataArray = [];
        foreach($signs as $sign){
            $sign_user = User::where('id', $sign->user_id)->first();
            $signInfo = [
                'id' => $sign->id,
                'name' => $sign_user->name,
                'email' => $sign_user->email,
            ];
            array_push($dataArray, $signInfo);
        }
        $rows = $dataArray;
        $pdf = PDF::loadView('pdf_view', ['rows' => $rows]);  
        return $pdf->download('Evenementlijst.pdf');
    }
}
