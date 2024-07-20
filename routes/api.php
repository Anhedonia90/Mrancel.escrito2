<?php

use App\Http\Controllers\PersonaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/alta', [PersonaController::class, 'alta']);
Route::delete("/baja/{id}",[PersonaController::class,"baja"]);