@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Rooms</h1>

    <div class="row">
        @foreach($rooms as $room)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                @if($room->image)
                    <img src="{{ asset('storage/'.$room->image) }}" class="card-img-top" alt="{{ $room->name }}">
                @else
                    <img src="https://via.placeholder.com/400x200?text=No+Image" class="card-img-top" alt="No image">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $room->name }}</h5>
                    <p class="card-text">{{ $room->description }}</p>
                    <p><strong>Harga:</strong> Rp {{ number_format($room->price,0,',','.') }}</p>
                    <p>
                        <span class="badge bg-{{ $room->status == 'available' ? 'success' : 'danger' }}">
                            {{ ucfirst($room->status) }}
                        </span>
                    </p>
                </div>
                <div class="card-footer">
                    @if($room->status == 'available')
                        <a href="{{ route('bookings.create', ['room_id' => $room->id]) }}" class="btn btn-primary">Book Now</a>
                    @else
                        <button class="btn btn-secondary" disabled>Not Available</button>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
