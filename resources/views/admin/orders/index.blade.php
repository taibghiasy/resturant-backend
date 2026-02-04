<x-admin-layout>
<div class="py-10">
    <div class="max-w-7xl mx-auto">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-purple-300 drop-shadow flex items-center gap-2">
                🛒 Orders - Pending
            </h1>
            <div class="flex gap-2">
                <a href="{{ route('admin.orders.delivered') }}" class="btn bg-green-600 text-white px-3 py-1 rounded-xl hover:bg-green-700">Delivered</a>
                <a href="{{ route('admin.orders.completed') }}" class="btn bg-blue-600 text-white px-3 py-1 rounded-xl hover:bg-blue-700">Completed</a>
            </div>
        </div>

        {{-- Buttons --}}
        <div class="flex flex-wrap justify-end gap-3 mb-4">
            <a href="{{ route('admin.orders.printPending') }}" class="flex items-center gap-1 px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg shadow-md">
                <x-heroicon-o-printer class="w-5 h-5"/>
                Print Pending
            </a>

            <form action="{{ route('admin.orders.clearPending') }}" method="POST" onsubmit="return confirm('Delete ALL pending orders?');">
                @csrf
                @method('DELETE')
                <button class="flex items-center gap-1 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg shadow-md">
                    <x-heroicon-o-trash class="w-5 h-5"/>
                    Clear Pending
                </button>
            </form>
        </div>

        {{-- Table --}}
        <div class="bg-white/5 backdrop-blur-xl shadow-xl border border-white/10 rounded-2xl p-6">
            @include('admin.orders.partials.table', ['orders' => $pendingOrders, 'status' => 'pending'])
            {{ $pendingOrders->links() }}
        </div>
    </div>
</div>
</x-admin-layout>
