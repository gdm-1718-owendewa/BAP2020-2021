<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Query;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class GeneralController extends Controller
{
    //About pagina
    public function about()
    {
       $page = 'about-us';
       return view('general.about')->with(compact('page'));
    }
    //Policy pagina
    public function policy()
    {
       $page = 'policy';
       return view('general.policy')->with(compact('page'));
    }
    //Guide pagina
    public function guide()
    {
       $page = 'guide';
       if(!auth()->user()){
         return redirect()->back();
       }else{
         return view('general.guide')->with(compact('page'));

       }
    }
    //Contact pagina
    public function contact()
    {

       $page = 'contact';
       return view('general.contact')->with(compact('page'));
    }
    //Termen pagina
    public function terms()
    {

       $page = 'terms';
       return view('general.terms')->with(compact('page'));
    }
    public function documents()
    {
       $page = 'documents';

       $mainpath = storage_path("documents");
       $mainFiles = File::allFiles($mainpath);
       $files = [];
       foreach($mainFiles as $design){
         $file = [
           'filename' => pathinfo($design,PATHINFO_FILENAME),
           'extension' => pathinfo($design,PATHINFO_EXTENSION),
         ];
         array_push($files, $file);
      }
       return view('general.documents')->with(compact('page', 'files'));
    }

    //Download bestand
    public function downloadPath($filename, $extension)
    {
       if(!auth()->user()){
         return redirect()->route('welcome');
       }
       $file= storage_path(). "/documents/".$filename.".".$extension;
       return response()->file($file);

    }
}  
