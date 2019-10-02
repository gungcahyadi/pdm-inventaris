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

Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::group(['middleware' => 'guest'], function () {
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
});

Route::group(['middleware' => 'auth'], function () {

	Route::get('/', 'HomeController@index')->name('home');
	Route::post('/profile/update/{id}', 'HomeController@profileupdate');
	/* ============
	PETUGAS
	============ */
	Route::get('/petugas', 'PetugasController@index');
	Route::get('/petugas/add', 'PetugasController@create');
	Route::post('/petugas/store', 'PetugasController@store');
	Route::get('/petugas/edit/{id}', 'PetugasController@edit');
	Route::post('/petugas/update/{id}', 'PetugasController@update');
	Route::get('/petugas/delete/{id}', 'PetugasController@destroy');

	/* ============
	Inventaris
	============ */
	Route::get('/inventaris', 'InventarisController@index');
	Route::post('/inventaris/store', 'InventarisController@store');
	Route::post('/inventaris/update/{id}', 'InventarisController@update');
	Route::get('/inventaris/delete/{id}', 'InventarisController@destroy');
	/* ============
	Jenis Inventaris
	============ */
	Route::get('/jenis-inventaris', 'JenisController@index');
	Route::post('/jenis-inventaris/store', 'JenisController@store');
	Route::post('/jenis-inventaris/update/{id}', 'JenisController@update');
	Route::get('/jenis-inventaris/delete/{id}', 'JenisController@destroy');
	/* ============
	Ruang Inventaris
	============ */
	Route::get('/ruang-inventaris', 'RuangController@index');
	Route::post('/ruang-inventaris/store', 'RuangController@store');
	Route::post('/ruang-inventaris/update/{id}', 'RuangController@update');
	Route::get('/ruang-inventaris/delete/{id}', 'RuangController@destroy');
	/* ============
	Pegawai
	============ */
	Route::get('/pegawai', 'PegawaiController@index');
	Route::post('/pegawai/store', 'PegawaiController@store');
	Route::post('/pegawai/update/{id}', 'PegawaiController@update');
	Route::get('/pegawai/delete/{id}', 'PegawaiController@destroy');
	/* ============
	Peminjaman
	============ */
	Route::get('/peminjaman', 'PeminjamanController@index');
	Route::get('/peminjaman/add', 'PeminjamanController@create');
	Route::post('/peminjaman/add', 'PeminjamanController@search');
	Route::post('/peminjaman/store', 'PeminjamanController@store');
	Route::get('/peminjaman/detail/{id}', 'PeminjamanController@show');
	Route::post('/peminjaman/detail/update/{id}', 'PeminjamanController@update');
	Route::get('/peminjaman/delete/{id}', 'PeminjamanController@destroy');
	/* ============
	Pengembalian
	============ */
	Route::get('/pengembalian', 'PengembalianController@index');
	Route::get('/pengembalian/add', 'PengembalianController@create');
	Route::post('/pengembalian/add', 'PengembalianController@search');
	Route::post('/pengembalian/store', 'PengembalianController@store');
	Route::get('/pengembalian/detail/{id}', 'PengembalianController@show');
	Route::post('/pengembalian/detail/update/{id}', 'PengembalianController@update');
	Route::get('/pengembalian/delete/{id}', 'PengembalianController@destroy');
	/* ============
	Laporan
	============ */
	Route::get('/laporan-inventaris', 'ReportController@inventaris');
	Route::get('/laporan-peminjaman', 'ReportController@peminjaman');
	Route::get('/laporan-pengembalian', 'ReportController@pengembalian');
});