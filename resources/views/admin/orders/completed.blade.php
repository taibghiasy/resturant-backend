<x-admin-layout>
<div class="py-10">
    <div class="max-w-7xl mx-auto">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-blue-300 drop-shadow flex items-center gap-2">
                🛒 Orders - Completed
            </h1>
            <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-1 btn bg-purple-600 text-white px-3 py-1 rounded-xl hover:bg-purple-700">
                <x-heroicon-o-arrow-left class="w-5 h-5"/>
                Back to Pending
            </a>
        </div>

        {{-- Buttons --}}
        <div class="flex flex-wrap justify-end gap-3 mb-4">
            <a href="{{ route('admin.orders.printCompleted') }}" class="flex items-center gap-1 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-md">
                <x-heroicon-o-printer class="w-5 h-5"/>
                Print Completed
            </a>

            <form action="{{ route('admin.orders.clearCompleted') }}" method="POST" onsubmit="return confirm('Delete ALL completed orders?');">
                @csrf
                @method('DELETE')
                <button class="flex items-center gap-1 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg shadow-md">
                    <x-heroicon-o-trash class="w-5 h-5"/>
                    Clear Completed
                </button>
            </form>
        </div>

        {{-- Table --}}
        <div class="bg-white/5 backdrop-blur-xl shadow-xl border border-white/10 rounded-2xl p-6">
            @include('admin.orders.partials.table', ['orders' => $orders, 'status' => 'completed'])
            {{ $orders->links() }}
        </div>
    </div>
</div>
</x-admin-layout>
