<?php

// database/seeders/CouponSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CouponSeeder extends Seeder
{
    public function run()
    {
        DB::table('coupons')->insert([
           
            [
                'code' => 'FLAT50',
                'type' => 'fixed',
                'value' => 50.00,
                'expires_at' => Carbon::now()->addMonths(2), // Valid for 2 months
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'SUMMER21',
                'type' => 'percent',
                'value' => 15.00,
                'expires_at' => Carbon::now()->addMonths(3), // Valid for 3 months
                'is_active' => false, // Inactive coupon
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
