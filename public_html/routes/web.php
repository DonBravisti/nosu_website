<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EditController;

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

Route::get('/', function () {
    return view('structure');
});

Route::get('/edit', function () {
    return view('profileEditing');
});
Route::post('/edit/save', [EditController::class, 'save']);

Route::get('/kafedra-prikladnoj-matematiki-i-informatiki', function () {
    return view('department');
});

Route::get('/kafedra-prikladnoj-matematiki-i-informatiki/basaeva-elena-kazbekovna', function () {
    return view('persCard');
});

