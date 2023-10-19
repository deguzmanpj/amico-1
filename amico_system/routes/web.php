<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InvController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
    return view('login');
});

Route::post('/loginpage', [InvController::class, 'showDashboard']);

Route::post('/report', [InvController::class, 'addEntry']);

Route::post('/accept_request', [InvController::class, 'acceptRequest']);

Route::post('/decline_request', [InvController::class, 'declineRequest']);

Route::post('/edit_asset', [InvController::class, 'editAsset']);

Route::get('/admin/asset_info', function () {
    return view('/admin/asset_info');
});

Route::get('employee/asset_info', function () {
    return view('/employee/asset_info');
});

Route::post('/upload', [InvController::class, 'uploadCsvFile']);

Route::get('admin/receiving_repo', function () {
    $results = DB::select('select * from receiving_report where req_status = "accepted"');
    Log::info(count((array)$results));
    $results = (array)$results;
    Log::info($results);
    return view('admin/receiving_repo', compact('results')); 
})->name('admin/receiving_repo');

Route::view('admin/ack_repo', 'admin/ack_repo')->name('admin/ack_repo');
Route::view('admin/prop_borr', 'admin/prop_borr')->name('admin/prop_borr');
Route::view('admin/main_req', 'admin/main_req')->name('admin/main_req');
Route::view('admin/calib_req', 'admin/calib_req')->name('admin/calib_req');
Route::view('admin/condemn_req', 'admin/condemn_req')->name('admin/condemn_req');
Route::view('admin/asset_info', 'admin/asset_info')->name('admin/asset_info');

Route::get('admin/pending', function () {
    $results = DB::select('select * from receiving_report where req_status = "pending" or req_status = "declined"');
    Log::info(count((array)$results));
    $results = (array)$results;
    Log::info($results);
    return view('admin/pending', compact('results')); 
})->name('admin/pending');

Route::get('employee/pending', function () {
    $results = DB::select('select * from receiving_report where req_status = "pending" or req_status = "declined"');
    Log::info(count((array)$results));
    $results = (array)$results;
    Log::info($results);
    return view('employee/pending', compact('results')); 
})->name('employee/pending');


Route::get('employee/receiving_repo', function () {
    $results = DB::select('select * from receiving_report where req_status = "accepted" ');
    Log::info(count((array)$results));
    $results = (array)$results;
    Log::info($results);
    return view('employee/receiving_repo', compact('results')); 
})->name('employee/receiving_repo');

Route::view('employee/ack_repo', 'employee/ack_repo')->name('employee/ack_repo');
Route::view('employee/prop_borr', 'employee/prop_borr')->name('employee/prop_borr');
Route::view('employee/main_req', 'employee/main_req')->name('employee/main_req');
Route::view('employee/calib_req', 'employee/calib_req')->name('employee/calib_req');
Route::view('employee/condemn_req', 'employee/condemn_req')->name('employee/condemn_req');
Route::view('employee/asset_info', 'employee/asset_info')->name('employee/asset_info');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
