<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ManagerController;
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
    return view('auth.super-login');
});

Route::get('refresh-csrf', function(){
    return csrf_token();
});

Route::group(['middleware' => 'auth'], function (){
    Route::group(['middleware' => ['can:company']], function () {
        Route::get('employee-manage', [CompanyController::class, 'manageEmployee'])->name('company.employee-manage');
        Route::get('employee-add', [CompanyController::class, 'addEmployee'])->name('company.employee-add');
        Route::get('employee-edit/{id}', [CompanyController::class, 'editEmployee'])->name('company.employee-edit');
        Route::post('employee-save', [CompanyController::class, 'saveEmployee'])->name('company.employee-save');
        Route::post('employee-delete', [CompanyController::class, 'deleteEmployee'])->name('company.employee-delete');
        Route::post('employee-table', [CompanyController::class, 'tableEmployee'])->name('company.employee-table');

        Route::get('noti-manage', [CompanyController::class, 'manageNoti'])->name('company.noti-manage');
        Route::get('noti-add', [CompanyController::class, 'addNoti'])->name('company.noti-add');
        Route::get('noti-edit/{id}', [CompanyController::class, 'editNoti'])->name('company.noti-edit');
        Route::post('noti-save', [CompanyController::class, 'saveNoti'])->name('company.noti-save');
        Route::post('noti-delete', [CompanyController::class, 'deleteNoti'])->name('company.noti-delete');
        Route::post('noti-table', [CompanyController::class, 'tableNoti'])->name('company.noti-table');

        Route::get('doc-manage', [CompanyController::class, 'manageDoc'])->name('company.doc-manage');
        Route::get('doc-add', [CompanyController::class, 'addDoc'])->name('company.doc-add');
        Route::get('doc-edit/{id}', [CompanyController::class, 'editDoc'])->name('company.doc-edit');
        Route::post('doc-save', [CompanyController::class, 'saveDoc'])->name('company.doc-save');
        Route::post('doc-delete', [CompanyController::class, 'deleteDoc'])->name('company.doc-delete');
        Route::post('doc-table', [CompanyController::class, 'tableDoc'])->name('company.doc-table');
    });
});

require __DIR__.'/auth.php';
