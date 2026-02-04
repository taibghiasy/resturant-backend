<x-admin-layout>

    <div class="py-10 max-w-7xl mx-auto">

        {{-- Header + New Button --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-purple-300 drop-shadow">🍽️ Tables</h1>

            <a href="{{ route('admin.tables.create') }}"
               class="px-6 py-2 bg-purple-600 hover:bg-purple-700 rounded-xl neon text-white shadow">
                + New Table
            </a>
        </div>

        {{-- Table Container --}}
        <div class="bg-white/5 backdrop-blur-xl shadow-xl border border-white/10 rounded-2xl p-6 overflow-x-auto">

            <table class="w-full text-gray-300">
                <thead class="text-xs uppercase tracking-wide text-purple-300 border-b border-white/10">
                <tr>
                    <th class="py-3 px-4 text-left">Name</th>
                    <th class="py-3 px-4 text-left">Guest</th>
                   
                    <th class="py-3 px-4 text-left">Location</th>
                    <th class="py-3 px-4 text-left">Action</th>
                </tr>
                </thead>

                <tbody>
               @foreach ($tables as $table)
<tr class="border-b border-white/5 hover:bg-white/10 transition">
    <td class="py-4 px-4 font-medium">{{ $table->name }}</td>
    <td class="py-4 px-4">{{ $table->guest_number }}</td>
    
    <td class="py-4 px-4">{{ $table->location }}</td>
    <td class="py-4 px-4">
        <div class="flex space-x-3">
            <a href="{{ route('admin.tables.edit', $table->id) }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-xl text-white text-sm">Edit</a>
            <form action="{{ route('admin.tables.destroy', $table->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded-xl text-white text-sm">Delete</button>
            </form>
        </div>
    </td>
</tr>
@endforeach

                </tbody>

            </table>

        </div>

    </div>

</x-admin-layout>
