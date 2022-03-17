<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileUpload;
use App\Http\Controllers\Projekt;

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

Route::get('/upload-file', [FileUpload::class, 'createForm']);
Route::get('/import-file', [Projekt::class, 'importSpreedSheet']);
Route::get('/projects', [Projekt::class, 'getProjects']);
Route::post('/load-project', [Projekt::class, 'getAllProjects']);

Route::post('/upload-file', [FileUpload::class, 'uploadFile'])->name('uploadFile');

