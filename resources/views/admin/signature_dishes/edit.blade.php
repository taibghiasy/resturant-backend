<x-admin-layout>

    <div class="py-10 max-w-4xl mx-auto">

        <div class="flex justify-between mb-6">
            <h1 class="text-3xl font-bold text-purple-300 drop-shadow">✏️ Edit Signature Dish</h1>

            <a href="{{ route('admin.signature-dishes.index') }}"
               class="px-5 py-2 bg-gray-700 hover:bg-gray-600 rounded-xl text-white">
                ← Back
            </a>
        </div>

        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-8 shadow-xl">

            <form method="POST" action="{{ route('admin.signature-dishes.update', $signatureDish->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Name --}}
                <div class="mb-6">
                    <label class="text-purple-300">Name</label>
                    <input type="text" name="name" value="{{ $signatureDish->name }}"
                           class="w-full mt-2 bg-white/10 border border-white/20 rounded-xl p-3 text-white">
                </div>

                {{-- Existing Image --}}
                <div class="mb-3 text-purple-300">Current Image:</div>
                <img src="{{ $signatureDish->image_url }}" class="w-24 h-24 rounded-xl mb-5 shadow">

                {{-- Upload New Image --}}
                <div class="mb-6">
                    <label class="text-purple-300">Change Image</label>
                    <input type="file" name="image"
                           class="w-full mt-2 bg-white/10 border border-white/20 rounded-xl p-3 text-gray-300">
                </div>

                {{-- Description --}}
                <div class="mb-6">
                    <label class="text-purple-300">Description</label>
                    <textarea name="description" rows="4"
                              class="w-full mt-2 bg-white/10 border border-white/20 rounded-xl p-3 text-white">
                        {{ $signatureDish->description }}
                    </textarea>
                </div>

                {{-- Price --}}
                <div class="mb-6">
                    <label class="text-purple-300">Price ($)</label>
                    <input type="number" name="price" value="{{ $signatureDish->price }}"
                           class="w-full mt-2 bg-white/10 border border-white/20 rounded-xl p-3 text-white" min="0">
                </div>

                {{-- Submit --}}
                <button
                    class="px-6 py-3 bg-purple-600 hover:bg-purple-700 rounded-xl text-white font-semibold neon">
                    Update Dish
                </button>

            </form>

        </div>
    </div>

</x-admin-layout>
