<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HL7\HL7Controller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



//Route::post('/hl7', [HL7Controller::class, 'envioMWL'])->name('hl7.envioMWL2');


Route::post('send_hl7', [HL7Controller::class, 'send_hl7'])->name('send_hl7');
