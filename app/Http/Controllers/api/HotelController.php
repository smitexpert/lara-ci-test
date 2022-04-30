<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HotelController extends Controller
{
    // get all hotels
    public function getAllHotels() {
        $hotels = DB::table('hotel')->orderBy('id', 'desc')->paginate(20);
        return response([
            'status' => 200,
            'hotels' => $hotels
        ]);
    }

    // get a hotel details
    public function getHotelDetails($hotelId) {
        $hotelDetails = DB::table('hotel')
            ->where('id', $hotelId)
            ->first();
        return response([
            'status' => 200,
            'hotel' => $hotelDetails
        ]);
    }

    // get a hotel details
    public function searchHotel($query)
    {
        $hotels = DB::table('hotel')
            ->where('name', 'LIKE', "%{$query}%")
            ->get();
        return response([
            'status' => 200,
            'hotels' => $hotels
        ]);
    }

    // add a new hotel
    public function addNewHotel(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'stars' => 'required',
        ]);

        $result = DB::table('hotel')->insert([
            'name' => $request->get('name'),
            'address' => $request->get('address'),
            'stars' => $request->get('stars'),
            'created_at' => Carbon::now()
        ]);

        if ($result) {
            return response([
                'status' => 200,
                'message' => 'Hotel added successfully'
            ], 200);
        } else {
            return response([
                'status' => 500,
                'message' => 'Hotel added failed! Try again'
            ], 500);
        }
    }

    public function updateHotel(Request $request)
    {
        $request->validate([
            'hotel_id' => 'required',
            'name' => 'required',
            'address' => 'required',
            'stars' => 'required',
        ]);

        try {
            $result = DB::table('hotel')
                ->where('id', $request->get('hotel_id'))
                ->update([
                    'name' => $request->get('name'),
                    'address' => $request->get('address'),
                    'stars' => $request->get('stars'),
                    'updated_at' => Carbon::now()
                ]);
            if ($result > 0) {
                return response([
                    'status' => 200,
                    'message' => 'Hotel data updated'
                ]);
            } else {
                return response([
                    'status' => 500,
                    'message' => 'Something went wrong.Try again'
                ]);
            }
        } catch (\Exception $exception) {
            return response([
                'status' => 500,
                'message' => $exception
            ]);
        }


    }

    public function deleteHotel(Request $request) {
        $request->validate([
            'hotel_id' => 'required'
        ]);

        $result = DB::table('hotel')
            ->where('id', $request->get('hotel_id'))
            ->delete();
        if ($result > 0) {
            return response([
                'status' => 200,
                'message' => 'Hotel data deleted'
            ]);
        } else {
            return response([
                'status' => 500,
                'message' => 'Something went wrong.Try again'
            ]);
        }
    }
}
