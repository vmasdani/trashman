<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/users', function (Request $r) {
    return User::all();
});
Route::get('/users/{id}', function (Request $r, int $id) {
    return User::query()->find($id);
});
Route::post('/users', function (Request $r) {
    $body = json_decode($r->getContent());

    $u = User::query()->updateOrCreate(['id' => isset($body?->id) ? $body?->id : null], (array) $body);
});
