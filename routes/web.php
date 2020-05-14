<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Auth::routes([
    'register' => false,
    'reset' => false
]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'AdminController@index')->name('admin');
    Route::resource('/recipes', 'RecipesController');
    // unused for now
    // Route::post('recipes/{recipe}/calc', 'RecipesController@calc');

    Route::get('/recipes/{id}/duplicate', 'RecipesController@duplicate');

    Route::resource('/recipes/{recipe}/ingredients_flours', 'IngredientsFloursController')->except('destroy');
    Route::delete('/flours/{id}', 'IngredientsFloursController@destroy');

    Route::resource('/recipes/{recipe}/ingredients_liquids', 'IngredientsLiquidsController')->except('destroy');
    Route::delete('/liquids/{id}', 'IngredientsLiquidsController@destroy');

    Route::resource('/recipes/{recipe}/ingredients_others', 'IngredientsOthersController')->except('destroy');
    Route::delete('/others/{id}', 'IngredientsOthersController@destroy');

    Route::resource('/recipes/{recipe}/ingredients_sourdoughs', 'IngredientsSourdoughsController')->except('destroy');
    Route::delete('/sourdoughs/{id}', 'IngredientsSourdoughsController@destroy');

    Route::resource('/productions', 'ProductionsController')->except('create');
    Route::get('/productions/{recipe}/create', 'ProductionsController@create');
    Route::post('/productions/{production}/mark', 'ProductionsController@mark');
    Route::post('/productions/{production}/pieces_final', 'ProductionsController@piecesFinal');
});
