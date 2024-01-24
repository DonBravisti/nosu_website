<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Запуск, удаление и создание миграций

Route::prefix('migrate')->group(function () {
    Route::get('run', function () {
        $exitCode = Artisan::call('migrate:refresh', [
            '--force' => 'foo'
        ]);

        return response()->json(['message' => $exitCode]);
    });
    Route::get('delete', function () {
        $exitCode = Artisan::call('migrate:reset', [
            '--force' => 'foo'
        ]);

        return response()->json(['message' => $exitCode]);
    });
    Route::get('create', function (Request $request) {
        $exitCode = Artisan::call('make:migration', [
            'name' => $request->get('migrationName')
            //'--table'=>'table name'
        ]);
        return response()->json(['message' => $exitCode]);
    });
    Route::get('status', function () {
        $exitCode = Artisan::call('migrate:status');
        $output = Artisan::output();
        print_r($output);
        // return response()->json(['message' => $exitCode]);
    });
});

Route::get('clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');

    return response()->json(['message' => $exitCode]);
 });
