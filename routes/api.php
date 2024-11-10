<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\lang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');




Route::controller(PostController::class)->group(function(){
    Route::get('/posts/{lang?}', 'index')
         ->defaults('lang', 'ar');

    Route::get('/showposts/{id}/{lang?}', 'show_allpost_to_user')
         ->defaults('lang', 'ar');

    Route::get('/singlepost/{id}/{lang?}', 'singlepost')
         ->defaults('lang', 'ar');
})->middleware(lang::class);

Route::controller(PostController::class)->group(function (){
    Route::post('/createpost', 'createpost');
    Route::put('/updatepost/{id}', 'updatepost');
    Route::delete('/deletepost/{id}', 'deletepost');

});


Route::controller( CommentController::class)->group(function (){
    Route::post('/mycomments', 'mycomments');
    // Route::put('/updatepost/{id}', 'updatepost');
    // Route::delete('/deletepost/{id}', 'deletepost');

});




