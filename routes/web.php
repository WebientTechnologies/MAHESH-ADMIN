<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\NotificationController;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {

    Route::resource('users', '\App\Http\Controllers\UserController');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    //Family Route//
    Route::resource('families', 'App\Http\Controllers\FamilyController');
    Route::post('/search-family', 'FamilyController@search')->name('families.search');
    Route::get('/family-members/{familyId}', [FamilyController::class,'getFamilyMembers']);


    Route::resource('families.members', 'App\Http\Controllers\FamilyMemberController');

    //Gallery Route//
    Route::resource('galleries', 'App\Http\Controllers\GalleryController');

     //Promotions Route//
     Route::resource('promotions', 'App\Http\Controllers\PromotionController');

    //Business Route//
    Route::resource('categories', 'App\Http\Controllers\CategoryController');
    Route::resource('subcategories', 'App\Http\Controllers\SubCategoryController');
    Route::resource('businesses', 'App\Http\Controllers\BusinessController');

    //News Route//
    Route::resource('newses', 'App\Http\Controllers\NewsController');
    Route::post('/newses', [App\Http\Controllers\NewsController::class, 'store'])->name('send.notification');
    Route::post('/save-token', [App\Http\Controllers\NewsController::class, 'saveToken'])->name('save-token');

    //Event Route//
    Route::resource('events', 'App\Http\Controllers\EventController');

    //QUize Route//
    //Event Route//
    Route::resource('quizzes', 'App\Http\Controllers\QuizController');

    Route::resource('winners', 'App\Http\Controllers\WinnerController');


    // Route to show the notification form
    Route::get('/notifications/create', [NotificationController::class, 'create'])->name('notifications.create');

    // Route to store the notification data
    Route::post('/notifications', [NotificationController::class, 'store'])->name('notifications.store');

    // Route to show the list of notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
});
