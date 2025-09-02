<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        Room::create([
            'name' => 'Deluxe Room',
            'description' => 'A luxurious room with a king-size bed, ensuite bathroom, and city view.',
            'price' => 150.00,
            'status' => 'available',
            'image' => 'deluxe_room.jpg',
        ]);

        Room::create([
            'name' => 'Standard Room',
            'description' => 'A comfortable room with a queen-size bed and basic amenities.',
            'price' => 100.00,
            'status' => 'available',
            'image' => 'standard_room.jpg',
        ]);

        Room::create([
            'name' => 'Suite',
            'description' => 'A spacious suite with a living area, kitchenette, and premium furnishings.',
            'price' => 250.00,
            'status' => 'unavailable',
            'image' => 'suite_room.jpg',
        ]);
    }   
}
