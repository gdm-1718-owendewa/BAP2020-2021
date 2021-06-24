<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Query;
use App\Models\Course;
use App\Models\CourseSignUp;
use App\Models\CourseUpload;
use App\Models\User;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class CourseController extends Controller
{
    //Overview pagina
    public function overview()
    {
       if(!auth()->user()){
         return redirect()->route('welcome');
       }
       $page = 'course-overview';
       $courses = Course::paginate(4);
       foreach($courses as $course){
          $course->small_info = substr($course->general_info, 0, 50);
       }
       return view('course.overview')->with(compact('page','courses'));
    }
    //Detail pagina
    public function detail($id)
    {
       if(!auth()->user()){
         return redirect()->route('welcome');
       }
       $page = 'detail';
      $course = Course::where('id', $id)->first();
       if($course != null){
         $signed = CourseSignUp::where('course_id', $course->id)->where('user_id', auth()->user()->id)->first();
         return view('course.detail')->with(compact('page','id','course','signed'));
       }else{
          return redirect()->back();
       }
    }
    //Create pagina
    public function create()
    {
       if(!auth()->user()){
         return redirect()->route('welcome');
       }
       $page = 'course-create';
       return view('course.create')->with(compact('page'));
    }
    //Create submit
    public function createSubmit(Request $request)
    {
       if(!auth()->user()){
         return redirect()->route('welcome');
       }
       $page = 'course-create-submit';
       $validator = Validator::make(
       $request->all(),[
         'title' => 'required|max:200',
         'info' => 'required|min:100',
         'content' => 'required|min:100',
        
         ])->validate();
         $data = [
            'author_id' => auth()->user()->id,
            'author' => auth()->user()->name,
            'title' => ucfirst($request['title']),
            'general_info' => $request['info'],
            'content' => $request['content'],
         ];
         Course::create($data);
         $currentCousre = Course::orderBy('id', 'desc')->first();
         return redirect()->route('course-detail', $currentCousre->id);
    }
    //Edit pagina
    public function edit($id)
    {
       if(!auth()->user()){
         return redirect()->route('welcome');
       }
      $course = Course::where('id', $id)->first();
       if($course != null){
         if($course->author_id == auth()->user()->id || auth()->user()->role == 2){
            $page = 'course-edit';
            return view('course.edit')->with(compact('page','id','course'));
         }else{
            return redirect()->back();
         }
       }else{
          return redirect()->back();
       }
    }
    //Edit submit
    public function editSubmit(Request $request, $id)
    {
      $page = 'course-edit';
       if(!auth()->user()){
         return redirect()->route('welcome');
       } 
      $course = Course::where('id', $id)->first();
       if($course->author_id == auth()->user()->id || auth()->user()->role == 2){
            $validator = Validator::make(
               $request->all(),[
               'title' => 'required|max:200',
               'info' => 'required|min:100',
               'content' => 'required|min:100',
              
               ])->validate();
            
            $data = [
               'title' => ucfirst($request["title"]),
               'general_info' => $request["info"],
               'content' => $request["content"],
            ];
            Course::where('id',$id)->update($data);
            return redirect()->route('course-detail', $id);
         }else{
            return redirect()->back();
         }
    }
    //Delete
    public function delete($id)
    {
       if(!auth()->user()){
         return redirect()->route('welcome');
       }
       $page = 'course-delete';
      $course = Course::where('id', $id)->first();
      if($course->author_id == auth()->user()->id || auth()->user()->role == 2){
         // Verwijder alles van cursus ( uploads, bestanden, sign-ins en de cursus zelf)
         $coursedirpath = public_path("images/course/".$id);
         if(File::exists($coursedirpath)){
            Course::where('id',$id)->delete();
            CourseUpload::where('course_id',$id)->delete();
            CourseSignUp::where('course_id',$id)->delete();
            File::deleteDirectory($coursedirpath);
            return redirect()->back()->with('succes', 'Cursus - '. $course->title .' is verwijderd.');
         }elseif(!File::exists($coursedirpath)){
            Course::where('id',$id)->delete();
            CourseUpload::where('course_id',$id)->delete();
            return redirect()->back()->with('succes', 'Cursus - '. $course->title .' is verwijderd.');
         }
    }
   }
   //Overzicht van de cursus uploads
    public function uploadsOvervieuw($id)
    {
       if(!auth()->user()){
         return redirect()->route('welcome');
       }
      $course = Course::where('id', $id)->first();
       $signed = CourseSignUp::where('course_id', $course->id)->where('user_id', auth()->user()->id)->first();
       if(auth()->user()->id != $course->author_id && $signed == null && auth()->user()->role != 2){
          return redirect()->back()->with('fail', 'Gelieve u in te schrijven om de cursus uploads te bekijken');
       }
       $uploads = CourseUpload::where('course_id',$id)->get();
       $upload_count = count($uploads);
       $page = 'course-upload-overview';
       return view('course.upload-overview')->with(compact('page','id','course','uploads','upload_count'));
    }
    //Detail van een upload
    public function uploadDetail($id, $upload_id){
      $page = 'course-upload-detail';
      $course = Course::where('id', $id)->first();
      if($course != null){
         $signed = CourseSignUp::where('course_id', $course->id)->where('user_id', auth()->user()->id)->first();
         if(auth()->user()->id != $course->author_id && $signed == null && auth()->user()->role != 2){
            return redirect()->back()->with('fail', 'Gelieve u in te schrijven om deze cursus upload te bekijken');
         }
         $upload = CourseUpload::where('id',$upload_id)->first();
         if($upload != null){
            return view('course.uploaddetail')->with(compact('page','id','upload_id','upload','course'));
         }else{
            return redirect()->back();
         }
      }else{
         return redirect()->back();
      }

    }
    //Bestanden van de cursus
    public function files($id)
    {
       if(!auth()->user()){
         return redirect()->route('welcome');
       }
       $page = 'course-files';
      $course = Course::where('id', $id)->first();
       if($course != null){
            $signed = CourseSignUp::where('course_id', $course->id)->where('user_id', auth()->user()->id)->first();
            if(auth()->user()->id != $course->author_id && $signed == null && auth()->user()->role != 2){
               return redirect()->back()->with('fail', 'Gelieve u in te schrijven om de cursus bestanden te bekijken');
            }
            //Haal alle bestanden van de cursus op
            $suportpath = public_path("images/course/".$id."/files");
            if(File::exists($suportpath)){
               $files = File::allFiles($suportpath);
               $supportFileNames = [];
               foreach($files as $file){
                  $filename = pathinfo($file,PATHINFO_FILENAME).'.'.pathinfo($file,PATHINFO_EXTENSION);
                  $extension = pathinfo($file,PATHINFO_EXTENSION);
                  $filepath = "/images/course/".$id."/files/".$filename;
                  $data = [
                     'filename' => $filename,
                     'extension' => $extension,
                     'filepath' => $filepath,
                  ];
                  array_push($supportFileNames, $data);
               }
               return view('course.files')->with(compact('page','id','supportFileNames','course'));
            }else{
               return view('course.files')->with(compact('page','id','course'));
            }
       }else{
          return redirect()->back();
       }
    }
    //Verwijder bestand
    public function deleteFile($id, $path){
      if(!auth()->user()){
         return redirect()->route('welcome');
       }
      $course = Course::where('id', $id)->first();
       if($course->author_id == auth()->user()->id || auth()->user()->role == 2){
         $filepath =  public_path("images/course/".$id."/files/".$path);
         if(File::exists($filepath)){
            File::delete($filepath);
            return redirect()->back()->with('succes', 'Bestand verwijderd');
         }else{
            return redirect()->back();
         }
      }else{
         return redirect()->back();
      }
    }
    //Voeg content toe ( upload of bestand) pagina
    public function addcontent($id)
    {
       if(!auth()->user()){
         return redirect()->route('welcome');
       }
      $course = Course::where('id', $id)->first();
       if($course != null){
         if($course->author_id == auth()->user()->id || auth()->user()->role == 2){
            $page = 'course-files';
            return view('course.addcontent')->with(compact('page','id','course'));
         }else{
            return redirect()->back();
         }
      }else{
         return redirect()->back();
      }
    }
    //Voeg content toe
    public function addcontentSubmit(Request $request, $id)
    {
      if(!auth()->user()){
         return redirect()->route('welcome');
      }
      $course = Course::where('id', $id)->first();
      
      if($course->author_id == auth()->user()->id || auth()->user()->role == 2){
         $validator = Validator::make(
            $request->all(),[
            'title' => 'required|max:200',
            'inhoud' => 'nullable|min:50',
            'supporting-files.*' => 'file|mimes:jpeg,png,mp4,pdf|max:100000000',
            ])->validate();
         //Check of er iets leeg is
         if(!isset($request['supporting-files']) && $request["inhoud"] == null && $request["title"] == null){
            return redirect()->back()->with('fail', 'U kan uw formulier niet leeg laten vul een titel en inhoud in of voeg bestanden toe');
         }
         //Check of alles leeg is behalve supporting files
         if(isset($request['supporting-files']) && $request["inhoud"] == null && $request["title"] == null){
            foreach($request['supporting-files'] as $file){
               $filename = $file->getClientOriginalName();
               $file->move(public_path("/images/course/".$id."/files"), $filename);
            }
            return redirect()->back()->with('succes', 'Uw bestanden zijn toegevoegd');
         }
         //Check of titel null is maar inhoud niet
         if($request["title"] == null){
            if($request["inhoud"] != null){
               return redirect()->back()->with('fail', 'U moet een titel invoeren als u een inhoud wilt uploaden');
            }
         }
         //Check of titel en inhoud zijn ingevuld
         else if($request["title"] != null && $request["inhoud"] != null){
            $data = [
               'course_id' => $id,
               'title' => $request["title"],
               'content' => $request["inhoud"],
            ];
            CourseUpload::create($data);
            //Check of er supporting files zijn bijgevoegd
            if(isset($request['supporting-files'])){
               foreach($request['supporting-files'] as $file){
                  $filename = $file->getClientOriginalName();
                  $file->move(public_path("/images/course/".$id."/files"), $filename);
               }
               return redirect()->back()->with('succes', 'Uw bestanden zijn toegevoegd');
      
            }
            return redirect()->back()->with('succes', 'Uw content is toegevoegd');
         }
         //Check of enkel titel is ingevuld
         else if($request["title"] != null && $request["inhoud"] == null && !isset($request['supporting-files'])){
            return redirect()->back()->with('fail', 'Gelieve een inhoud of bestanden toe te voegen');
      
         }
         //Check of er supporting files zijn
         if(isset($request['supporting-files'])){
            foreach($request['supporting-files'] as $file){
               $filename = $file->getClientOriginalName();
               $file->move(public_path("/images/course/".$id."/files"), $filename);
            }
            return redirect()->back()->with('succes', 'Uw bestanden zijn toegevoegd');

         }
      }else{
         return redirect()->back();
      }
    }
    //Pas content aan pagina
    public function editcontent($id, $upload_id){
       if(!auth()->user()){
         return redirect()->route('welcome');
      }
      $course = Course::where('id', $id)->first();
      if($course->author_id == auth()->user()->id || auth()->user()->role == 2){

         $upload = CourseUpload::where('id',$upload_id)->first();
         if($upload != null){   
            return view('course.editupload')->with(compact('id','course','upload'));
         }else{
            return redirect()->back();
         }
      }else{
         return redirect()->back();
      }

    }
    //Pas content aan
    public function editcontentSubmit(Request $request, $id, $upload_id){
      if(!auth()->user()){
         return redirect()->route('welcome');
      }
      $course = Course::where('id', $id)->first();
      if($course->author_id == auth()->user()->id || auth()->user()->role == 2){

         $validator = Validator::make(
            $request->all(),[
            'title' => 'required|max:200',
            'inhoud' => 'required|min:50',
            ])->validate();
           
            $data = [
               'course_id' => $id,
               'title' => $request['title'],
               'content' => $request['inhoud'],
            ];
            CourseUpload::where('id',$upload_id)->update($data);
         return redirect()->route('course-upload-detail', ['id' => $id, 'upload_id' => $upload_id]);
      }else{
         return redirect()->back();
      }
   }
   //Download foto
    public function downloadPath($id, $filename, $extension)
    {
       if(!auth()->user()){
         return redirect()->route('welcome');
       }
       $file= public_path(). "/images/course/".$id."/files/".$filename;
       $headers = array(
                 'Content-Type: application/'.$extension,
               );
   
       return Response::download($file, $filename, $headers);

    }
    //Toon PDF
    public function showPDF($id, $pdfname)
    {
       if(!auth()->user()){
         return redirect()->route('welcome');
       }
       $file= public_path(). "/images/course/".$id."/files/".$pdfname;
       {
         $file = File::get($file);
         $response = Response::make($file, 200);
 
         $response->header('Content-Type', 'application/pdf');
 
         return $response;
     }

    }
    //Toon Video
    public function showVideo($id, $videoname)
    {
       if(!auth()->user()){
         return redirect()->route('welcome');
       }
       $page = 'video-show';
       $file= "/images/course/".$id."/files/".$videoname;
       
       return view('course.videoshow')->with(compact('page','id','videoname', 'file'));

    }
    //Verwijder upload
    public function deleteUpload($id, $upload_id){
      if(!auth()->user()){
         return redirect()->route('welcome');
      }
      $course = Course::where('id', $id)->first();
      if($course->author_id == auth()->user()->id || auth()->user()->role == 2){
         CourseUpload::where('course_id',$id)->where('id',$upload_id)->delete();
         return redirect()->back()->with('succes', 'upload is verwijderd');
      }else{
         return redirect()->back();
      }
    }
    //Inschrijven cursus
    public function courseSignUp($id, $user_id){
       $user = User::where('id',$user_id)->first();
       if($user->id != auth()->user()->id || auth()->user()->role == 2){
          return redirect()->back();
       }else{
          $data = [
            'course_id' => $id,
            'user_id' => $user_id,
          ];
          CourseSignUp::create($data);
          return redirect()->back();
       }
    }
    //Uitschrijven cursus
    public function courseSignOut($id, $user_id){
      $user = User::where('id',$user_id)->first();
      $course = Course::where('id', $id)->first();

      if($user_id == auth()->user()->id || auth()->user()->role == 2){
         CourseSignUp::where('course_id', $id)->where('user_id', $user_id)->delete();
         return redirect()->back();
      }else{
         return redirect()->back();
      }
   }
}
