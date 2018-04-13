<?php

use App\Http\Resources\OptionsResource;
use App\Http\Resources\WindowsResource;
use App\Http\Resources\WprofilesResource;
use App\Http\Resources\WtypesResource;

use App\Models\Windows;
use App\Models\Wprofile;
use App\Models\Wtype;
use App\Models\Reviews;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['middleware' => ['cors']], function () {
    Route::get('windows', 'Front\WindowsController@get_windows');

    Route::get('wprofiles', function () {
        return WprofilesResource::collection(Wprofile::all());
    });

    Route::get('reviews', function () {
        return App\Http\Resources\ReviewsResource::collection(Reviews::orderBy('created_at', 'desc')->paginate());
    });

    Route::post('reviews/create', 'Front\ReviewsApiController@store');
    Route::post('reviews_images/create', 'Front\ReviewsImagesApiController@store');

    Route::get('calc_options', function () {
        return OptionsResource::get_options();
    });

    Route::get('wtypes', function () {
        return WtypesResource::collection(Wtype::has('get_windows')->get());
    });
});
