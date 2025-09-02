@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Booking</h2>

    <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="id_user">Nama Customer</label>
            <select name="id_user" id="id_user" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $booking->id_user == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="id_room">Pilih Room</label>
            <select name="id_room" id="id_room" class="form-control" required>
                @foreach($rooms as $room)
                    <option value="{{ $room->id_room }}" {{ $booking->id_room == $room->id_room ? 'selected' : '' }}>
                        {{ $room->name }} - Rp {{ number_format($room->price, 0, ',', '.') }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="date">Tanggal</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ $booking->date }}" required>
        </div>

        <div class="mb-3">
            <label for="start_time">Waktu Mulai</label>
            <input type="time" name="start_time" id="start_time" class="form-control" value="{{ $booking->start_time }}" required>
        </div>

        <div class="mb-3">
            <label for="end_time">Waktu Selesai</label>
            <input type="time" name="end_time" id="end_time" class="form-control" value="{{ $booking->end_time }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
