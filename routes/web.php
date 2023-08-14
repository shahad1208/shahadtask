<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\Auth\ForgotPasswordController;
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

Route::get('/', function () {
    return view('welcome');
});




Route::group(['middleware'=>'guest'],function(){
    Route::get('login',[AuthController::class,'index']);

    Route::post('login',[AuthController::class,'login'])->name('login')->middleware('throttle:2,1');

    Route::get('register',[AuthController::class,'register_view']);
    Route::post('register',[AuthController::class,'register'])->name('register')->middleware('throttle:2,1');

    Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::post('users-send-email', [UserController::class, 'sendEmail'])->name('ajax.send.email');



});





Route::group(['middleware'=>'auth'],function(){
        Route::get('/admin/home', 'AuthController@index')->name('admin.home');
Route::get('home/view-profile',[AuthController::class,'view_profile']);
// Route::get('home/view-profile/{id}/edit', 'ProfileController@edit')->name('profile.edit');

Route::get('home/view-profile/{id}/edit',[AuthController::class,'edit']);
Route::get('home/show-all-users',[AuthController::class,'usershow']);
Route::put('home/view-profile/{id}/edit', [AuthController::class, 'update']);

    Route::get('home',[AuthController::class,'home'])->name('home');
    Route::get('logout',[AuthController::class,'logout'])->name('logout');

    Route::get('home/show-all-users/{id}/edit',[AuthController::class,'edit1']);

    Route::get('/home/show-all-users/{id}/edit',[AuthController::class,'updateusers'])->name('user.edit');

    Route::delete('/home/show-all-users/{id}', [AuthController::class, 'destroy'])->name('user.destroy');
    Route::get('/home/show-all-users/{id}/edit', [AuthController::class, 'edit1'])->name('user.edit');
//Show All users 
Route::put('/home/show-all-users/{id}/edit', [AuthController::class, 'updateuser'])->name('user.update');



//Routes for email sent to users 
Route::get('home/users/sendemailto', [UserController::class, 'index2'])->name('users.index2');
Route::post('users-send-email', [UserController::class, 'sendEmail'])->name('ajax.send.email');

Route::middleware(['auth', '1'])->group(function () {
    // Admin-only routes go here
    Route::get('/admin-dashboard', [AdminController::class, 'index1'])->name('admin.dashboard');
    // ...
});


//Routes for Jobs And Queue

Route::get('home/email-test', function(){
  
    $details['email'] = 'shahad1932@gmail.com';
  
    dispatch(new App\Jobs\SendEmailJob($details));
  
    dd('Jobs and Queue Done');
});



});


