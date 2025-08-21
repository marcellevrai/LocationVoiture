<?php

use App\Http\Controllers\Admin\AdminClientController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminPaiementController;
use App\Http\Controllers\Admin\AdminProprietaireController;
use App\Http\Controllers\Admin\AdminReservationController;
use App\Http\Controllers\Admin\AdminvoitureController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ClientAuthController;
use App\Http\Controllers\Auth\ProprietaireAuthController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Proprietaire\VoitureController;
use App\Http\Controllers\Client\ReservationController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Client\VoiturePubliqueController;
use App\Http\Controllers\Proprietaire\DashboardController;
use App\Http\Controllers\Proprietaire\ProprietaireController;
use App\Http\Controllers\Proprietaire\ReservationController as ProprietaireReservationController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth client
Route::prefix('client')->name('client.')->group(function () {
    Route::get('/login', [ClientAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [ClientAuthController::class, 'login']);

    Route::get('/register', [ClientAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [ClientAuthController::class, 'register']);

    Route::post('/logout', [ClientAuthController::class, 'logout'])->name('logout');

    // dashboard après connexion
    Route::get('/dashboard', function () {
        return view('client.dashboard');
    })->middleware('auth:client')->name('dashboard');
});

// Auth proprietaire
Route::prefix('proprietaire')->name('proprietaire.')->group(function () {
    Route::get('/login', [ProprietaireAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [ProprietaireAuthController::class, 'login']);
    Route::get('/register', [ProprietaireAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [ProprietaireAuthController::class, 'register']);
    Route::post('/logout', [ProprietaireAuthController::class, 'logout'])->name('logout');

    


});

// crud
Route::middleware('auth.proprietaire')->prefix('proprietaire')->name('proprietaire.')->group(function () {
    Route::get('/voitures/create', [VoitureController::class, 'create'])->name('voitures.create');
    Route::post('/voitures', [VoitureController::class, 'store'])->name('voitures.store');
    Route::get('/voitures', [VoitureController::class, 'index'])->name('voitures.index');
    Route::put('/voitures/{voiture}', [VoitureController::class, 'update'])->name('voitures.update');
    Route::delete('/voitures/{voiture}', [VoitureController::class, 'destroy'])->name('voitures.destroy');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard'); //route after auth
    Route::get('/reservations', [ProprietaireReservationController::class, 'index'])->name('reservations.index');
    Route::get('/profil', [ProprietaireController::class, 'profil'])->name('profil');
    Route::post('/profil/update', [ProprietaireController::class, 'updateProfil'])->name('profil.update');
    Route::post('/profil/update-password', [ProprietaireController::class, 'updatePassword'])->name('profil.update_password');   
    
});



Route::get('/voitures', [VoiturePubliqueController::class, 'index'])->name('voitures.public.index');
Route::get('/voitures/{voiture}', [VoiturePubliqueController::class, 'show'])->name('voitures.public.show');
Route::get('/client/voitures', [VoiturePubliqueController::class, 'filtre'])->name('client.voitures.filtre');

Route::prefix('client')->name('reservation.')->middleware('auth.client')->group(function () {
    Route::get('/voiture/{voiture}/reserver', [ReservationController::class, 'create'])->name('create');
    Route::post('/voiture/{voiture}/reserver', [ReservationController::class, 'store'])->name('store');
    Route::get('/client/reservation/{reservation}/facture', [ReservationController::class, 'facture'])->name('facture');
    Route::get('/reservations', [ReservationController::class, 'index'])->name('index');
    Route::post('/client/reservation/{reservation}/payer', [ReservationController::class, 'paiementSimule'])->name('paiement.process');
    Route::get('/reservation/{reservation}/facturePdf', [ReservationController::class, 'telechargerFacture'])->name('facturePdf');
    Route::patch('/reservations/{id}/annuler', [ReservationController::class, 'annuler'])->name('annuler');


    
    
});
Route::middleware('auth.client')->prefix('client')->name('client.')->group(function () {
    Route::get('/profil', [ClientController::class, 'profil'])->name('profil');
    Route::post('/profil/update', [ClientController::class, 'updateProfil'])->name('profil.update');
    Route::post('/profil/update-password', [ClientController::class, 'updatePassword'])->name('profil.update_password');
});


  //route pour logout client 
Route::post('/client/logout', function () {
    Auth::guard('client')->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('client.login')->with('success', 'Déconnexion réussie.');
})->name('client.logout');


// route pour l'admin
    Route::get('admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login.form');
    Route::post('admin/login', [AdminAuthController::class, 'login'])->name('admin.login');
    Route::post('admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth.admin'])->prefix('admin')->name('admin.')->group(function(){
    Route::get('profil', [AdminAuthController::class, 'index'])->name('profil.index');
    Route::post('/profil/update-info', [AdminAuthController::class, 'updateInfo'])->name('profil.updateInfo');
    Route::post('/profil/update-password', [AdminAuthController::class, 'updatePassword'])->name('profil.updatePassword');


    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/clients', [AdminClientController::class, 'index'])->name('clients.index');
    Route::get('/clients/search', [AdminClientController::class, 'search'])->name('clients.search');

    Route::get('/proprietaires', [AdminProprietaireController::class, 'index'])->name('proprietaires.index');
    Route::get('/proprietaire/search', [AdminProprietaireController::class, 'search'])->name('proprietaires.search');

    Route::get('/proprietaires/{id}/voitures', [AdminProprietaireController::class,'voiture'])->name('proprietaires.voiture');

    Route::get('/voitures/{id}/reservations', [AdminvoitureController::class, 'reservations'])->name('voitures.reservations');

    Route::get('/reservations', [AdminReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/search', [AdminReservationController::class, 'searchByStatut'])->name('reservations.search');

    Route::get('/voitures', [AdminVoitureController::class, 'index'])->name('voitures.index');
    Route::get('/voitures/search', [AdminVoitureController::class, 'search'])->name('voitures.search');

    Route::get('/paiements', [AdminPaiementController::class, 'index'])->name('paiements.index');
    Route::get('/paiements/search', [AdminPaiementController::class, 'search'])->name('paiements.search');




});

require __DIR__.'/auth.php';
