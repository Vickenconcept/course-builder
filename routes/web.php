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
use App\Http\Controllers\PayPalPaymentController;
use App\Http\Livewire\Course;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseSettingsController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ResellerController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ShareEventController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\userController;
use App\Services\ConvertKitService;
use App\Services\GetResponseService;

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

//Route::view('/', 'welcome')->name('home');
Route::get('/', function () {
    return view('welcome');
});
// Route::get('register', function(){
//    return redirect()->to('login');
// });


Route::middleware('guest')->group(function () {
    Route::view('register', 'auth.register')->name('register');
    Route::view('login', 'auth.login')->name('login');
});

Route::controller(AuthController::class)->name('auth.')->group(function () {
    Route::post('login', 'login')->name('login');
    Route::post('register', 'register')->name('register');
    Route::post('logout', 'destroy')->middleware('auth')->name('logout');
});



// Route::post('products/{id}/purchase', [ProductController::class ,'purchase'])->name('products.purchase');
Route::post('/paymentData', [SubscribeController::class, 'paymentData'])->name('subscribe.paymentData');
Route::post('/get_response', [SubscribeController::class, 'getResponse'])->name('subscribe.getResponse');
Route::post('/convert-kit', [SubscribeController::class, 'convertkit'])->name('subscribe.convertkit');
Route::resource('/subscribe', SubscribeController::class);
Route::post('/track-share-event', [ShareEventController::class, 'trackShareEvent'])->name('track-share-event');


Route::controller(PayPalPaymentController::class)->group(function () {
    Route::get('payment', 'payment')->name('payment');
    Route::get('cancel', 'cancel')->name('payment.cancel');
    Route::get('payment/success', 'success')->name('payment.success');
});


Route::get('/password/reset', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'resetPassword'])->name('password.reset');
Route::get('/share/courses/{courseId}/{course_slug}', [CourseController::class, 'share'])->name('courses.share')->middleware('ip_ad');
Route::post('price/courses/{course}', [CourseController::class, 'coursePrice'])->name('courses.coursePrice');
Route::put('/courses/{image}', [CourseController::class, 'courseImage'])->name('courses.courseImage');
Route::middleware('auth')->group(function () {
    Route::put('/courses-desc/{course}', [CourseController::class, 'updateDescription'])->name('courses.updateDescription');
    Route::resource('courses', CourseController::class);
    // Route::group(['middleware' => 'restrictUserRole:user'], function () {
    Route::resource('/dashboard', DashboardController::class)->middleware('admin');
    // Route::put('/dashboard/{id}', DashboardController::class)->name('dashboard')->middleware('admin');
    // });
    // Route::resource('/subscribe', SubscribeController::class);
    // Route::group(['middleware' => 'restrictUserRole:admin'], function () {
    Route::group(['middleware' => 'restrictUserRole'], function () {
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('restrictUserRole');
        Route::resource('profile', ProfileController::class)->only(['edit', 'update', 'destroy']);
        Route::resource('library', LibraryController::class);
        Route::view('index', 'user.content-planner');
        Route::view('coming-soon', 'pages.users.coming-soon')->name('coming-soon');
        Route::get('export-books', [BookController::class, 'export'])->name('export.books');
        Route::resource('books', BookController::class);
        Route::resource('course-validation', ScoreController::class);
        Route::get('course', Course::class)->name('course');
        Route::put('course/{courseId}', [CourseSettingsController::class, 'checkout'])->name('course.checkout');
        Route::post('course-setting/{courseId}/save-setting', [CourseSettingsController::class, 'saveSetting'])->name('course-setting.saveSetting');
        Route::post('course-setting/{courseId}/save-convert', [CourseSettingsController::class, 'convertKit'])->name('course-setting.convertKit');
        Route::post('course-setting/{courseId}/save-responseId', [CourseSettingsController::class, 'saveGetResponseId'])->name('course-setting.saveGetResponseId');
        Route::resource('course-setting', CourseSettingsController::class);
        Route::resource('research', ResearchController::class);
        Route::resource('search', SearchController::class);
        Route::resource('reseller', ResellerController::class);
        Route::get('/export-text', [ContentPlannerController::class, 'exportText'])->name('export.text');
        Route::resource('content-planner', ContentPlannerController::class);
        Route::get('/suggestions', [SuggestionController::class, 'suggestions']);
        Route::post('/setting/paypal/', [SettingController::class, 'paypalData'])->name('setting.paypalData');
        Route::post('/setting/get-response/', [SettingController::class, 'saveGetResponseData'])->name('setting.saveGetResponseData');
        Route::post('/setting/convert-kit/', [SettingController::class, 'saveConvert'])->name('setting.saveConvert');
        Route::resource('/setting', SettingController::class);
        Route::resource('lesson', LessonController::class);
        Route::view('tutorials', 'users.tutorial')->name('tutorials');
        Route::view('support', 'users.support')->name('support');
        // Route::get('export/{contentType}', ContentExportController::class)->name('export');
    });

    // Route::group(['middleware' => 'restrictUserRole:user'], function () {
    Route::resource('/user-dashboard', userController::class);
    // });
    // Route::controller(PayPalPaymentController::class)->group(function () {
    //     Route::get('payment', 'payment')->name('payment');
    //     Route::get('cancel', 'cancel')->name('payment.cancel');
    //     Route::get('payment/success', 'success')->name('payment.success');
    // });
});

Route::get('test', function () {
   

    $client = new \GuzzleHttp\Client();


    // $response = $client->request('GET', 'https://api.convertkit.com/v3/forms?api_key=');
    // $responseBody = $response->getBody()->getContents();
    // $res = json_decode($response->getBody(), true);

    $getResponseService = app(GetResponseService::class);
    dd($getResponseService->getAudience(env('CONVERT_KIT_API')));



});
