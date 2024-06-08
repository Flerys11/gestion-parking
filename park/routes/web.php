<?php

use App\Http\Controllers\gestionMonnaieController;
use Illuminate\Support\Facades\Route;

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
Route::get('/', [\App\Http\Controllers\AuthController::class, 'index'])->name('auth.login');
Route::post('/log', [\App\Http\Controllers\AuthController::class, 'login'])->name('valide.login');
Route::get('/registre', [\App\Http\Controllers\AuthController::class, 'pageRegistre'])->name('page.registre');
Route::post('/registre', [\App\Http\Controllers\AuthController::class, 'registre'])->name('valide.registre');
Route::delete('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('auth.logout');

Route::middleware(['auth', 'role:admin'])->group(function () {
    //Route::get('/accueil', [\App\Http\Controllers\AuthController::class, 'accueil'])->name('accueil');
    Route::resource('parkings', App\Http\Controllers\parkingController::class);
    Route::resource('tarifs', App\Http\Controllers\tarifController::class);
    Route::get('/monnaie', [gestionMonnaieController::class, 'monnaieUser'])->name('valide.monnaie');
    Route::get('/vm/{id}', [App\Http\Controllers\gestionMonnaieController::class, 'val'])->name('v.monnaie');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::resource('vehicules', App\Http\Controllers\vehiculeController::class);
    Route::get('/listeParkings', [App\Http\Controllers\occupationController::class, 'index'])->name('liste.parkings');
    Route::get('/add-stationnement/{id}', [App\Http\Controllers\occupationController::class, 'addPark'])->name('add.vehicule');
    Route::post('/valider', [App\Http\Controllers\occupationController::class, 'store'])->name('occupe.store');
    Route::post('/sortie', [App\Http\Controllers\occupationController::class, 'sortie'])->name('occupe.sortie');
    Route::resource('monnaieusers', App\Http\Controllers\monnaieuserController::class);
    Route::get('/voir-detail/{id}', [App\Http\Controllers\occupationController::class, 'detail_station'])->name('voir.detail');
});

Route::get('/list/station', [App\Http\Controllers\occupationController::class, 'detail_occupation'])->name('list.station');
Route::match(['get', 'post'], '/filtre/parking', [App\Http\Controllers\ParkingController::class, 'trie'])->name('test.filtre');





