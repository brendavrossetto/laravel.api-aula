<?php

use App\Http\Controllers\PeopleController;
use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return response()->json([
        'message' => 'ok'
    ]);
});

Route::get('/somar', function (Request $request) {
    if (count($request->all()) < 1) {
        return response()->json([
            'massage' => 'Não há valores para somar'
        ], 406);
    }
    $soma = array_sum($request->all());
    return response()->json([
        'message' => 'somado com sucesso',
        'sum' => $soma,
    ]);
});

// /people/list 
Route::prefix('/people')->group(function () {
    Route::get(
        '/list',
        [PeopleController::class, 'list']
    );

    Route::post(
        '/store',
        [PeopleController::class, 'store']
    );

    Route::post(
        '/storeInterests',
        [PeopleController::class, 'storeInterests']
    );
});
