<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/load-data', function () {
    Artisan::call('make:migrate fresh --seed');
});
Route::get('/', function () {
    $users = User::get();
    return view('welcome',compact('users'));
});
Route::group([
    'middleware' => ['avoid-back-history'],

], function () {
    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    route::get('time-slots', [AppointmentController::class, 'time_slots']);
    Route::resource('appointment', AppointmentController::class);

});
