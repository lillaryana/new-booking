<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $bookings = Booking::with(['user', 'room'])->get();

       return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
         $rooms = Room::where('status', 'available')->get();

        $users = User::all();

        return view('bookings.create', compact('users', 'rooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_user'      => 'required|exists:users,id',
            'id_room'      => 'required|exists:rooms,id',
            'date'          => 'required|date|after_or_equal:today',
            'start_time'    => 'required|date_format:H:i',
            'end_time'      => 'required|date_format:H:i|after:start_time',
            'status'        => 'in:pending,confirmed,canceled',
        ]);

        // Check for overlapping bookings
        $overlap = Booking::where('id_room', $data['id_room'])
            ->whereDate('date', $data['date'])
            ->where(function($query) use ($data) {
                $query->whereBetween('start_time', [$data['start_time'], $data['end_time']])
                      ->orWhereBetween('end_time', [$data['start_time'], $data['end_time']])
                      ->orWhere(function($q) use ($data) {
                          $q->where('start_time', '<=', $data['start_time'])
                            ->where('end_time', '>=', $data['end_time']);
                      });
            })
            ->exists();

        if($overlap) {
            return response()->json(['message' => 'The room is already booked for the selected time slot.'], 422);
        }

        $booking = Booking::create([
            'id_user'    => auth()->id(),
            'id_room'    => $data['id_room'],
            'date'       => $data['date'],
            'start_time' => $data['start_time'],
            'end_time'   => $data['end_time'],
            'status'     => 'pending',
        ]);

        $room = Room::find($data['id_room']);
        $room->update(['status' => 'booked']);

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        return $booking->load(['room:id,name', 'user:id,name']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        $rooms = Room::where('status', 'available')
                        ->orWhere('id_room', $booking->id_room)
                        ->get();

        $users = User::all();

        return view('bookings.edit', compact('booking', 'rooms', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $data = $request->validate([
        'customer_name' => 'sometimes|required|string|max:255',
        'id_room'       => 'sometimes|required|exists:rooms,id',
        'date'          => 'sometimes|required|date|after_or_equal:today',
        'start_time'    => 'sometimes|required|date_format:H:i',
        'end_time'      => 'sometimes|required|date_format:H:i|after:start_time',
        'status'        => 'sometimes|in:pending,confirmed,canceled',
        ]);

       $booking->update($data);

      if (isset($data['status'])) {
        $room = Room::find($booking->id_room);

        if ($data['status'] === 'canceled') {
            $room->update(['status' => 'available']);
        } else {
            $room->update(['status' => 'booked']);
        }
       }
       return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
       $room = Room::find($booking->id_room);
       $room->update(['status' => 'available']);

        $booking->delete();

        return response()->noContent();
    }
}
