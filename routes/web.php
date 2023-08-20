<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ContentPlannerController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\ResearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SuggestionController;
use App\Http\Livewire\LessonArchitect;
use App\Http\Livewire\Course;
use App\Services\ChatGptService;
use Illuminate\Support\Facades\Route;
use App\Events\JobCompleted;
use App\Http\Controllers\ScoreController;
use App\Http\Livewire\CourseContent;
use App\Listeners\JobCompletedListener;
// use App\Models\Course;
use App\Models\User;
use PHPUnit\Event\TestSuite\Loaded;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/test', function (){
//     ChatGptService::generateContent('what is PHP?');

//     return 'running...';
// });

Route::view('/','welcome')->name('home');

Route::middleware('guest')->group(function(){
    Route::view('register','auth.register')->name('register');
    Route::view('login','auth.login')->name('login');
});

Route::controller(AuthController::class)->name('auth.')->group(function(){
    Route::post('login', 'login')->name('login');
    Route::post('register', 'register')->name('register');
    Route::post('logout', 'destroy')->middleware('auth')->name('logout');
});




Route::middleware('auth')->group(function () {

    Route::get('/dashboard', DashboardController::class)->name('dashboard')->middleware('admin');
    Route::resource('profile', ProfileController::class)->only(['edit', 'update', 'destroy']);
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::resource('library', LibraryController::class);
    Route::view('index','user.content-planner');
    Route::view('coming-soon','pages.users.coming-soon')->name('coming-soon');
    Route::resource('books', BookController::class);
    Route::get('course/{id}/edit', [CourseController::class, 'edit'])->name('course.edit');
    Route::resource('course-validation', ScoreController::class);
    Route::get('lessons', LessonArchitect::class)->name('lessons.store');
    Route::get('content-outline', CourseContent::class);
    Route::get('course', Course::class)->name('course');
    Route::resource('research', ResearchController::class);
    Route::resource('search', SearchController::class);
    Route::resource('content-planner', ContentPlannerController::class);
    
    Route::resource('lesson-architect', LibraryController::class);
    Route::get('export-books', [BookController::class, 'export'])->name('export.books');
    Route::get('/export-text', [ContentPlannerController::class,'exportText'])->name('export.text');
    
    Route::get('/suggestions', [SuggestionController::class,'suggestions']);
//     Route::get('export/{contentType}', ContentExportController::class)->name('export');
    
});

Route::get('test/{id}/courses',function($id){
    $usersWithCoursesAndLessons = User::with(['courses.lessons'])->get();
    
    return $usersWithCoursesAndLessons->find($id)->load('courses');

});



 


