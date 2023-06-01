<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthToken as AuthToken;

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

Route::post('/token/auth', [AuthToken::class, 'store'])->name('auth.token.store');
