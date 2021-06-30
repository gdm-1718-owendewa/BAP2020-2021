<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    //
    public function index(Request $request){
        $signs = json_decode($request->get('rows'));
        $dataArray = [];
        foreach($signs as $sign){
            $signInfo = [
                'id' => $sign->id,
                'name' => $sign->name,
                'email' => $sign->email,
            ];
            array_push($dataArray, $signInfo);
        }
        $rows = $dataArray;
        $pdf = PDF::loadView('pdf_view', ['rows' => $rows]);  
        return $pdf->download('Evenementlijst.pdf');
    }
}
