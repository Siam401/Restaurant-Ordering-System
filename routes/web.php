<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/category','CategoryController@index')->name('category.index');
    Route::get('/category/edit/{id}','CategoryController@edit')->name('category.edit');
    Route::put('/category/update/{id}','CategoryController@update')->name('category.update');
    Route::post('/category/store','CategoryController@store')->name('category.store');
    Route::delete('/category/delete/{id}','CategoryController@destroy')->name('category.destroy');
    
    Route::get('/table','TablenoController@index')->name('table.index');
    Route::get('/table/edit/{id}','TablenoController@edit')->name('table.edit');
    Route::put('/table/update/{id}','TablenoController@update')->name('table.update');
    Route::post('/table/store','TablenoController@store')->name('table.store');
    Route::delete('/table/delete/{id}','TablenoController@destroy')->name('table.destroy');
    
    Route::get('/employee','EmployeeController@index')->name('employee.index');
    Route::get('/employee/edit/{id}','EmployeeController@edit')->name('employee.edit');
    Route::put('/employee/update/{id}','EmployeeController@update')->name('employee.update');
    Route::post('/employee/store','EmployeeController@store')->name('employee.store');
    Route::delete('/employee/delete/{id}','EmployeeController@destroy')->name('employee.destroy');
    
    Route::get('/item','ItemController@index')->name('item.index');
    Route::get('/item/edit/{id}','ItemController@edit')->name('item.edit');
    Route::put('/item/update/{id}','ItemController@update')->name('item.update');
    Route::post('/item/store','ItemController@store')->name('item.store');
    Route::delete('/item/delete/{id}','ItemController@destroy')->name('item.destroy');
    
    Route::get('/setitem','SetitemController@index')->name('setitem.index');
    Route::get('/setitem/edit/{id}','SetitemController@edit')->name('setitem.edit');
    Route::put('/setitem/update/{id}','SetitemController@update')->name('setitem.update');
    Route::post('/setitem/store','SetitemController@store')->name('setitem.store');
    
    Route::get('/all/order','OrderController@allorder')->name('order.all');
    Route::get('/panding/order','OrderController@index')->name('order.index');
    Route::get('/order/complete','OrderController@completeorders')->name('order.complete');
    Route::get('/order/bill/complete','OrderController@billcomplete')->name('bill.complete');
    Route::post('/sale/search','OrderController@search')->name('order.search');
    Route::post('/sale/update/item','OrderController@updatetamp')->name('order.updatetamp');
    Route::post('/complete/sale','OrderController@completesale')->name('order.completesale');
    Route::get('/sale/item/delete/{id}','OrderController@deletetamp')->name('order.deletetamp');
    Route::get('/sale/item/all/delete','OrderController@deletetampdata')->name('order.deletetampdata');
    Route::get('/sale/add/item/{id}','OrderController@additem')->name('order.additem');
    Route::get('/sale/add/setitem/{id}','OrderController@addsetitem')->name('order.addsetitem');
    Route::get('/sale','OrderController@sale')->name('order.sale');
    Route::get('/bill/pdf','OrderController@pdf')->name('bill.pdf');
    Route::get('/order/{invoice}/pdf','OrderController@pdfview')->name('order.pdfview');
    Route::get('/order/{invoice}/bill','OrderController@billprint')->name('order.bill');
    Route::get('/order/{invoice}/preview','OrderController@preview')->name('order.preview');
    Route::get('/order/{invoice}/chef/preview','OrderController@chefpreview')->name('order.chefpreview');
   
    Route::get('/place/order','OrderController@placeOrder')->name('order.create');
    Route::get('/place/order/{id}','OrderController@storeOrdertamp')->name('order.tamp');
    Route::post('/place/set/order','OrderController@placesetOrder')->name('order.set');
    Route::post('/update/set/order','OrderController@updateItemOrder')->name('order.updateitem');
    Route::post('/send/order','OrderController@sendOrder')->name('order.send');
    Route::get('/delete/order/{id}','OrderController@deleteOrder')->name('order.delete');

    Route::get('/home', 'HomeController@index')->name('home');
});

Auth::routes();

Route::get('send','Api@Data_Send');
Route::get('OrderReceive','Api@Order_Receive');
Route::get('Cooking','Api@Cooking_Man');
Route::get('DoneCooking','Api@Cookingdone');
Route::get('OrderComplete','Api@Ordercomplete');
Route::get('LoginCheck','Api@logincheck');
Route::get('Reciptprint','Api@recipt');

//extra
Route::get('/table ','TableController@index')->name('table.data');
