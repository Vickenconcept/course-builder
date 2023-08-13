<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ContentPlannerController;
use App\Http\Controllers\CourseresearchController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\PlatformresearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SuggestionController;
use App\Http\Livewire\LessonArchitect;
use App\Models\Dashboard;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::view('index','pages.users.content-planner');
    Route::view('coming-soon','pages.users.coming-soon')->name('coming-soon');
    Route::get('user-dashboard',function () {return view('pages.users.index');})->name('user-dashboard');
    Route::resource('books', BookController::class);
    Route::resource('course-research', CourseresearchController::class);
    Route::resource('lesson-architect', LibraryController::class);
    Route::resource('platform-research',PlatformResearchController::class);
    Route::resource('search', SearchController::class);
    Route::resource('content-planner', ContentPlannerController::class);
    Route::get('lesson', LessonArchitect::class)->name('lesson.store');
    Route::get('export-books', [BookController::class, 'export'])->name('export.books');
    Route::get('/fetch-suggestions', [SuggestionController::class,'fetchSuggestions']);
    Route::get('/export-text', [ContentPlannerController::class,'exportText'])->name('export.text');
    Route::post('logout', [AuthController::class, 'destroy'])
    ->name('logout');
 
    
    
});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('/dashboard', DashboardController::class);
});


Route::get('callback', function() {
    return 'success callback';
});

Route::view('register','auth.register')->name('register');
Route::view('login','auth.login')->name('login');
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


require __DIR__.'/auth.php';
