<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EditController;
use App\Http\Controllers\PageController;

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

Route::get('/edit', [PageController::class, 'goToProfileEditing']);

Route::post('/edit/save', [EditController::class, 'save']);

Route::get('/kafedra-prikladnoj-matematiki-i-informatiki', [PageController::class, 'goToDepartment']);

Route::get('/kafedra-prikladnoj-matematiki-i-informatiki/basaeva-elena-kazbekovna', [PageController::class, 'goToPersonalCard']);

