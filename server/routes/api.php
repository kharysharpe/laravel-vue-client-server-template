<?php

use Backend\Processes\Things\AddThingAction;
use Backend\Processes\Things\BrowseThingsAction;
use Backend\Processes\Things\DeleteThingAction;
use Backend\Processes\Things\EditThingAction;
use Backend\Processes\Things\ReadThingAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/things', BrowseThingsAction::class);
Route::get('/things/{id}', ReadThingAction::class);

Route::post('/things', AddThingAction::class);
Route::post('/things/{id}', EditThingAction::class);

Route::delete('/things/{id}', DeleteThingAction::class);
