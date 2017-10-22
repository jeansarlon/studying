<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', function () {
   return view('welcome');
});


Route::auth();

Route::get('/home', 'HomeController@index');
Route::group(['prefix'=>  'categorias','middleware' => 'auth'], function()
{
   Route::get('',                  ['as' => 'category.index',   'uses' => 'categoryController@index']);
   Route::post('salvar',           ['as' => 'category.store',   'uses' => 'categoryController@store']);
   Route::get('{id}/editar',       ['as' => 'category.edit',    'uses' => 'categoryController@edit']);
   Route::post('{id}/atualizar',   ['as' => 'category.update',  'uses' => 'categoryController@update']);
   Route::get('{id}/remover',      ['as' => 'category.destroy', 'uses' => 'categoryController@destroy']);

});
