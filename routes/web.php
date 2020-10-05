<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

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

Route::resources([
    'contact' => ContactController::class,
]);

Route::get('/showAllContacts', [ContactController::class, 'showAllContacts']);
Route::get('contact/{id}', [ContactController::class, 'show']);
Route::put('contact/{id}', [ContactController::class, 'update']);
Route::post('contact/{id}',[ContactController::class, 'softDelete']);
