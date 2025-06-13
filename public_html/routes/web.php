<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\EduPlanController;
use App\Http\Controllers\FpkController;
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
        Route::post('/add/send', [FpkController::class, 'addFpk'])->name('send');
        Route::get('/add', [FpkController::class, 'goToFpkAdd'])->name('add');
        Route::get('/update-form/{id}', [FpkController::class, 'showFpkUpdate'])->name('update-form');
        Route::put('/update/{id}', [FpkController::class, 'updateFpk'])->name('update');
        Route::delete('/remove-fpk/{id}', [FpkController::class, 'removeFpk'])->name('remove');
        Route::get('/filter', [FpkController::class, 'filter'])->name('filter');
        Route::get('/{id}', [FpkController::class, 'showFpkEmployee'])->name('empl');
        Route::get('/', [FpkController::class, 'showFpkTable'])->name('list');
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
        Route::post('/edit/{id}/update', [EmployeesController::class, 'update'])->name('update');
        Route::get('/edit/{id}', [EmployeesController::class, 'goToProfileEditing'])->name('edit');
        Route::post('/mark-as-deleted/{id}', [EmployeesController::class, 'markAsDeleted'])->name('markAsDeleted');
        Route::post('/restore/{id}', [EmployeesController::class, 'restoreEmployee'])->name('restore');
        Route::delete('/permanent-delete/{id}', [EmployeesController::class, 'permanentDeleteEmpl'])->name('permanentDelete');
        Route::get('/create-user', [EmployeesController::class, 'showCreationForm'])->name('add');
        Route::post('/create', [EmployeesController::class, 'create'])->name('add.send');
        Route::get('/', [EmployeesController::class, 'showEmployees'])->name('list');
    });

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
});

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/register', [AuthController::class, 'showRegForm']);
Route::post('/register/reg', [AuthController::class, 'register']);

Route::get('/kafedra-prikladnoj-matematiki-i-informatiki', [PageController::class, 'goToDepartment'])->name('pmi');
Route::get('/kafedra-algebra-analysis', [PageController::class, 'departmentAlgebraAnalysis'])->name('algebra-analysis');

Route::get('/pers-card/{id}', [PageController::class, 'goToPersonalCard'])->name('pers-card');
