<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\BabysitterController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OpinionController;
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
Route::get('/', function () {return view('index');})->name('index');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/opinion-add', [App\Http\Controllers\OpinionController::class, 'store'])->name('send-opinion');
Route::get('/opinion-delete/{id}', [App\Http\Controllers\OpinionController::class, 'destroy'])->name('destroy-opinion');

Route::group(['middleware' => 'roles', 'roles' => ['admin']], function(){
    Route::get('/makemoderator/{user_id}', [PanelController::class, 'makeModerator'])->name('makeModerator');
    Route::get('/makeuser/{user_id}', [PanelController::class, 'makeUser'])->name('makeUser');
    Route::get('/makeadmin/{user_id}', [PanelController::class, 'makeAdmin'])->name('makeAdmin');
}); 


Route::group(['middleware' => 'roles', 'roles' => ['admin', 'moderator']], function(){
    // Panel
    Route::get('/panel', [PanelController::class, 'index'])->name('panel');

    Route::get('/confirming', [BabysitterController::class, 'noConfirmed'])->name('confirming');
    Route::get('/confirm/{id}', [BabysitterController::class, 'confirm'])->name('confirm');
    Route::get('/unconfirm/{id}', [BabysitterController::class, 'unConfirm'])->name('unconfirm');

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports');
    Route::get('/report/{id}', [App\Http\Controllers\ReportController::class, 'show'])->name('show-report');
    Route::get('/confirm-report/{id}', [App\Http\Controllers\ReportController::class, 'confirm'])->name('confirm-report');
});

Route::group(['middleware' => 'roles', 'roles' => ['admin', 'moderator', 'user']], function(){
    // Babysitter
    Route::post('/store-babysitter', [App\Http\Controllers\BabysitterController::class, 'store'])->name('store-babysitter');
    Route::get('/create-babysitter', [App\Http\Controllers\BabysitterController::class, 'create']);
    Route::get('/babysitters', [App\Http\Controllers\BabysitterController::class, 'index'])->name('index-babysitters');
    Route::get('/panel-babysitters', [App\Http\Controllers\BabysitterController::class, 'showAll'])->name('panel-babysitters');
    Route::get('/babysitter/{id}', [App\Http\Controllers\BabysitterController::class, 'show'])->name('show-babysitters');
    Route::get('/edit/{id}', [App\Http\Controllers\BabysitterController::class, 'edit'])->name('edit-babysitters');
    Route::get('/delete/{id}', [App\Http\Controllers\BabysitterController::class, 'destroy'])->name('delete-babysitter');
    Route::post('/update-babysitter', [App\Http\Controllers\BabysitterController::class, 'update'])->name('update-babysitters');

    // User
    Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
    Route::delete('/delete/user/{id}', [UserController::class, 'delete'])->name('delete.user');
    Route::get('/profil', [UserController::class, 'show'])->name('show-profile');
    Route::post('/store-user', [App\Http\Controllers\UserController::class, 'store'])->name('store-user');
    Route::get('/getRole/{id}', [PanelController::class, 'getRole'])->name('getRole');

    // Report
    Route::get('/contact', function () {return view('contact');})->name('contact');
    Route::post('/report', [ReportController::class, 'store'])->name('create-report');

    // Chat
    Route::get('/chat', [App\Http\Controllers\MessageController::class, 'index'])->name('chat');
});

Route::post('/sendMail', [MailController::class, 'sendMail'])->name('sendMail');