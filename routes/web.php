<?php

use App\Http\Controllers\Acceuilcontroller;
use App\Http\Controllers\pharmacienControler;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BeneficierControler;
use App\Http\Controllers\MedecinController;
use App\Http\Controllers\MedicamentController;
use App\Http\Controllers\PROFIFLControler;
use App\Http\Controllers\settingControler;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\mmedcindashController;

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

// Routes publiques
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'submitContact'])->name('contact.submit');

// Routes d'authentification
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/forgot-password', [AuthController::class, 'showResetPasswordForm'])->name('password.request');

// Routes protégées par l'authentification
Route::middleware(['auth', 'prevent-back'])->group(function () {
    // Routes admin
    Route::prefix('admin')->middleware(['role:ADMIN'])->group(function () {
        Route::get('/', [AdminController::class, 'admin'])->name('admin.admin');
        Route::get('/users/create', [AdminController::class, 'create'])->name('admin.users.create');
        Route::post('/users', [AdminController::class, 'store'])->name('admin.users.store');
        Route::get('/users/{user}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
        Route::put('/users/{user}', [AdminController::class, 'update'])->name('admin.users.update');
        Route::delete('/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
    });

    // Routes médecin
    Route::prefix('medecin')->middleware(['role:MEDECIN,ADMIN'])->group(function () {
        Route::get('/', [MedecinController::class, 'medecin'])->name('medecin');
        Route::get('/medicaments/autocomplete', [MedecinController::class, 'autocomplete'])->name('medecin.medicaments.autocomplete');
        Route::get('/medicaments/search-advanced', [MedecinController::class, 'searchAdvanced'])->name('medicaments.search.advanced');
        Route::get('/medicaments/suggestions', [MedecinController::class, 'suggestions'])->name('medicaments.suggestions');
    });

    // Routes pharmacien
    Route::prefix('pharmacien')->middleware(['role:PHARMACIEN,ADMIN'])->group(function () {
        Route::get('/', [pharmacienControler::class, 'pharmacien'])->name('pharmacien.dashboard');
        Route::get('/medicaments/autocomplete', [pharmacienControler::class, 'autocomplete'])->name('pharmacien.medicaments.autocomplete');
        Route::get('/medicaments/search-advanced', [pharmacienControler::class, 'searchAdvanced'])->name('pharmacien.medicaments.search.advanced');
    });

    // Routes bénéficiaire
    Route::prefix('beneficiaire')->middleware(['role:BENEFICIAIRE,ADMIN'])->group(function () {
        Route::get('/', [BeneficierControler::class, 'beneficier'])->name('beneficiaire.dashboard');
        Route::get('/medicaments/autocomplete', [BeneficierControler::class, 'autocomplete'])->name('beneficiaire.medicaments.autocomplete');
        Route::get('/medicaments/search-advanced', [BeneficierControler::class, 'searchAdvanced'])->name('beneficiaire.medicaments.search.advanced');
    });

    // Routes des médicaments (accessible par les pharmaciens, médecins et admin)
    Route::prefix('medicaments')->middleware(['role:PHARMACIEN,MEDECIN,ADMIN,BENEFICIAIRE'])->group(function () {
        Route::get('/', [MedicamentController::class, 'medicament'])->name('medicament.medicament');
        Route::get('/create', [MedicamentController::class, 'create'])->name('medicament.create');
        Route::post('/', [MedicamentController::class, 'store'])->name('medicament.store');
        Route::get('/{id}/edit', [MedicamentController::class, 'edit'])->name('medicament.edit');
        Route::put('/{id}', [MedicamentController::class, 'update'])->name('medicament.update');
        Route::delete('/{id}', [MedicamentController::class, 'destroy'])->name('medicament.destroy');
        Route::get('/search', [MedicamentController::class, 'search'])->name('medicament.search');
    });

    // Routes pour le profil utilisateur
    Route::get('/profil', [PROFIFLControler::class, 'profil'])->name('profil');
    Route::put('/profil/photo', [PROFIFLControler::class, 'updatePhoto'])->name('profile.update.photo');
    Route::put('/profil/nom', [PROFIFLControler::class, 'updateNom'])->name('profile.update.nom');
    Route::put('/profil/prenom', [PROFIFLControler::class, 'updatePrenom'])->name('profile.update.prenom');
    Route::put('/profil/email', [PROFIFLControler::class, 'updateEmail'])->name('profile.update.email');
    Route::put('/profil/telephone', [PROFIFLControler::class, 'updateTelephone'])->name('profile.update.telephone');
    Route::put('/profil/password', [PROFIFLControler::class, 'updatePassword'])->name('profile.update.password');
    Route::put('/profil/specialite', [PROFIFLControler::class, 'updateSpecialite'])->name('profile.update.specialite');

    // Routes du dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/medecin/dashboard', [MedecinController::class, 'dashboard'])->name('medecin.dashboard');
    //Route::get('/beneficier/dashboard', [BeneficierController::class, 'dashboard'])->name('beneficier.dashboard');
});

// Routes des paramètres
Route::get('/parametre', [settingControler::class, 'setting'])->name('parametre');
//recherche

// dash medecin


