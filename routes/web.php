<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AdminController;
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

// =======================================================
// GENERAL ROUTES
// =======================================================
    // Load the WELCOME page
Route::get('/', [RouteController::class, 'welcome'])
    ->name('welcome');
    
    // Check the TYPE of the USER
Route::get('/checkUserType', [RouteController::class, 'checkUserType'])
    ->middleware('auth')
    ->name('checkUserType');

// =======================================================
// ADMIN ROUTES
// =======================================================

    // LOAD the ADMIN PANEL for the user
Route::get('/admin', [AdminController::class, 'admin'])
    ->middleware(['auth', 'admin'])
    ->name('admin');

    // SEARCH for a USER
Route::post('/searchUser', [AdminController::class, 'searchUser'])
    ->middleware(['auth', 'admin'])
    ->name('searchUser');

    // ADD a new USER
Route::post('/addUser', [AdminController::class, 'addUser'])
    ->middleware(['auth', 'admin'])
    ->name('addUser');

    // CHANGE the user's PRIVILEGES
Route::post('/changePrivilege/{id}', [AdminController::class, 'changePrivilege'])
    ->middleware(['auth', 'admin'])
    ->name('changePrivilege');

    // DELETE the selected USER
Route::post('/deleteUser/{id}', [AdminController::class, 'deleteUser'])
    ->middleware(['auth', 'admin'])
    ->name('deleteUser');

// =======================================================
// DASHBOARD ROUTES
// =======================================================

    // load the DASHBOARD for the user
Route::get('/dashboard', [DashController::class, 'dashboard'])
    ->middleware('auth')
    ->name('dashboard');

    // SEARCH for a PATIENT
Route::post('/searchPatient', [DashController::class, 'searchPatient'])
    ->middleware('auth')
    ->name('searchPatient');

    // ADD a new PATIENT
Route::post('/addPatient', [DashController::class, 'addPatient'])
    ->middleware('auth')
    ->name('addPatient');

    // Make a PREDICTION
Route::post('/makePrediction', [DashController::class, 'makePrediction'])
->middleware('auth')
->name('makePrediction');

// =======================================================
// PATIENT SUMMARY ROUTES
// =======================================================

    // Load the SUMMARY of a specific PATIENT
Route::get('/patientSummary/{id_number}', [PatientController::class, 'patientSummary'])
    ->middleware('auth')
    ->name('patientSummary');

    // Load the SUMMARY of a specific PATIENT
Route::post('/patientSummary/{id_number}', [PatientController::class, 'patientSummary'])
    ->middleware('auth')
    ->name('patientSummary');

    // ======================================================================================
    // LEFT HAND PANEL
    // ======================================================================================

    // ADD a new ALLERGY to a specific patient
Route::post('/addAllergy', [PatientController::class, 'addAllergy'])
    ->middleware('auth')
    ->name('addAllergy');

    // DELETE the selected ALLERGY
Route::post('/deleteAllergy/{id}', [PatientController::class, 'deleteAllergy'])
    ->middleware('auth')
    ->name('deleteAllergy');

    // ======================================================================================
    // UPDATE PATIENT DATA
    // ======================================================================================

    // UPDATE the LAST NAME of the current patient
Route::post('/updateLName', [PatientController::class, 'updateLName'])
    ->middleware('auth')
    ->name('updateLName');

    // UPDATE the FIRST NAME of the current patient
Route::post('/updateFName', [PatientController::class, 'updateFName'])
    ->middleware('auth')
    ->name('updateFName');

    // UPDATE the DATE OF BIRTH of the current patient
Route::post('/updateDOB', [PatientController::class, 'updateDOB'])
    ->middleware('auth')
    ->name('updateDOB');

    // UPDATE the HEIGHT of the current patient
Route::post('/updateHeight', [PatientController::class, 'updateHeight'])
    ->middleware('auth')
    ->name('updateHeight');

    // UPDATE the WEIGHT of the current patient
Route::post('/updateWeight', [PatientController::class, 'updateWeight'])
    ->middleware('auth')
    ->name('updateWeight');

    // UPDATE the PHONE of the current patient
Route::post('/updatePhone', [PatientController::class, 'updatePhone'])
    ->middleware('auth')
    ->name('updatePhone');

    // UPDATE the ADDRESS of the current patient
Route::post('/updateAddress', [PatientController::class, 'updateAddress'])
    ->middleware('auth')
    ->name('updateAddress');

    // UPDATE the ACTIVATION STATUS of the current patient
Route::post('/toggleActivation', [PatientController::class, 'toggleActivation'])
    ->middleware('auth')
    ->name('toggleActivation');

    // DELETE the current PATIENT
Route::post('/deletePatient', [PatientController::class, 'deletePatient'])
    ->middleware('auth')
    ->name('deletePatient');

    // ======================================================================================
    // RIGHT HAND PANEL
    // ======================================================================================

    // ADD a new SYMPTOM to a specific patient
Route::post('/addFile', [PatientController::class, 'addFile'])
    ->middleware('auth')
    ->name('addFile');

// DELETE the selected SYMPTOM
Route::post('/deleteFile/{id}', [PatientController::class, 'deleteFile'])
    ->middleware('auth')
    ->name('deleteFile');

    // ADD a new SYMPTOM to a specific patient
Route::post('/addSymptom', [PatientController::class, 'addSymptom'])
    ->middleware('auth')
    ->name('addSymptom');

    // DELETE the selected SYMPTOM
Route::post('/deleteSymptom/{id}', [PatientController::class, 'deleteSymptom'])
    ->middleware('auth')
    ->name('deleteSymptom');

    // ADD a new PRESCRIPTION to a specific patient
Route::post('/addPrescription', [PatientController::class, 'addPrescription'])
    ->middleware('auth')
    ->name('addPrescription');

    // DELETE the selected PRESCRIPTION
Route::post('/deletePrescription/{id}', [PatientController::class, 'deletePrescription'])
    ->middleware('auth')
    ->name('deletePrescription');

    // ADD a new NOTE to a specific patient
Route::post('/addNote', [PatientController::class, 'addNote'])
    ->middleware('auth')
    ->name('addNote');

    // DELETE the selected NOTE
Route::post('/deleteNote/{id}', [PatientController::class, 'deleteNote'])
    ->middleware('auth')
    ->name('deleteNote');

// =======================================================
// MIDDLEWARE
// =======================================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
