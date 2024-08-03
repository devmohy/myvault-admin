<?php
use App\Http\Controllers\Auth\VerifyEmailController;
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

Route::get('/health', function(){
    return response()->json(['message' => "App working!"], 200);
});

// Route::get('/business/verify-email', [VerifyEmailController::class, 'verify'])->name('verification.verify');

Route::get('{view}', function(){
    return view('app');
})->where('view','(.*)');
