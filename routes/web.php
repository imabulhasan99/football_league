<?php

use App\Http\Controllers\Api\EplController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Pages\TeamController;
use App\Http\Controllers\Pages\AddLeagueController;

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
Route::get('/',[HomeController::class,'index'])->name('home')->middleware('auth');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/',[HomeController::class,'index'])->name('home');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});


Route::prefix('league')->middleware('auth')->group(function () {
    Route::get('/add-league', [AddLeagueController::class,'index'])->name('league.add');
    Route::post('/add-league', [AddLeagueController::class,'create'])->name('league.create');
    Route::get('/all-league', [AddLeagueController::class,'allLeague'])->name('league.all');
    Route::get('/edit-league/{id}', [AddLeagueController::class,'editLeague'])->name('league.edit');
    Route::put('/edit-league/{uuid}', [AddLeagueController::class,'updateLeague'])->name('league.update');
    Route::delete('/delete-league/{uuid}',[AddLeagueController::class,'deleteLeague'])->name('league.delete');
});

Route::prefix('team')->middleware('auth')->group(function () {
    Route::get('/add-team', [TeamController::class,'index'])->name('team.add');
    Route::post('/add-team', [TeamController::class,'create'])->name('team.create');
    Route::get('/all-team', [TeamController::class,'allTeam'])->name('team.all');
    Route::get('/edit-team/{id}', [TeamController::class,'editTeam'])->name('team.edit');
    Route::put('/edit-team/{id}', [TeamController::class,'updateTeam'])->name('team.update');
    Route::delete('/delete-team/{id}', [TeamController::class,'deleteTeam'])->name('team.delete');
});

Route::prefix('fixtures')->middleware('auth')->group(function () {
    Route::get('/epl-fixtures', [EplController::class,'index'])->name('team.add');
    
});

require __DIR__.'/auth.php';
