<x-admin-layout>

    <div class="py-10 max-w-7xl mx-auto">

        {{-- Header + New Button --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-purple-300 drop-shadow">📝 Reservations</h1>

            <a href="{{ route('admin.reservation.create') }}"
               class="px-6 py-2 bg-purple-600 hover:bg-purple-700 rounded-xl neon text-white shadow">
                + New Reservation
            </a>
        </div>

        {{-- Search Form --}}
        <form action="{{ route('admin.reservation.index') }}" method="GET" class="mb-4 flex items-center gap-2">
            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search by name or phone"
                   class="p-2 rounded border border-yellow-400 bg-black/30 text-white flex-1"/>
            <button type="submit" class="px-4 py-2 bg-yellow-400 text-black rounded hover:bg-yellow-500 transition">
                Search
            </button>
            <a href="{{ route('admin.reservation.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition">
                Reset
            </a>
        </form>

        {{-- Table Container --}}
        <div class="bg-white/5 backdrop-blur-xl shadow-xl border border-white/10 rounded-2xl p-6 overflow-x-auto">

            <table class="w-full text-gray-300">
                <thead class="text-xs uppercase tracking-wide text-purple-300 border-b border-white/10">
                <tr>
                    <th class="py-3 px-4 text-left">Name</th>
                    <th class="py-3 px-4 text-left">Email</th>
                    <th class="py-3 px-4 text-left">Phone</th>
                    <th class="py-3 px-4 text-left">Reservation Date</th>
                    <th class="py-3 px-4 text-left">Start Time</th>
                    <th class="py-3 px-4 text-left">End Time</th>
                    <th class="py-3 px-4 text-left">Table</th>
                    <th class="py-3 px-4 text-left">Guest Number</th>
                    <th class="py-3 px-4 text-left">Status</th>
                    <th class="py-3 px-4 text-left">Actions</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($reservations as $reservation)
                    <tr class="border-b border-white/5 hover:bg-white/10 transition">
                        <td class="py-4 px-4 font-medium">{{ $reservation->first_name }} {{ $reservation->last_name }}</td>
                        <td class="py-4 px-4">{{ $reservation->email }}</td>
                        <td class="py-4 px-4">{{ $reservation->tel_number }}</td>
                        {{-- Display date only --}}
                        <td class="py-4 px-4">{{ \Carbon\Carbon::parse($reservation->res_date)->format('Y-m-d') }}</td>
                        {{-- Display time in AM/PM --}}
                        <td class="py-4 px-4">{{ \Carbon\Carbon::parse($reservation->res_start_time)->format('h:i A') }}</td>
                        <td class="py-4 px-4">{{ \Carbon\Carbon::parse($reservation->res_end_time)->format('h:i A') }}</td>
                        {{-- Show table name --}}
                        <td class="py-4 px-4">{{ $reservation->table->name }}</td>
                        <td class="py-4 px-4">{{ $reservation->guest_number }}</td>
                        <td class="py-4 px-4">{{ $reservation->status }}</td>
                        <td class="py-4 px-4 flex gap-2">
                            <form action="{{ route('admin.reservation.destroy', $reservation->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this reservation?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>

        </div>

    </div>

</x-admin-layout>
