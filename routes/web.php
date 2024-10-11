<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return response() -> json ([
        'message' => 'ok'
    ]);
});

Route::get('/somar', function(Request $request) {
    $soma= array_sum($request->all());
    return response()->json([
        'message' => 'somado com sucesso',
        'sum' => $soma,
    ]);

});
