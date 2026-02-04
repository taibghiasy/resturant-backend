<x-admin-layout>

    <div class="py-10">
        <div class="max-w-7xl mx-auto">

            {{-- Header + New Button --}}
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-purple-300 drop-shadow">📚 Categories</h1>

                <a href="{{ route('admin.categories.create') }}"
                   class="px-6 py-2 bg-purple-600 hover:bg-purple-700 transition rounded-xl neon text-white shadow">
                    + New Category
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
                        <th class="py-3 px-4 text-left">Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($categories as $category)
                        <tr class="border-b border-white/5 hover:bg-white/10 transition">

                            <td class="py-4 px-4 font-medium">
                                {{ $category->name }}
                            </td>

                            <td class="py-4 px-4">
                                <img src="{{ Storage::url($category->image) }}"
                                     class="w-14 h-14 rounded-xl shadow-md object-cover">
                            </td>

                            <td class="py-4 px-4 text-gray-300">
                                {{ $category->description }}
                            </td>

                            <td class="py-4 px-4">
                                <div class="flex space-x-3">

                                    {{-- Edit --}}
                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                       class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-xl text-white text-sm">
                                        Edit
                                    </a>

                                    {{-- Delete --}}
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Delete this category?')">
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
    </div>

</x-admin-layout>
