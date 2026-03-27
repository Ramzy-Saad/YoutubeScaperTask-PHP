<?php

use App\Http\Controllers\FetchController;
use Illuminate\Support\Facades\Route;


Route::get('/', [FetchController::class, 'index']);
Route::post('/fetch', [FetchController::class, 'fetch'])->name('fetch');