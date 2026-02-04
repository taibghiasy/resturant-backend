<x-admin-layout>

    <div class="py-10 max-w-4xl mx-auto">

        <div class="flex justify-between mb-6">
            <h1 class="text-3xl font-bold text-purple-300 drop-shadow">➕ Create Category</h1>

            <a href="{{ route('admin.categories.index') }}"
               class="px-5 py-2 bg-gray-700 hover:bg-gray-600 rounded-xl text-white">
                ← Back
            </a>
        </div>

        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-8 shadow-xl">

            <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
                @csrf

                {{-- Name --}}
                <div class="mb-6">
                    <label class="text-purple-300">Name</label>
                    <input type="text" name="name"
                           class="w-full mt-2 bg-white/10 border border-white/20 rounded-xl p-3 text-white focus:ring-purple-500">
                </div>

                {{-- Image --}}
                <div class="mb-6">
                    <label class="text-purple-300">Image</label>
                    <input type="file" name="image"
                           class="w-full mt-2 bg-white/10 border border-white/20 rounded-xl p-3 text-gray-300">
                </div>

                {{-- Description --}}
                <div class="mb-6">
                    <label class="text-purple-300">Description</label>
                    <textarea name="description" rows="4"
                              class="w-full mt-2 bg-white/10 border border-white/20 rounded-xl p-3 text-white"></textarea>
                </div>

                {{-- Submit --}}
                <button
                    class="px-6 py-3 bg-purple-600 hover:bg-purple-700 rounded-xl text-white font-semibold neon">
                    Save Category
                </button>

            </form>

        </div>
    </div>

</x-admin-layout>
