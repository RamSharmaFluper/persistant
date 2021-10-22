<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/signup', 'Api@signup');
Route::post('/login', 'Api@login');
Route::Put('/updateRouterByIp', 'Api@updateRouterByIp');
Route::post('/createRouter', 'Api@createRouter');
Route::get('/getRouterBySapId/{sapid}', 'Api@getRouterBySapId');
Route::delete('/deleteRouterByIp', 'Api@deleteRouterByIp');





