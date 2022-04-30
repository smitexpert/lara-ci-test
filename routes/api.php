<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\HotelController;
use App\Http\Controllers\api\HotelRoomController;
use App\Http\Controllers\MigrationController;
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
Route::get('', function () {
    return response([
        'status' => 200,
        'message' => 'Api status is okay'
    ]);
});

Route::post('register', [AuthController::class, 'createNewUser']);

Route::post('login', [AuthController::class, 'login']);

Route::get('migrate', [MigrationController::class, 'migrateDatabase']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('{hotelId}/hotel-rooms', [HotelRoomController::class, 'getHotelRooms']);
    Route::get('room/{roomId}', [HotelRoomController::class, 'getHotelRoomDetails']);
    Route::get('hotels', [HotelController::class, 'getAllHotels']);
    Route::get('hotels/{hotelId}', [HotelController::class, 'getHotelDetails']);
    Route::get('hotels/searchByHotel/{query}', [HotelController::class, 'searchHotel']);
    Route::post('add-new-hotel', [HotelController::class, 'addNewHotel']);
    Route::put('update-hotel', [HotelController::class, 'updateHotel']);
    Route::delete('delete-hotel', [HotelController::class, 'deleteHotel']);
    Route::delete('logout', [AuthController::class, 'logOut']);
});

