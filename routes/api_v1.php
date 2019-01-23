<?php

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

Route::get('companies', 'CompanyController@getCompanies');
Route::post('companies', 'CompanyController@postCompany');

Route::get('companies/{id}', 'CompanyController@getCompany');
Route::put('companies/{id}', 'CompanyController@putCompany');

Route::post('companies/upload', 'CompanyController@uploadImage');

Route::get('companies/{id}/assets', 'CompanyController@getCompanyAssets');
Route::post('companies/{id}/assets', 'CompanyController@postCompanyAsset');

Route::post('companies/upload', 'CompanyController@uploadImage');




