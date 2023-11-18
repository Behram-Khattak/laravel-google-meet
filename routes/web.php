<?php

use App\Http\Controllers\MeetingController;
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

/**
 * Routes related to listing calendar events and creating meetings
 */
Route::name('calendar.')->group(function () {

    Route::get('calender/events', function () {
        return view('meeting');
    })->name('events');

    Route::controller(MeetingController::class)->group(function () {
        Route::post('calendar/event/meeting/create', 'store')->name('meeting.create');
    });
});

require __DIR__.'/auth.php';
