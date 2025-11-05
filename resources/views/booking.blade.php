<x-app-layout>
    <div class="container py-4">
    <h1>Booking Hotel</h1>
    <form method="POST" action="{{ route('booking.book') }}">
        @csrf
        <div class="mb-3">
            <label for="room_id" class="form-label">Pilih Kamar</label>
            <select name="room_id" id="room_id" class="form-control">
                <!-- Loop kamar dari controller -->
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->name }} - {{ $room->type }} (Rp{{ $room->price }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="check_in" class="form-label">Check In</label>
            <input type="date" name="check_in" id="check_in" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="check_out" class="form-label">Check Out</label>
            <input type="date" name="check_out" id="check_out" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Booking</button>
    </form>

    <h2 class="mt-5">Riwayat Booking</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Kamar</th>
                <th>Check In</th>
                <th>Check Out</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
                <tr>
                    <td>
                        @if($booking->room)
                            {{ $booking->room->name }}
                        @else
                            <em>Kamar tidak ditemukan</em>
                        @endif
                    </td>
                    <td>{{ $booking->check_in }}</td>
                    <td>{{ $booking->check_out }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</x-app-layout>
