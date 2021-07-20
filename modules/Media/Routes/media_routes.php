<?php

use Illuminate\Support\Facades\Route;
use Media\Http\Controllers\MediaController;

//Route::get('/media',function (){
//   return 'media';
//});

Route::get('/media/{media}/download',[MediaController::class,'download'])->name('media.download');
