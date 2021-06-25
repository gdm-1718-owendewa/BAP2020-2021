<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\TutorialController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CalenderController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashbordController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\PDFController;
use \Chatify\Http\Controllers\MessagesController;

use App\Http\Controllers\Auth\LogoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();
Route::get('/dashbord/{id}', [DashbordController::class, 'index'])->name('home');

/* General routes */
Route::get('/',  [WelcomeController::class, 'index'])->name('welcome');
Route::get('/about-us',  [GeneralController::class, 'about'])->name('about-us');
Route::get('/policy',  [GeneralController::class, 'policy'])->name('policy');
Route::get('/guide',  [GeneralController::class, 'guide'])->name('guide');
Route::get('/contact',  [GeneralController::class, 'contact'])->name('contact');
Route::get('/terms',  [GeneralController::class, 'terms'])->name('terms');
Route::get('/documents',  [GeneralController::class, 'documents'])->name('documents');
Route::get('/documents/files/download/{filename}.{extension}', [GeneralController::class, 'downloadPath'])->name('document-files-download');

/*dashbord routes*/
Route::prefix('dashbord')->group(function(){
    Route::get('/{id}',  [DashbordController::class, 'index'])->name('dashbord');
    Route::get('/{id}/no-guide-message', [DashbordController::class, 'noGuideMessage'])->name('no-guide-message');
    Route::get('/{id}/projects/{project_type}', [DashbordController::class, 'myProjects'])->name('dashbord-my-projects');
});
/* Notes Routes */
Route::prefix('notes')->group(function(){
    Route::get('/{user_id}',  [NotesController::class, 'index'])->name('notes');
    Route::post('/{user_id}/submit',  [NotesController::class, 'createSubmit'])->name('note-create-submit');
    Route::get('/{note_id}/{user_id}/delete',  [NotesController::class, 'deleteNote'])->name('note-delete');
    Route::get('/{user_id}/deleteall',  [NotesController::class, 'deleteAllNotes'])->name('note-delete-all');
}); 
/* Article routes */
Route::prefix('article')->group(function(){
    Route::get('/article-overview',  [ArticleController::class, 'overview'])->name('article-overview');
    Route::get('/article-detail/{id}',  [ArticleController::class, 'detail'])->name('article-detail');
    Route::get('/create',  [ArticleController::class, 'create'])->name('article-create');
    Route::post('/create/submit',  [ArticleController::class, 'createSubmit'])->name('article-create-submit');
    Route::get('/edit/{id}',  [ArticleController::class, 'edit'])->name('article-edit');
    Route::patch('/edit/{id}/submit',  [ArticleController::class, 'editSubmit'])->name('article-edit-submit');
    Route::get('/delete/{id}',  [ArticleController::class, 'delete'])->name('article-delete');
    // Route::post('/edit/{id}/supportfile/edit/{oldfilename}',  [ArticleController::class, 'editsupportfile'])->name('article-edit-support');
    Route::get('/edit/{id}/supportfile/delete/{oldfilename}',  [ArticleController::class, 'deletesupportfile'])->name('article-delete-support');
});
/* Tutorial routes */
Route::prefix('tutorial')->group(function(){
    Route::get('/tutorial-overview',  [TutorialController::class, 'overview'])->name('tutorial-overview');
    Route::get('/detail/{id}',  [TutorialController::class, 'detail'])->name('tutorial-detail');
    Route::get('/create',  [TutorialController::class, 'create'])->name('tutorial-create');
    Route::post('/create/submit',  [TutorialController::class, 'createSubmit'])->name('tutorial-create-submit');
    Route::get('/edit/{id}',  [TutorialController::class, 'edit'])->name('tutorial-edit');
    Route::patch('/edit/{id}/submit',  [TutorialController::class, 'editSubmit'])->name('tutorial-edit-submit');
    Route::get('/delete/{id}',  [TutorialController::class, 'delete'])->name('tutorial-delete');
});
/* Event routes */
Route::prefix('event')->group(function(){
    Route::get('/event-overview',  [EventController::class, 'overview'])->name('event-overview');
    Route::get('/event-detail/{id}',  [EventController::class, 'detail'])->name('event-detail');
    Route::get('/create',  [EventController::class, 'create'])->name('event-create');
    Route::post('/create/submit',  [EventController::class, 'createSubmit'])->name('event-create-submit');
    Route::get('/edit/{id}',  [EventController::class, 'edit'])->name('event-edit');
    Route::patch('/edit/{id}/submit',  [EventController::class, 'editSubmit'])->name('event-edit-submit');
    Route::get('/delete/{id}',  [EventController::class, 'delete'])->name('event-delete');
    Route::get('/sign/{user_id}/{event_id}',  [EventController::class, 'eventSignUp'])->name('event-sign');
    Route::get('/unsign/{user_id}/{event_id}',  [EventController::class, 'eventSignOut'])->name('event-unsign');
});
/* Thread routes */
Route::prefix('thread')->group(function(){
    Route::get('/thread-overview',  [ThreadController::class, 'overview'])->name('thread-overview');
    Route::get('/thread-detail/{id}',  [ThreadController::class, 'detail'])->name('thread-detail');
    Route::get('/create',  [ThreadController::class, 'create'])->name('thread-create');
    Route::post('/create/submit',  [ThreadController::class, 'createSubmit'])->name('thread-create-submit');
    Route::get('/edit/{id}',  [ThreadController::class, 'edit'])->name('thread-edit');
    Route::patch('/edit/{id}/submit',  [ThreadController::class, 'editSubmit'])->name('thread-edit-submit');
    Route::get('/delete/{id}',  [ThreadController::class, 'delete'])->name('thread-delete');
    Route::post('/thread-detail/{id}/comment',  [ThreadController::class, 'comment'])->name('thread-comment-submit');
});
/* Courses routes */
Route::prefix('course')->group(function(){
    Route::get('/course-overview',  [CourseController::class, 'overview'])->name('course-overview');
    Route::get('/course-detail/{id}',  [CourseController::class, 'detail'])->name('course-detail');
    Route::get('/course-detail/{id}/{user_id}/signup',  [CourseController::class, 'courseSignUp'])->name('course-signup');
    Route::get('/course-detail/{id}/{user_id}/signout',  [CourseController::class, 'courseSignOut'])->name('course-signout');
    Route::get('/create',  [CourseController::class, 'create'])->name('course-create');
    Route::post('/create/submit',  [CourseController::class, 'createSubmit'])->name('course-create-submit');
    Route::get('/edit/{id}',  [CourseController::class, 'edit'])->name('course-edit');
    Route::patch('/edit/{id}/submit',  [CourseController::class, 'editSubmit'])->name('course-edit-submit');
    Route::get('/delete/{id}',  [CourseController::class, 'delete'])->name('course-delete');
    Route::get('/upload-overview/{id}',  [CourseController::class, 'uploadsOvervieuw'])->name('course-upload-overview');
    Route::get('/upload-overview/{id}/delete/{upload_id}',  [CourseController::class, 'deleteUpload'])->name('course-upload-delete');
    Route::get('/upload-overview/{id}/upload/{upload_id}',  [CourseController::class, 'uploadDetail'])->name('course-upload-detail');
    Route::get('/{id}/addcontent',  [CourseController::class, 'addcontent'])->name('course-addcontent'); 
    Route::get('/{id}/editupload/{upload_id}',  [CourseController::class, 'editcontent'])->name('course-editcontent'); 
    Route::patch('/{id}/editupload/{upload_id}/submit',  [CourseController::class, 'editcontentSubmit'])->name('course-editcontent-submit'); 
    Route::post('/{id}/addcontent/submit',  [CourseController::class, 'addcontentSubmit'])->name('course-addcontent-submit');
    Route::get('/files/{id}/download/{filename}/{extension}', [CourseController::class, 'downloadPath'])->name('course-files-download');
    Route::get('/files/{id}/generate/{pdfname}', [CourseController::class, 'showPDF'])->name('course-generate-pdf');
    Route::get('/files/{id}/{videoname}', [CourseController::class, 'showVideo'])->name('course-video');
    Route::get('/files/{id}',  [CourseController::class, 'files'])->name('course-files');
    Route::get('/files/{id}/delete/{path}',  [CourseController::class, 'deleteFile'])->name('course-delete-file');
});
/* profile routes*/ 
Route::prefix('profile')->group(function(){

Route::get('/{user_id}',  [ProfileController::class, 'index'])->name('profile');
Route::get('/edit/{user_id}',  [ProfileController::class, 'edit'])->name('profile-edit');
Route::get('/delete/{user_id}',  [ProfileController::class, 'delete'])->name('profile-delete');
Route::patch('/edit/{user_id}/submit',  [ProfileController::class, 'editSubmit'])->name('profile-edit-submit');
});

/* Storage route */
Route::prefix('storage')->group(function(){
    Route::get('/{user_id}',  [StorageController::class, 'index'])->name('storage');
    Route::post('/{user_id}/design',  [StorageController::class, 'adddesign'])->name('storage-design-add');
    Route::get('/{user_id}/design/{file}/delete',  [StorageController::class, 'deletedesign'])->name('storage-design-delete');
    Route::get('/{user_id}/design/{filename}/{extension}', [StorageController::class, 'downloadPath'])->name('storage-download-file');
});
/* logout route*/
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

/* comments */
Route::get('/delete-comment/{id}',  [CommentController::class, 'delete'])->name('delete-comment');
Route::get('/edit-comment/{id}',  [CommentController::class, 'edit'])->name('edit-comment');
Route::patch('/edit-comment/{id}/submit',  [CommentController::class, 'editSubmit'])->name('edit-comment-submit');

/* calendar routes */
Route::prefix('calender')->group(function(){
    Route::get('/{user_id}',  [CalenderController::class, 'index'])->name('calendar');
    Route::post('/{user_id}/{date}',  [CalenderController::class, 'createTask'])->name('calendar-add-task');
    Route::patch('/{user_id}/edittask/{task_id}/submit',  [CalenderController::class, 'editTaskSubmit'])->name('calendar-edit-task-submit');
    Route::get('/{user_id}/deletetask/{task_id}',  [CalenderController::class, 'deleteTask'])->name('calendar-delete-task');
    Route::post('/daytasks',  [CalenderController::class, 'getTasks'])->name('calendar-get-task');
    Route::post('/alltasks',  [CalenderController::class, 'getAllTasks'])->name('calendar-get-all-task');
});

/*note route */
Route::post('/noteupload',  [NotesController::class, 'uploadNote'])->name('upload-note');

/* pass reset routes */
Route::get('/reset-password',  [EmailController::class, 'gotoresetemail'])->name('gotoresetemail');
Route::post('/passreset',  [EmailController::class, 'passresetmail'])->name('passresetmail');
Route::get('/password/reset/{token}/{email}',  [EmailController::class, 'passreset'])->name('passreset');
Route::post('/passresetsubmit/{email}',  [EmailController::class, 'passresetsubmit'])->name('passresetsubmit');

/* contact mail route */
Route::post('/contactmail',  [EmailController::class, 'contactmail'])->name('contact-mail');

/* searchbarroutes */
Route::post('/searchbarresults',  [HomeController::class, 'searchbarResult'])->name('searchbar-result');
Route::post('/adminsearchbarresults',  [HomeController::class, 'adminSearchbarResult'])->name('admin-searchbar-result');

Route::get('/event-pdf', [PDFController::class,'index'])->name('eventPDF');