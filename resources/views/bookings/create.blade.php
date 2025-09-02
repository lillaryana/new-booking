@extends('layouts.app')

@section('content')
    <h2>Tambah Booking</h2>

    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf

        <div>
            <label for="id_user">Nama Customer</label><br>
            <select name="id_user" id="id_user" required>
                <option value="">-- Pilih Customer --</option>
                 @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
              @endforeach
            </select>

        </div>
        <br>

        <div>
            <label for="id_room">Pilih Room</label><br>
            <select name="id_room" id="id_room" required>
                <option value="">-- Pilih Room --</option>
                @foreach($rooms as $room)
                    <option value="{{ $room->id_room }}">
                        {{ $room->name }} - Rp {{ $room->price }}
                    </option>
                @endforeach
            </select>
        </div>
        <br>

        <div>
            <label for="date">Tanggal</label><br>
            <input type="date" name="date" id="date" required>
        </div>
        <br>

        <div>
            <label for="start_time">Waktu Mulai</label><br>
            <input type="time" name="start_time" id="start_time" required>
        </div>
        <br>

        <div>
            <label for="end_time">Waktu Selesai</label><br>
            <input type="time" name="end_time" id="end_time" required>
        </div>
        <br>

        <button type="submit">Simpan</button>
        <a href="{{ route('bookings.index') }}">Kembali</a>
    </form>
@endsection
