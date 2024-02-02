<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EditController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SpkController;

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

Route::get('/', [PageController::class, 'goToStructure'])->name('index');

Route::prefix('/contracts')->name('contracts.')->group(function () {
    Route::post('/add/send', [PageController::class, 'addContract'])->name('add.send');
    Route::get('/add', [PageController::class, 'goToContractsAdd'])->name('add');
    Route::get('/', [PageController::class, 'goToContracts'])->name('list');
});

Route::prefix('publs')->name('publs.')->group(function () {
    Route::post('/add/send', [PageController::class, 'addPubl'])->name('add.send');
    Route::get('/add', [PageController::class, 'goToPublsAdd'])->name('add');
    Route::get('/', [PageController::class, 'goToPublications'])->name('list');
});

Route::prefix('/spk')->name('spk.')->group(function () {
    Route::get('/add/send', [SpkController::class, 'addSpk'])->name('send');
    Route::get('/add', [SpkController::class, 'goToSpkAdd'])->name('add');
    Route::get('/', [SpkController::class, 'goToSpkList'])->name('list');
});

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/register', [AuthController::class, 'showRegForm']);
Route::post('/register/reg', [AuthController::class, 'register']);

Route::get('/profile', function () {
    // Only authenticated users may access this route...
    return view('profile');
})->middleware('auth.basic');

Route::get('/edit/{id}', [EditController::class, 'goToProfileEditing']);
Route::post('/edit/{id}/update', [EditController::class, 'update']);
Route::get('/create-user', [EditController::class, 'showCreationForm']);
Route::post('/create', [EditController::class, 'create']);

Route::get('/kafedra-prikladnoj-matematiki-i-informatiki', [PageController::class, 'goToDepartment']);

Route::get('/kafedra-prikladnoj-matematiki-i-informatiki/{id}', [PageController::class, 'goToPersonalCard']);
