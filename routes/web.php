<?php

use App\Http\Controllers\GoogleCalendarController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::prefix('Calendar')->group(function () {

    Route::controller(GoogleCalendarController::class)->group(function () {

        Route::get('calendar', 'index')->name('Calendar.index');
        Route::post('calendar_add_event', 'createMeeting')->name('Calendar.meeting');
    });
});

require __DIR__.'/auth.php';
