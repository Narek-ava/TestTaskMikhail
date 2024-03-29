<?php

use App\Http\Controllers\MessageController;
use App\Models\Message;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard',[
            'id' => auth()->id(),
            'messages' => Message::query()->where('user_id', auth()->id())->get()
        ]);
    })->name('dashboard');

    Route::get('/messages', [MessageController::class, 'index']);
    Route::get('/messages', [MessageController::class, 'latestMessage']);
    Route::post('/messages', [MessageController::class, 'store']);
});
