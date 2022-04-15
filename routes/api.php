<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware('api_key')->group(function () {
    Route::get('/', function () {
        return response()->json([
            'status' => 'success',
            'version' => 'v1',
            'baseUrl' => 'http://localhost/api/v1'
        ]);
    });
    Route::get('tabela', [\App\Http\Controllers\WelcomeController::class, 'listar']);
    //Route::get('rodada', [\App\Http\Controllers\WelcomeController::class, 'rodada']);
    //Route::get('jogos', [\App\Http\Controllers\RodadaController::class, 'jogos']);
    Route::resource('rodadas', 'App\Http\Controllers\RodadaController');
    Route::resource('times', 'App\Http\Controllers\TimeController');
});
