<x-admin-layout>
<div class="py-10">
    <div class="max-w-7xl mx-auto">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-green-300 drop-shadow flex items-center gap-2">
                🛒 Orders - Delivered
            </h1>
            <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-1 btn bg-purple-600 text-white px-3 py-1 rounded-xl hover:bg-purple-700">
                <x-heroicon-o-arrow-left class="w-5 h-5"/>
                Back to Pending
            </a>
        </div>

        {{-- Buttons --}}
        <div class="flex flex-wrap justify-end gap-3 mb-4">
            <a href="{{ route('admin.orders.printDelivered') }}" class="flex items-center gap-1 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow-md">
                <x-heroicon-o-printer class="w-5 h-5"/>
                Print Delivered
            </a>

            <form action="{{ route('admin.orders.clearDelivered') }}" method="POST" onsubmit="return confirm('Delete ALL delivered orders?');">
                @csrf
                @method('DELETE')
                <button class="flex items-center gap-1 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg shadow-md">
                    <x-heroicon-o-trash class="w-5 h-5"/>
                    Clear Delivered
                </button>
            </form>
        </div>

        {{-- Table --}}
        <div class="bg-white/5 backdrop-blur-xl shadow-xl border border-white/10 rounded-2xl p-6">
            @include('admin.orders.partials.table', ['orders' => $orders, 'status' => 'delivered'])
            {{ $orders->links() }}
        </div>
    </div>
</div>
</x-admin-layout>
