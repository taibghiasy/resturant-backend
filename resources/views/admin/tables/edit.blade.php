<x-admin-layout>

    <div class="py-10 max-w-4xl mx-auto">

        <div class="flex justify-between mb-6">
            <h1 class="text-3xl font-bold text-purple-300 drop-shadow">✏️ Edit Table</h1>

            <a href="{{ route('admin.tables.index') }}"
               class="px-5 py-2 bg-gray-700 hover:bg-gray-600 rounded-xl text-white">
                ← Back
            </a>
        </div>

        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-8 shadow-xl">

            <form method="POST" action="{{ route('admin.tables.update', $table->id) }}">
                @csrf
                @method('PUT')

                {{-- Name --}}
                <div class="mb-6">
                    <label class="text-purple-300">Name</label>
                    <input type="text" name="name" value="{{ $table->name }}"
                           class="w-full mt-2 bg-white/10 border border-white/20 rounded-xl p-3 text-white focus:ring-purple-500">
                </div>

                {{-- Guest Number --}}
                <div class="mb-6">
                    <label class="text-purple-300">Number Of Guest</label>
                    <input type="number" name="guest_number" value="{{ $table->guest_number }}"
                           class="w-full mt-2 bg-white/10 border border-white/20 rounded-xl p-3 text-white focus:ring-purple-500">
                </div>

               

                {{-- Location --}}
                <div class="mb-6">
                    <label class="text-purple-300">Location</label>
                    <select name="location"
                            class="w-full mt-2 bg-white/10 border border-white/20 rounded-xl p-3 text-white">
                        @foreach(App\Enums\TableLocation::cases() as $location)
                           <option value="{{ $location->value }}" @selected($table->location == $location->value)>{{ $location->name }}</option>

                        @endforeach
                    </select>
                </div>

                {{-- Submit --}}
                <button
                    class="px-6 py-3 bg-purple-600 hover:bg-purple-700 rounded-xl text-white font-semibold neon">
                    Update Table
                </button>

            </form>

        </div>
    </div>

</x-admin-layout>
