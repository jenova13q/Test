<?php
/**
 * Created by PhpStorm.
 * User: Jenova13
 * Date: 01.09.16
 * Time: 21:46
 */
use jenova13q\Test\Http\Controllers;
use jenova13q\Test\Models\Product as Product;


Route::group(array('namespace' => 'jenova13q\Test\Http\Controllers'), function () {
	Route::group(array('prefix' => 'product'), function () {
		Route::get('/{id}', 'ProductsCtrl@show')->where(array('id' => '[0-9]+'));
		Route::post('/', 'ProductsCtrl@store');
		Route::put('/{id}', 'ProductsCtrl@update')->where(array('id' => '[0-9]+'));
		Route::delete('/{id}', 'ProductsCtrl@destroy')->where(array('id' => '[0-9]+'));
	});
	Route::get('products', 'ProductsCtrl@index');
});