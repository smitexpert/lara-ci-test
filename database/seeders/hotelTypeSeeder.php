<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Carbon\Traits\Date;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class hotelTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hotel')
            ->insert([
                'name' => 'Westin',
                'stars' => 5.0,
                'address' => 'Banani, Dhaka',
                'created_at' => Carbon::now()
            ]);
    }
}
