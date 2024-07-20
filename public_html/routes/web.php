<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EditController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\EduPlanController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\SpkController;
use App\Http\Controllers\PublicationController;

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

Route::middleware('auth.basic')->group(function () {
    Route::prefix('/contracts')->name('contracts.')->group(function () {
        Route::post('/add/send', [ContractController::class, 'addContract'])->name('add.send');
        Route::get('/add', [ContractController::class, 'showContractsAdd'])->name('add');
        Route::get('/update-form/{id}', [ContractController::class, 'showContractUpdate'])->name('update-form');
        Route::put('/update/{id}', [ContractController::class, 'updateContract'])->name('update');
        Route::delete('/delete-empl-contract/{id}', [ContractController::class, 'deleteContract'])->name('delete');
        Route::get('/filter', [ContractController::class, 'filter'])->name('filter');
        Route::get('/', [ContractController::class, 'showContracts'])->name('list');
    });

    Route::prefix('publs')->name('publs.')->group(function () {
        Route::post('/add/send', [PublicationController::class, 'addPubl'])->name('add.send');
        Route::get('/add', [PublicationController::class, 'goToPublsAdd'])->name('add');
        Route::get('/update-form/{id}', [PublicationController::class, 'showPublUpdate'])->name('update-form');
        Route::put('/update/{id}', [PublicationController::class, 'updatePubl'])->name('update');
        Route::delete('/remove/{id}', [PublicationController::class, 'removePubl'])->name('remove');
        Route::get('/filter', [PublicationController::class, 'filter'])->name('filter');
        Route::get('/', [PublicationController::class, 'goToPublications'])->name('list');
    });

    Route::prefix('/fpk')->name('fpk.')->group(function () {
        Route::post('/add/send', [SpkController::class, 'addSpk'])->name('send');
        Route::get('/add', [SpkController::class, 'goToSpkAdd'])->name('add');
        Route::get('/update-form/{id}', [SpkController::class, 'showSpkUpdate'])->name('update-form');
        Route::put('/update/{id}', [SpkController::class, 'updateSpk'])->name('update');
        Route::delete('/remove-fpk/{id}', [SpkController::class, 'removeSpk'])->name('remove');
        Route::get('/filter', [SpkController::class, 'filter'])->name('filter');
        Route::get('/{id}', [SpkController::class, 'showFpkEmployee'])->name('empl');
        Route::get('/', [SpkController::class, 'showFpkEmplsList'])->name('list');
    });

    Route::prefix('/edu-plan')->name('edu-plan.')->group(function () {
        Route::post('/add/send', [EduPlanController::class, 'addPlan'])->name('send');
        Route::get('/add', [EduPlanController::class, 'showPlanAdd'])->name('add');
        Route::get('/update-form/{id}', [EduPlanController::class, 'showPlanUpdate'])->name('update-form');
        Route::put('/update/{id}', [EduPlanController::class, 'updatePlan'])->name('update');
        Route::delete('/delete-edu-plan/{id}', [EduPlanController::class, 'deleteEduPlan'])->name('delete');
        Route::get('/', [EduPlanController::class, 'showPlans'])->name('list');
    });

    Route::prefix('/empls')->name('empls.')->group(function () {
        Route::post('/sort-filter', [EmployeesController::class, 'sortFilter'])->name('sort-filter');
        Route::get('/edit/{id}', [EditController::class, 'goToProfileEditing'])->name('edit');
        Route::delete('/delete-empl/{id}', [EditController::class, 'deleteEmployee'])->name('delete');
        Route::get('/', [EmployeesController::class, 'showEmployees'])->name('list');
    });

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
});

Route::get('/logout', [AuthController::class, 'logout']);


Route::get('/register', [AuthController::class, 'showRegForm']);
Route::post('/register/reg', [AuthController::class, 'register']);


Route::post('/edit/{id}/update', [EditController::class, 'update']);
Route::get('/create-user', [EditController::class, 'showCreationForm']);
Route::post('/create', [EditController::class, 'create']);

Route::get('/kafedra-prikladnoj-matematiki-i-informatiki', [PageController::class, 'goToDepartment']);

Route::get('/kafedra-prikladnoj-matematiki-i-informatiki/{id}', [PageController::class, 'goToPersonalCard']);
