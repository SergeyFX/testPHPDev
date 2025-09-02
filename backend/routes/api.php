<?php
use App\Http\Controllers\RealtyController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route for search
Route::get('realties/search', [RealtyController::class, 'search']);
// Resource routes for CRUD
Route::apiResource('realties', RealtyController::class);
