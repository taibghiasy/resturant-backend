<x-admin-layout>

    <div class="py-10 max-w-7xl mx-auto">

        {{-- Header + New Button --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-purple-300 drop-shadow">🍽️ Menus</h1>

            <a href="{{ route('admin.menues.create') }}"
               class="px-6 py-2 bg-purple-600 hover:bg-purple-700 transition rounded-xl neon text-white shadow">
                + New Menu
            </a>
        </div>

        {{-- Table Container --}}
        <div class="bg-white/5 backdrop-blur-xl shadow-xl border border-white/10 rounded-2xl p-6">

            <table class="w-full text-gray-300">
                <thead class="text-xs uppercase tracking-wide text-purple-300 border-b border-white/10">
                <tr>
                    <th class="py-3 px-4 text-left">Name</th>
                    <th class="py-3 px-4 text-left">Image</th>
                    <th class="py-3 px-4 text-left">Description</th>
                    <th class="py-3 px-4 text-left">Price</th>
                    <th class="py-3 px-4 text-left">Status</th>
                    <th class="py-3 px-4 text-left">Actions</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($menus as $menu)
                    <tr class="border-b border-white/5 hover:bg-white/10 transition">

                        <td class="py-4 px-4 font-medium text-gray-300">{{ $menu->name }}</td>

                        <td class="py-4 px-4">
                            <img src="{{ Storage::url($menu->image) }}"
                                 class="w-14 h-14 rounded-xl shadow-md object-cover">
                        </td>

                        <td class="py-4 px-4 text-gray-300">{{ $menu->description }}</td>

                        <td class="py-4 px-4 text-gray-300">AFG {{ $menu->price }}</td>

                        <td class="py-4 px-4">
                            @if($menu->status === 'available')
                                <span class="px-3 py-1 bg-green-600/20 text-green-400 rounded-full text-xs">Available</span>
                            @else
                                <span class="px-3 py-1 bg-red-600/20 text-red-400 rounded-full text-xs">Unavailable</span>
                            @endif
                        </td>

                        <td class="py-4 px-4">
                            <div class="flex space-x-3">

                                {{-- Edit --}}
                                <a href="{{ route('admin.menues.edit', $menu->id) }}"
                                   class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-xl text-white text-sm">
                                    Edit
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('admin.menues.destroy', $menu->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Delete this menu?')">
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded-xl text-white text-sm">
                                        Delete
                                    </button>
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
