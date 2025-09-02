@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Booking</h1>

    <a href="{{ route('bookings.create') }}" class="btn btn-primary mb-3">Tambah Booking</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Customer</th>
                <th>Room</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $booking)
                <tr>
                    <td>{{ $booking->user->name ?? $booking->customer_name }}</td>
                    <td>{{ $booking->room->name }}</td>
                    <td>{{ $booking->date }}</td>
                    <td>{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                    <td>{{ ucfirst($booking->status) }}</td>
                    <td>
                        <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin hapus booking?')" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada booking</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
