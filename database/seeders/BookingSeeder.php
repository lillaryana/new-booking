<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Booking::create([
            'id_user' => 1,
            'id_room' => 1,
            'start_time' => '2023-10-01 10:00:00',
            'end_time' => '2023-10-01 12:00:00',
            'status' => 'confirmed',
        ]);
        
        Booking::create([
            'id_user' => 2,
            'id_room' => 2,
            'start_time' => '2023-10-02 14:00:00',
            'end_time' => '2023-10-02 16:00:00',
            'status' => 'pending',
        ]);
    }
}
