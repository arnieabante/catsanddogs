<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatAndDogController;

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
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});     
*/

Route::get('v1/breeds', [CatAndDogController::class, 'getBreeds']);
Route::get('v1/breeds/{type}', [CatAndDogController::class, 'getBreedImagesPerType']);
Route::get('v1/list', [CatAndDogController::class, 'getImageList']);
Route::get('v1/list/{type}/{id}', [CatAndDogController::class, 'getBreedImagePerId']);