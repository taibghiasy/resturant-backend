<x-admin-layout>

    <div class="py-10 max-w-4xl mx-auto">

        <div class="flex justify-between mb-6">
            <h1 class="text-3xl font-bold text-purple-300 drop-shadow">✏️ Edit Menu</h1>

            <a href="{{ route('admin.menues.index') }}"
               class="px-5 py-2 bg-gray-700 hover:bg-gray-600 rounded-xl text-white">
                ← Back
            </a>
        </div>

        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-8 shadow-xl">

            <form method="POST" action="{{ route('admin.menues.update', $menu) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Name --}}
                <div class="mb-6">
                    <label class="text-purple-300">Name</label>
                    <input type="text" name="name" value="{{ $menu->name }}"
                           class="w-full mt-2 bg-white/10 border border-white/20 rounded-xl p-3 text-white focus:ring-purple-500">
                </div>

                {{-- Image --}}
                <div class="mb-6">
                    <label class="text-purple-300">Current Image</label>
                    <img src="{{ Storage::url($menu->image) }}" class="w-32 h-20 mt-1 rounded-xl shadow-md object-cover">
                    <input type="file" name="image"
                           class="w-full mt-2 bg-white/10 border border-white/20 rounded-xl p-3 text-gray-300">
                </div>

                {{-- Price --}}
                <div class="mb-6">
                    <label class="text-purple-300">Price</label>
                    <input type="number" name="price" value="{{ $menu->price }}" min="0.00" step="0.01"
                           class="w-full mt-2 bg-white/10 border border-white/20 rounded-xl p-3 text-white focus:ring-purple-500">
                </div>

                {{-- Description --}}
                <div class="mb-6">
                    <label class="text-purple-300">Description</label>
                    <textarea name="description" rows="4"
                              class="w-full mt-2 bg-white/10 border border-white/20 rounded-xl p-3 text-white focus:ring-purple-500">{{ $menu->description }}</textarea>
                </div>

                {{-- Categories --}}
                <div class="mb-6">
                    <label class="text-purple-300">Categories</label>
                    <select name="categories[]" multiple
                            class="w-full mt-2 bg-white/10 border border-white/20 rounded-xl p-3 text-white">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected($menu->categories->contains($category))>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Status --}}
                <div class="mb-6">
                    <label class="text-purple-300">Status</label>
                    <select name="status"
                            class="w-full mt-2 bg-white/10 border border-white/20 rounded-xl p-3 text-white">
                        <option value="available" {{ $menu->status === 'available' ? 'selected' : '' }}>Available</option>
                        <option value="unavailable" {{ $menu->status === 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                    </select>
                </div>

                {{-- Submit --}}
                <button
                    class="px-6 py-3 bg-purple-600 hover:bg-purple-700 rounded-xl text-white font-semibold neon">
                    Update Menu
                </button>

            </form>

        </div>
    </div>

</x-admin-layout>
