<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::get('register','MerchantController@showMerchantCreate');
Route::post('merchant/create','MerchantController@create');
Route::get('login','MerchantController@showMerchantLogin');
Route::post('login','UserController@login');
Route::get('logout','UserController@logout');
Route::group(array('before' => 'auth'), function()
{
    Route::get('/','MerchantController@dashboard');
    Route::get('profile','UserController@profile');
    Route::put('user/{id}','UserController@update');
    Route::resource('item', 'ItemController');
    Route::resource('category', 'CategoryController');
    Route::resource('discount', 'DiscountController');
    Route::get('/discount/{id}/items','DiscountController@items');
    Route::resource('page', 'PageController');
    /*
    Route::get('item/getItemDetails/{id}',function($id){
    	$item = new Item;
    	$item_details = $item->getItemDetails($id);
    	printpre($item_details->images());
    	//return Response::view('modal_item_details',array('item'=>$item->getItemDetails($id)));
    });
    */
});

/*JQuery Fileupload*/
Route::get('upload/{resource}','UploadController@upload');
Route::post('upload/{resource}','UploadController@upload');
Route::delete('upload/{resource}','UploadController@upload');
