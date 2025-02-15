<?php

use App\Models\Image;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\UserImage; // Import Model
use Illuminate\Support\Facades\File;
use App\Http\Controllers\ImageController;

Route::get('/', function () {
    return view('welcome');
});


Route::post("/submit",[ImageController::class,"create"])->name("submit");
