<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\ChangeLogController;
use App\Http\Controllers\Api\NewsLetterController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\IdentityController;

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

Route::get('galleries/{id}/others', [GalleryController::class, 'getOtherGalleries']);
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

Route::get('changelogs-contents/{typeName}', [ChangeLogController::class, 'filterByTypeContents']);
Route::get('changelogs-contents', [ChangeLogController::class, 'indexContents']);

Route::apiResource('newsletter', NewsLetterController::class);
Route::apiResource('contact', ContactController::class);

Route::get('identities/featured', [IdentityController::class, 'showFeatured']);
Route::apiResource('identities', IdentityController::class);