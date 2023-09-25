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
use App\Http\Controllers\PayPalPaymentController;
use App\Http\Livewire\Course;
use App\Services\ChatGptService;
use Illuminate\Support\Facades\Route;
use App\Events\JobCompleted;
use App\Http\Controllers\CourseSettingsController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ShareEventController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\userController;
use App\Http\Livewire\CourseContent;
use App\Listeners\JobCompletedListener;
use App\Http\Middleware\LogIpAddressMiddleware;
// use App\Models\Course;
use App\Models\User;
use App\Services\GetResponseService;
use Hamcrest\Arrays\IsArray;
use OpenAI\Laravel\Facades\OpenAI;
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

//Route::view('/', 'welcome')->name('home');
Route::get('/', function () {
    return redirect()->to('login');
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
Route::resource('/subscribe', SubscribeController::class);
Route::post('/track-share-event', [ShareEventController::class, 'trackShareEvent'])->name('track-share-event');


Route::controller(PayPalPaymentController::class)->group(function () {
    Route::get('payment', 'payment')->name('payment');
    Route::get('cancel', 'cancel')->name('payment.cancel');
    Route::get('payment/success', 'success')->name('payment.success');
});


Route::get('/share/courses/{courseId}/{course_slug}', [CourseController::class, 'share'])->name('courses.share')->middleware('ip_ad');
Route::post('price/courses/{course}', [CourseController::class, 'coursePrice'])->name('courses.coursePrice');
Route::put('/courses/{image}', [CourseController::class, 'courseImage'])->name('courses.courseImage');
Route::middleware('auth')->group(function () {
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
        Route::post('course-setting/{courseId}/save-responseId', [CourseSettingsController::class, 'saveGetResponseId'])->name('course-setting.saveGetResponseId');
        Route::resource('course-setting', CourseSettingsController::class);
        Route::resource('research', ResearchController::class);
        Route::resource('search', SearchController::class);
        Route::get('/export-text', [ContentPlannerController::class, 'exportText'])->name('export.text');
        Route::resource('content-planner', ContentPlannerController::class);
        Route::get('/suggestions', [SuggestionController::class, 'suggestions']);
        Route::post('/setting/paypal/', [SettingController::class, 'paypalData'])->name('setting.paypalData');
        Route::post('/setting/get-response/', [SettingController::class, 'saveGetResponseData'])->name('setting.saveGetResponseData');
        Route::resource('/setting', SettingController::class);
        Route::get('/password/reset', [ResetPasswordController::class ,'showResetForm'])->name('password.reset');
        Route::post('/password/reset', [ResetPasswordController::class ,'resetPassword'])->name('password.reset');
        Route::resource('lesson', LessonController::class);
        Route::view('tutorials', 'users.tutorial')->name('tutorials');
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
       
        // $response = $client->request('GET', 'https://emailoctopus.com/api/1.6/lists?api_key=b06003c3-0568-47c2-89f8-6e720a2ee93e', []);
        // dd($response);

        $ch = curl_init();
        $api_key = 'b06003c3-0568-47c2-89f8-6e720a2ee93e';
        
        curl_setopt($ch, CURLOPT_URL, 'https://emailoctopus.com/api/1.6/lists');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $api_key));
        
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        dd($result);
                    
   

       
        
        // $getResponseService = app(GetResponseService::class);
        // $x = $getResponseService->createContact($apiKey);
  

    

});
