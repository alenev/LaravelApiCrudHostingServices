<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', 'App\Http\Controllers\Api\LoginController@login');

Route::middleware(['auth:api'])->group(function () {
    Route::get('/services', 'App\Http\Controllers\Api\ClientsServices\ClientServicesGetAllController@getAll');
    Route::post('/services/add', 'App\Http\Controllers\Api\ClientsServices\ClientServicesAddNewController@addNew');
    Route::get('/services/edit/{id}', 'App\Http\Controllers\Api\ClientsServices\ClientServicesEditController@edit');
    Route::get('/services/delete/{id}', 'App\Http\Controllers\Api\ClientsServices\ClientServicesDeleteController@delete');
    Route::post('/services/upgrade/{id}/{product_id}', 'App\Http\Controllers\Api\ClientsServices\ClientServiceUpDownGradeController@upDownGrade');
    Route::post('/services/downgrade/{id}/{product_id}', 'App\Http\Controllers\Api\ClientsServices\ClientServiceUpDownGradeController@upDownGrade');
    
    
});
 





