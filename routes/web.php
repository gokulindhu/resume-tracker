<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResetPasswordController;
Route::get('/', function () {
    return view('login');
})->middleware('guest');
Route::group(['prefix' =>'account'], function(){
   
    Route::group(['middleware' =>'guest'], function(){
        
        Route::get('login',[LoginController::class,'index'])->name('account.login');
        Route::get('register',[LoginController::class,'register'])->name('account.register'); 
        Route::post('process-register',[LoginController::class,'processRegister'])->name('account.processRegister');
        Route::post('authenticate',[LoginController::class,'authenticate'])->name('account.authenticate');
    });

    Route::group(['middleware' =>'auth'], function(){
        Route::get('logout',[LoginController::class,'logout'])->name('account.logout');
        Route::get('dashboard',[DashboardController::class,'dashboard'])->name('account.dashboard');
        
    });
});
Route::get('resetpass', [ResetPasswordController::class,'showResetForm'])->name('resetpass');
Route::post('reset', [ResetPasswordController::class, 'reset'])->name('password.reset');
Route::get('update/{token}', [ResetPasswordController::class,'showResetForm2']);
Route::post('updatepass', [ResetPasswordController::class, 'updatepass'])->name('password.update');

Route::group(['middleware' =>'auth'], function(){
    Route::get('/deleteresume/{id}',[DashboardController::class,'deleteresume']);
    Route::get('/updateresume/{id}',[DashboardController::class,'loadEditForm'])->name('updateresume');
    Route::put('/updateresume/{id}',[DashboardController::class,'editresume'])->name('editresume');
    Route::get('addresume',[DashboardController::class,'addresume'])->name('addresume');
    Route::post('process-addresume',[DashboardController::class,'processaddresume'])->name('process-addresume');
    Route::get('/viewresume/{id}',[DashboardController::class, 'viewresume']);
    Route::get('/export-resumetracker', [DashboardController::class, 'exportResumeTracker'])->name('resume.export');
});