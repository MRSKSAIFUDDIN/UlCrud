<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HeatBlastController;

Route::get('/',[HeatBlastController::class,'index'])->name('index');
Route::post('/eduadding',[HeatBlastController::class,'eduadd'])->name('eduadding');
Route::post('/forminsertaction',[HeatBlastController::class,'forminsertaction'])->name('forminsertaction');
Route::get('/delete/{id}',[HeatBlastController::class,'del'])->name('delete');
Route::get('/edit/{id}',[HeatBlastController::class,'editz'])->name('editz');
Route::post('/formeditaction',[HeatBlastController::class,'formeditaction'])->name('formeditaction');
// forminsertaction