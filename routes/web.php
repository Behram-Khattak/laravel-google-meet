<?php

use App\Http\Controllers\DatabaseController;
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
Route::prefix('calendar')->name('calendar.')->group(function () {

    Route::controller(DatabaseController::class)->group(function () {
        Route::get('/events', 'index')->name('events');
        Route::post('/event/meeting/create', 'store')->name('meeting.create');
        Route::get('/event/meeting/show/{id}', 'show')->name('meeting.show');
        Route::put('/event/meeting/update/{id}', 'update')->name('meeting.update');
        Route::get('/event/meeting/delete/{id}', 'destroy')->name('meeting.delete');
    });
});

require __DIR__.'/auth.php';
