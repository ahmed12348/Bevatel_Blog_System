<?php

use App\Exports\BlogExport;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Imports\BlogImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

// Route::get('/{any}', function () {
//     return view('welcome');
// })->where('any', '.*');

Route::middleware('auth')->get('/', function () {
    return redirect()->route('dashboard.index');

});



Auth::routes();

// Routes for authenticated users with the /dashboard prefix Authentication Routes
Route::middleware('auth')->prefix('dashboard')->name('dashboard.')->group(function () {

    // Default dashboard route
    Route::resource('/', DashboardController::class);
   


    // Resource routes within /dashboard prefix
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('blogs', BlogController::class);
  

  
    // Route::get('blogs/export', [BlogController::class, 'export'])->name('blogs.export');
     Route::post('blogs/import', [BlogController::class, 'import'])->name('blogs.import');
     Route::get('export', [BlogController::class, 'export'])->name('blogs.export'); // Corrected route
     Route::get('dashboard/blogs/download-sample', [BlogController::class, 'downloadSample'])->name('blogs.downloadSample');


});
