<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\ChangeLogController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('galleries/featured', [GalleryController::class, 'showFeatured']);
Route::apiResource('galleries', GalleryController::class);
Route::get('/galleries/tag/{tagId}', [GalleryController::class, 'filterByTag']);
Route::get('/galleries/{galleryId}/images', [ImageController::class, 'index']);
Route::get('/galleries/{galleryId}/images/{imageId}', [ImageController::class, 'show']);

Route::get('blogs/{id}/others', [BlogController::class, 'getOtherBlogs']);
Route::get('blogs/featured', [BlogController::class, 'showFeatured']);
Route::apiResource('blogs', BlogController::class);

Route::get('changelogs/{typeName}', [ChangeLogController::class, 'filterByType']);
Route::apiResource('changelogs', ChangeLogController::class);
