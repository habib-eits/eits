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
use Illuminate\Support\Facades\Route;


 
 
use App\Http\Controllers\ChartOfAccount;
 
   
 

 
 
 
 


 
 Route::group(['middleware' => ['CheckAdmin']], function () {

 


Route::get('/ChartOfAcc/',[ChartOfAccount::class,'ChartOfAcc']);
route::post('/ChartOfAccountSave/',[ChartOfAccount::class,'ChartOfAccountSave']);
route::post('/ChartOfAccountSaveL3/',[ChartOfAccount::class,'ChartOfAccountSaveL3']);
route::get('/ChartOfAccountDelete/{ChartOfAccountID}',[ChartOfAccount::class,'ChartOfAccountDelete']);
route::get('/ChartOfAccountEdit/{id}',[ChartOfAccount::class,'ChartOfAccountEdit']);
route::post('/ChartOfAccountUpdate/',[ChartOfAccount::class,'ChartOfAccountUpdate']);




 
   });  
// middleware end