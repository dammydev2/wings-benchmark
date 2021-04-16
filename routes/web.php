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

Route::get('/', function () {
    return view('index');
});

Route::get('/index', function () {
    return view('index');
});


Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/rider', 'HomeController@rider');

Route::get('/addrider', 'HomeController@addrider');

Route::get('/expenses', 'HomeController@expenses');

Route::get('/order', 'HomeController@order');

Route::get('/special', 'HomeController@special');

Route::get('/addorder', 'HomeController@addorder');

Route::get('/addspecial', 'HomeController@addspecial');

Route::get('/enterpayment', 'HomeController@enterpayment');

Route::get('/print', 'HomeController@print');

Route::get('/expense', 'HomeController@expense');

Route::get('/deposit', 'HomeController@deposit');

Route::get('/addnewdeposit', 'HomeController@addnewdeposit');

Route::get('/sales', 'HomeController@sales');

Route::get('/consign', 'HomeController@consign');

Route::get('/salesrider', 'HomeController@salesrider');

Route::get('/customer', 'HomeController@customer');

Route::get('/specialcustomer', 'HomeController@specialcustomer');

Route::get('/pay', 'HomeController@pay');

Route::get('/worker', 'HomeController@worker');

Route::get('/addworker', 'HomeController@addworker');

Route::get('/checkQR', 'HomeController@checkQR');

Route::get('/reassign', 'HomeController@reassign');

Route::get('/rideredit/{id}', 'HomeController@rideredit');

Route::get('/edit/{id}', 'HomeController@edit');

Route::get('/addeposit/{id}', 'HomeController@addeposit');

Route::get('/riderdelete/{id}', 'HomeController@riderdelete');

Route::get('/workerdelete/{id}', 'HomeController@workerdelete');

Route::get('/assign/{id}', 'HomeController@assign');

Route::get('/orderdelete/{id}', 'HomeController@orderdelete');

Route::get('/specialdelete/{id}', 'HomeController@specialdelete');

Route::get('/delivered/{id}', 'HomeController@delivered');

Route::get('/expensedelete/{id}', 'HomeController@expensedelete');

Route::get('/Oassign', 'HomeController@Oassign');

Route::get('/unassigned', 'HomeController@unassigned');

Route::post('/newrider', 'HomeController@newrider');

Route::post('/enterexpense', 'HomeController@enterexpense');

Route::post('/updaterider', 'HomeController@updaterider');

Route::post('/neworder', 'HomeController@neworder');

Route::post('/addpayment', 'HomeController@addpayment');

Route::post('/inputpayment', 'HomeController@inputpayment');

Route::post('/addnewings', 'HomeController@addnewings');

Route::post('/updatewings', 'HomeController@updatewings');

Route::post('/updateorder', 'HomeController@updateorder');

Route::post('/getexpense', 'HomeController@getexpense');

Route::post('/getsales', 'HomeController@getsales');

Route::post('/getrider', 'HomeController@getrider');

Route::post('/getcustomer', 'HomeController@getcustomer');

Route::post('/getspecialcustomer', 'HomeController@getspecialcustomer');

Route::post('/getpayment', 'HomeController@getpayment');

Route::post('/enterworker', 'HomeController@enterworker');

Route::post('/editPayment', 'HomeController@editPayment');

Route::post('/getriderwork', 'HomeController@getriderwork');

Route::get('/riderwork', 'HomeController@riderwork');

Route::post('/sendmail', 'HomeController@sendmail');

Route::post('/sendmail2', 'HomeController@sendmail2');

Route::post('/multipleQR', 'HomeController@multipleQR');

Route::post('/singleQR', 'HomeController@singleQR');

Route::post('/doreassign', 'HomeController@doreassign');

Route::post('/update', 'HomeController@update');

Route::get('/search','HomeController@search');

Route::get('/search2','HomeController@search2');

Route::post('/getassign','HomeController@getassign');

Route::get('/pagination/fetch_data', 'HomeController@fetch_data');

Route::post('/pagination/fetch_data', 'HomeController@fetch_data');

Route::get('/pagination/fetch_data2', 'HomeController@fetch_data2');

Route::post('/pagination/fetch_data2', 'HomeController@fetch_data2');


