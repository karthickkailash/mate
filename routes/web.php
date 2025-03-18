<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirebaseController;
use Kreait\Firebase\Factory;

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
    return view('layout');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/contact', function () {
    return view('contact');
});

Route::get('/consultant', function () {
    return view('consultant_form');
});

Route::get('/test-firebase', function () {
    $firebase = (new Factory)
        ->withServiceAccount(storage_path('app/firebase_credentials.json'))
        ->withDatabaseUri(env('FIREBASE_DATABASE_URL')) // Use the correct URL
        ->createDatabase();
        
    return response()->json(['message' => 'Firebase connected successfully!']);
});


Route::post('/submit-form', [FirebaseController::class, 'store']);
Route::get('/fetch-data', [FirebaseController::class, 'fetch']);