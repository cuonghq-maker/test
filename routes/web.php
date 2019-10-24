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
    return view('welcome');
});

Route::get('index', [
    'as' => 'trangchu',
    'uses' => 'PageController@getIndex',
]);

Route::get('loai-san-pham/{type}', [
    'as' => 'loaisanpham',
    'uses' => 'PageController@getLoaisp',
]);

Route::get('chi-tiet-san-pham/{id}', [
    'as' => 'chitietsanpham',
    'uses' => 'PageController@getChitiet',
]);

Route::get('lien-he', [
    'as' => 'lienhe',
    'uses' => 'PageController@getLienhe',
]);

Route::get('gioi-thieu', [
    'as' => 'gioithieu',
    'uses' => 'PageController@getGioithieu',
]);

Route::get('add-to-cart/{id}', [
    'as' => 'themgiohang',
    'uses' => 'PageController@getAddtoCart',
]);

Route::get('dang-ky', [
    'as' => 'dangky',
    'uses' => 'PageController@getDangky',
]);

Route::post('dang-ky', [
    'as' => 'dangky',
    'uses' => 'PageController@postDangky',
]);

Route::get('dang-nhap', [
    'as' => 'dangnhap',
    'uses' => 'PageController@getDangnhap',
]);

Route::post('dang-nhap', [
    'as' => 'dangnhap',
    'uses' => 'PageController@postDangnhap',
]);

Route::get('dat-hang', [
    'as' => 'dathang',
    'uses' => 'PageController@getDathang',
]);

Route::get('search', [
    'as' => 'search',
    'uses' => 'PageController@getSearch',
]);

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('dang-xuat', [
    'as' => 'logout',
    'uses' => 'PageController@postLogout',
]);
