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


Route::post('/getThemes', 'ApisController@getThemes')->name('getThemes');

Route::post('/getAllIndicators', 'ApisController@getAllIndicators')->name('getAllIndicators');

Route::post('/getAllIndicatorsDetail', 'ApisController@getAllIndicatorsDetail')->name('getAllIndicatorsDetail');

Route::post('/getIndicatorsList', 'ApisController@getIndicatorsList')->name('getIndicatorsList');

Route::post('/getSourceName', 'ApisController@getSourceName')->name('getSourceName');

Route::post('/getSourceyear', 'ApisController@getSourceyear')->name('getSourceyear');

Route::post('/getHeadlineIndicator', 'ApisController@getHeadlineIndicator')->name('getHeadlineIndicator');

Route::post('/getChildSpecifics', 'ApisController@getChildSpecifics')->name('getChildSpecifics');

Route::post('/getHeadlineSpecific', 'ApisController@getHeadlineSpecific')->name('getHeadlineSpecific');

Route::post('/getChildIndicator', 'ApisController@getChildIndicator')->name('getChildIndicator');

Route::post('/getChildIndicatorByDivision', 'ApisController@getChildIndicatorByDivision')->name('getChildIndicatorByDivision');

Route::post('/getChildIndicatorByDistrict', 'ApisController@getChildIndicatorByDistrict')->name('getChildIndicatorByDistrict');
