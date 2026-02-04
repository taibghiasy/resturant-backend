<x-admin-layout>

    <div class="py-10 max-w-4xl mx-auto">

        <div class="flex justify-between mb-6">
            <h1 class="text-3xl font-bold text-purple-300 drop-shadow">➕ New Reservation</h1>

            <a href="{{ route('admin.reservation.index') }}"
               class="px-5 py-2 bg-gray-700 hover:bg-gray-600 rounded-xl text-white">
                ← Back
            </a>
        </div>

        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-8 shadow-xl">

            <form method="POST" action="{{ route('admin.reservation.store') }}">
                @csrf

                {{-- First Name --}}
                <div class="mb-6">
                    <label class="text-purple-300">First Name</label>
                    <input type="text" name="first_name"
                           class="w-full mt-2 bg-white/10 border border-white/20 rounded-xl p-3 text-white focus:ring-purple-500">
                </div>

                {{-- Last Name --}}
                <div class="mb-6">
                    <label class="text-purple-300">Last Name</label>
                    <input type="text" name="last_name"
                           class="w-full mt-2 bg-white/10 border border-white/20 rounded-xl p-3 text-white focus:ring-purple-500">
                </div>

                {{-- Email --}}
                <div class="mb-6">
                    <label class="text-purple-300">Email</label>
                    <input type="email" name="email"
                           class="w-full mt-2 bg-white/10 border border-white/20 rounded-xl p-3 text-white focus:ring-purple-500">
                </div>

                {{-- Phone --}}
                <div class="mb-6">
                    <label class="text-purple-300">Phone Number</label>
                    <input type="number" name="tel_number"
                           class="w-full mt-2 bg-white/10 border border-white/20 rounded-xl p-3 text-white focus:ring-purple-500">
                </div>

              {{-- Status field removed, automatically reserved --}}
<div class="mb-6">
    <label class="text-purple-300">Reservation Date</label>
    <input type="date" name="res_date" class="w-full mt-2 bg-white/10 border border-white/20 rounded-xl p-3 text-white">
</div>

<div class="mb-6">
    <label class="text-purple-300">Start Time</label>
    <input type="time" name="res_start_time" class="w-full mt-2 bg-white/10 border border-white/20 rounded-xl p-3 text-white">
</div>

<div class="mb-6">
    <label class="text-purple-300">End Time</label>
    <input type="time" name="res_end_time" class="w-full mt-2 bg-white/10 border border-white/20 rounded-xl p-3 text-white">
</div>



                {{-- Guest Number --}}
                <div class="mb-6">
                    <label class="text-purple-300">Number Of Guest</label>
                    <input type="number" name="guest_number"
                           class="w-full mt-2 bg-white/10 border border-white/20 rounded-xl p-3 text-white focus:ring-purple-500">
                </div>

                {{-- Table --}}
                <div class="mb-6">
                    <label class="text-purple-300">Table</label>
                    <select name="table_id"
                            class="w-full mt-2 bg-white/10 border border-white/20 rounded-xl p-3 text-white">
                        @foreach($tables as $table)
                            <option value="{{ $table->id }}">{{ $table->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Location --}}
                <div class="mb-6">
                    <label class="text-purple-300">Location</label>
                    <select name="location"
                            class="w-full mt-2 bg-white/10 border border-white/20 rounded-xl p-3 text-white">
                        @foreach(App\Enums\TableLocation::cases() as $location)
                            <option value="{{ $location->value }}">{{ $location->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Submit --}}
                <button
                    class="px-6 py-3 bg-purple-600 hover:bg-purple-700 rounded-xl text-white font-semibold neon">
                    Save Reservation
                </button>

            </form>

        </div>

    </div>

</x-admin-layout>
