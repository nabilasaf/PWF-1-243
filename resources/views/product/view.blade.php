<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Header --}}
                    <div class="flex items-center justify-between mb-8 pb-4 border-b border-gray-100 dark:border-gray-700">
                        <div class="flex items-center gap-3">
                            <a href="{{ route('product.index') }}"
                               class="p-2 rounded-full text-gray-400 hover:text-indigo-600 hover:bg-gray-100 dark:hover:bg-gray-700 transition"
                               title="Back to List">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </a>

                            <div>
                                <h1 class="text-2xl font-bold tracking-tight">Product Detail</h1>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">
                                    Full information for <span class="font-semibold text-indigo-600 dark:text-indigo-400">{{ $product->name }}</span>
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            @can('update', $product)
                            <a href="{{ route('product.edit', $product) }}"
                               class="inline-flex items-center gap-1.5 px-3 py-2 text-sm font-medium rounded-lg border border-amber-300 text-amber-600 hover:bg-amber-50 dark:border-amber-600 dark:text-amber-400 dark:hover:bg-amber-900/30 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </a>
                            @endcan

                            @can('delete', $product)
                            <form action="{{ route('product.delete', $product->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this product?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center gap-1.5 px-3 py-2 text-sm font-medium rounded-lg border border-red-300 text-red-600 hover:bg-red-50 dark:border-red-600 dark:text-red-400 dark:hover:bg-red-900/30 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Delete
                                </button>
                            </form>
                            @endcan
                        </div>
                    </div>

                    {{-- Detail Rows --}}
                    <div class="space-y-1">
                        
                        {{-- Name --}}
                        <div class="grid grid-cols-3 py-4 border-b border-gray-50 dark:border-gray-700/50">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Product Name</dt>
                            <dd class="text-sm font-bold text-gray-900 dark:text-gray-100 col-span-2">{{ $product->name }}</dd>
                        </div>

                        {{-- Quantity --}}
                        <div class="grid grid-cols-3 py-4 border-b border-gray-50 dark:border-gray-700/50">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Quantity</dt>
                            <dd class="text-sm col-span-2 flex items-center gap-2">
                                <span class="font-bold">{{ $product->qty }}</span>
                                <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider
                                    {{ $product->qty > 10 ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' }}">
                                    {{ $product->qty > 10 ? 'Available' : 'Low Stock' }}
                                </span>
                            </dd>
                        </div>

                        {{-- Price --}}
                        <div class="grid grid-cols-3 py-4 border-b border-gray-50 dark:border-gray-700/50">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Price</dt>
                            <dd class="text-sm font-bold text-gray-900 dark:text-gray-100 col-span-2">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </dd>
                        </div>

                        {{-- Owner --}}
                        <div class="grid grid-cols-3 py-4 border-b border-gray-50 dark:border-gray-700/50">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Owner</dt>
                            <dd class="text-sm col-span-2 flex items-center gap-2 text-gray-900 dark:text-gray-100">
                                <div class="w-6 h-6 rounded-full bg-indigo-100 dark:bg-indigo-900/40 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-[10px] font-bold uppercase border border-indigo-200 dark:border-indigo-800">
                                    {{ substr($product->user->name ?? '?', 0, 1) }}
                                </div>
                                <span class="font-medium">{{ $product->user->name ?? 'Unknown' }}</span>
                            </dd>
                        </div>

                        {{-- Created --}}
                        <div class="grid grid-cols-3 py-4 border-b border-gray-50 dark:border-gray-700/50">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Created At</dt>
                            <dd class="text-sm text-gray-700 dark:text-gray-300 col-span-2">
                                {{ $product->created_at->format('d M Y, H:i') }}
                            </dd>
                        </div>

                        {{-- Updated --}}
                        <div class="grid grid-cols-3 py-4">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Updated At</dt>
                            <dd class="text-sm text-gray-700 dark:text-gray-300 col-span-2">
                                {{ $product->updated_at->format('d M Y, H:i') }}
                            </dd>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>