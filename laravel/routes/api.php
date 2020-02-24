<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Rack\IndexController;

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

/**
 * Auth
 */
Route::group(['prefix' => 'auth', 'namespace' => 'Auth', 'middleware' => 'guest:api'], function () {
    Route::get('{provider}', 'OAuthController@socialOAuth')->where('provider', 'google')->name('socialOAuth');
    Route::get('{provider}/callback', 'OAuthController@handleProviderCallback')->where('provider', 'google')->name('oauthCallback');
});

// Rack
Route::group(['prefix' => 'rack', 'namespace' => 'Rack', 'middleware' => 'api'], function () {
  Route::get('', 'IndexController');
  Route::post('', 'StoreController');
  Route::put('{Rack}', 'UpdateController');
  Route::delete('{Rack}', 'DestroyController');
});

// Folder
Route::group(['prefix' => 'folder', 'namespace' => 'Folder', 'middleware' => 'api'], function () {
  Route::get('', 'IndexController');
  Route::post('', 'StoreController');
  Route::put('{Folder}', 'UpdateController');
  Route::delete('{Folder}', 'DestroyController');
});

// Note
Route::group(['prefix' => 'note', 'namespace' => 'Note', 'middleware' => 'api'], function () {
  Route::get('', 'IndexController');
  Route::post('', 'StoreController');
  Route::put('{Note}', 'UpdateController');
  Route::delete('{Note}', 'DestroyController');
});

// Item
Route::group(['prefix' => 'item', 'namespace' => 'Item', 'middleware' => 'api'], function () {
  Route::get('', 'IndexController');
  Route::post('', 'StoreController');
  Route::put('{Item}', 'UpdateController');
  Route::delete('{Item}', 'DestroyController');
});
