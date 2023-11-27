<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EditController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;

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

Route::get('/', [PageController::class, 'goToStructure']);


Route::post('/contracts/add/send', [PageController::class, 'addContract']);
Route::get('/contracts/add', [PageController::class, 'goToContractsAdd']);
Route::get('/contracts', [PageController::class, 'goToContracts']);

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

