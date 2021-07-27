<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Query;
use App\Models\Article;
use App\Models\User;
use App\Models\Views;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    //Overview view
    public function overview()
    {
       
       $page = 'overview';
       $articles = Article::paginate(6);
       //voeg artikel info toe voor ieder artikel
       foreach($articles as $article){
         $article->author_info = User::where('id',$article->author_id)->first();
         $profile_image_path = public_path('images/users/'.$article->author_id.'/profile-image');
         if(File::exists($profile_image_path)){
            $mainFile = File::allFiles($profile_image_path);
            $profile_image_name = pathinfo($mainFile[0],PATHINFO_FILENAME).'.'.pathinfo($mainFile[0],PATHINFO_EXTENSION);
            $article->profile_image_route = $profile_image_name;
         }
         $words = explode(" ", $article->title);
         $acronym = "";
         foreach ($words as $w) {
            $acronym .= $w[0];
         }
         $article->hashtag = '#' . strtoupper($acronym);
         $article->views = count(Views::where('article_id',$article->id)->get());
         $mainImage = File::allFiles(public_path('images/articles/'.$article->id.'/main-image/'));
         $article->image = pathinfo($mainImage[0],PATHINFO_FILENAME).'.'.pathinfo($mainImage[0],PATHINFO_EXTENSION);
         $smallcontentstring = substr($article->content, 0, 100);
         $article->smallcontent = $smallcontentstring;
         

      }
       return view('article.overview')->with(compact('page', 'articles'));
    }

    // artikel detail view
    public function detail($id)
    {
       $page = 'detail';
       Views::create(['article_id' => $id]);
       $article = Article::where('id',$id)->first();
       //check dat artikel bestaat
       if($article != null){
         $article->author_info = User::where('id',$article->author_id)->first();
         //check of user een profile image heeft
         $profile_image_path = public_path('images/users/'.$article->author_id.'/profile-image');
         if(File::exists($profile_image_path)){
            $mainFile = File::allFiles($profile_image_path);
            $profile_image_name = pathinfo($mainFile[0],PATHINFO_FILENAME).'.'.pathinfo($mainFile[0],PATHINFO_EXTENSION);
            $article->profile_image_route = $profile_image_name;
         }
         //check of er support files zijn
         $mainpath = public_path("images/articles/".$id."/main-image");
         $mainFile = File::allFiles($mainpath);
         $mainFilename = pathinfo($mainFile[0],PATHINFO_FILENAME).'.'.pathinfo($mainFile[0],PATHINFO_EXTENSION);
         $main_file_path = "/images/articles/".$id."/main-image/".$mainFilename;
         $suportpath = public_path("images/articles/".$id."/support-images");
         if(File::exists($suportpath)){
            $files = File::allFiles($suportpath);
            $supportFileNames = [];
            foreach($files as $file){
               $filename = pathinfo($file,PATHINFO_FILENAME).'.'.pathinfo($file,PATHINFO_EXTENSION);
               $filepath = "/images/articles/".$id."/support-images/".$filename;
               array_push($supportFileNames, $filepath);
            }
            return view('article.detail')->with(compact('page','id','supportFileNames','main_file_path','article'));
         }else{
            return view('article.detail')->with(compact('page','id','main_file_path','article'));
         }
      }else{
         return redirect()->back();
      }
       
    }
    // create view
    public function create()
    {
       $page = 'article-create';
       return view('article.create')->with(compact('page'));
    }
    // create submit
    public function createSubmit(Request $request)
    { 
       
       $validator = Validator::make(
         $request->all(),[
         'title' => 'required|max:200',
         'inhoud' => 'required|min:300',
         'banner-image' => 'required|file|mimes:jpeg,png,svg',
         'supporting-files.*' => 'file|mimes:jpeg,png,svg',
         ])->validate();

       $user_id = auth()->user()->id;
       $user = User::where('id',$user_id)->first();
       $article_main_image = \Request::file('banner-image');
       $article_main_image_name = $article_main_image->getClientOriginalName();
       $data = [
            'author' => $user->name,
            'author_id' => $user_id,
            'title' => ucfirst($request['title']),
            'content' => $request['inhoud'],
            'image_name' => $article_main_image_name,
       ];

       $article = Article::create($data);
       $article_id = Article::orderBy('id','desc')->first();
       $article_main_image->move(public_path("/images/articles/".$article_id->id."/main-image"), $article_main_image_name);
       if ($request['supporting-files']){
         $filenames= [];
         foreach($request['supporting-files'] as $file){
            $filename = $file->getClientOriginalName();
            $file->move(public_path("/images/articles/".$article_id->id."/support-images"), $filename);
         }
       }
       return redirect()->route('article-detail', $article_id->id);

    }
    //edit view
    public function edit($id)
    {
       
       $page = 'article-edit';
       $article = Article::where('id',$id)->first();
       // check of artikel bestaat
       if($article != null){
          //check of user de author is of een admin
         if($article->author_id == auth()->user()->id || auth()->user()->role == 2){
            $mainpath = public_path("images/articles/".$id."/main-image");
            $mainFile = File::allFiles($mainpath);
            $mainFilename = pathinfo($mainFile[0],PATHINFO_FILENAME).'.'.pathinfo($mainFile[0],PATHINFO_EXTENSION);
            $main_file_path = "/images/articles/".$id."/main-image/".$mainFilename;
            $article->main_file_path = $main_file_path;
            $suportpath = public_path("images/articles/".$id."/support-images");
            if(File::exists($suportpath)){
               $files = File::allFiles($suportpath);
               $supportFileNames = [];
               foreach($files as $file){
                  $filename = pathinfo($file,PATHINFO_FILENAME).'.'.pathinfo($file,PATHINFO_EXTENSION);
                  $filepath = $filename;
                  array_push($supportFileNames, $filepath);
               }
               if(count($supportFileNames) != 0){
                  return view('article.edit')->with(compact('page','id','article','suportpath','supportFileNames'));
               }else{
                  return view('article.edit')->with(compact('page','id','article'));

               }
            }else{
               return view('article.edit')->with(compact('page','id','article'));
            }
         }else{
            return redirect()->back();
         }
      }else{
         return redirect()->back();
      }
    }
    // edit submit
    public function editSubmit(Request $request,$id)
    {
      
      $article = Article::where('id',$id)->first();
      if($article->author_id == auth()->user()->id || auth()->user()->role == 2){
         
         $validator = Validator::make(
            $request->all(),[
            'title' => 'required|max:200',
            'inhoud' => 'required|min:300|max:20000',
            'banner-image' => 'file|mimes:jpeg,png,svg',
            'supporting-files.*' => 'file|mimes:jpeg,png,svg',
            ])->validate();

         $data = [
            'title' => ucfirst($request["title"]),
            'content' => $request['inhoud'],
         ];
         Article::where('id',$id)->update($data);
         //check voor een banner image
         if(isset($request['banner-image'])){
            $mainpath = public_path("images/articles/".$id."/main-image");
            $mainFile = File::allFiles($mainpath);
            File::delete($mainFile);
            $mainpath = public_path("images/articles/".$id."/main-image");
            $article_main_image = \Request::file('banner-image');
            $article_main_image_name = $article_main_image->getClientOriginalName();
            $article_main_image->move(public_path("/images/articles/".$id."/main-image"), $article_main_image_name);
         } 
         //check voor supporting images
         if (isset($request['supporting-files'])){
            $filenames= [];
            foreach($request['supporting-files'] as $file){
               $filename = $file->getClientOriginalName();
               $file->move(public_path("/images/articles/".$id."/support-images"), $filename);
            }
         }
         return redirect()->route('article-detail', $id);
      }else{
         return redirect()->back();
      }
    }
    //Delete
    public function delete($id)
    {
       
       $page = 'article-delete';
       $article = Article::where('id',$id)->first();
       if($article->author_id == auth()->user()->id || auth()->user()->role == 2){
         $articledirpath = public_path("images/articles/".$id);
         if(File::exists($articledirpath)){
            Article::where('id',$id)->delete();
            File::deleteDirectory($articledirpath);
            return redirect()->back()->with('succes', 'Artikel - '. $article->title .' is verwijderd.');
         }else{
            return redirect()->back();
         }
       }else{
         return redirect()->back();
      }
    }
    // pas supporting files aan
   //  public function editsupportfile(Request $request, $id, $oldfilename){
   //     if(!auth()->user()){
   //       return redirect()->route('welcome');
   //     }
   //     $article = Article::where('id',$id)->first();
   //     if($article->author_id == auth()->user()->id || auth()->user()->role == 2){
       
   //       $supportfilepath = public_path("images/articles/".$id."/support-images/".$oldfilename);
   //       File::delete($supportfilepath);
   //       foreach($request['design-files'] as $file){
   //          $file->getClientOriginalName();
   //          $filename = $file->getClientOriginalName();
   //          $file->move(public_path("/images/articles/".$id."/support-images"), $filename);
   //       }
   //       return redirect()->back();
   //    }else{
   //       return redirect()->back();
   //    }
   //  }
    //Verwijder support file
    public function deletesupportfile($id,$oldfilename){
      
       $article = Article::where('id',$id)->first();
       if($article->author_id == auth()->user()->id || auth()->user()->role == 2){
         $supportfilepath = public_path("images/articles/".$id."/support-images/".$oldfilename);
         File::delete($supportfilepath);
         return redirect()->back();
       }else{
          return redirect()->back();
       }
   }
  
}
