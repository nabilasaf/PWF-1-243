<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Header --}}
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <a href="{{ route('product.index') }}"
                               class="p-1.5 rounded-md text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 19l-7-7 7-7" />
                                </svg>
                            </a>

                            <div>
                                <h2 class="text-2xl font-bold tracking-tight">Product Detail</h2>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Viewing product <strong>{{ $product->name }}</strong>
                                </p>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex items-center gap-2">
                            <a href="{{ route('product.edit', $product) }}"
                               class="inline-flex items-center gap-1.5 px-3 py-2 text-sm font-medium rounded-lg border border-amber-300 text-amber-600 hover:bg-amber-50 dark:border-amber-600 dark:text-amber-400 dark:hover:bg-amber-900/30 transition">
                                ✏️ Edit
                            </a>

                            <form action="{{ route('product.delete', $product->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this product?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="inline-flex items-center gap-1.5 px-3 py-2 text-sm font-medium rounded-lg border border-red-300 text-red-600 hover:bg-red-50 dark:border-red-600 dark:text-red-400 dark:hover:bg-red-900/30 transition">
                                    🗑 Delete
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Detail Card --}}
                    <div class="rounded-lg border border-gray-200 dark:border-gray-700 divide-y divide-gray-100 dark:divide-gray-700">

                        {{-- Name --}}
                        <div class="flex items-center px-5 py-4">
                            <div class="w-32 text-sm text-gray-500 dark:text-gray-400">Product Name</div>
                            <div class="font-semibold">{{ $product->name }}</div>
                        </div>

                        {{-- Quantity --}}
                        <div class="flex items-center px-5 py-4">
                            <div class="w-32 text-sm text-gray-500 dark:text-gray-400">Quantity</div>
                            <div>
                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium
                                    {{ $product->quantity > 10 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $product->quantity > 10 ? 'In Stock' : 'Low Stock' }}
                                </span>
                            </div>
                        </div>

                        {{-- Price --}}
                        <div class="flex items-center px-5 py-4">
                            <div class="w-32 text-sm text-gray-500 dark:text-gray-400">Price</div>
                            <div class="font-mono">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </div>
                        </div>

                        {{-- Owner --}}
                        <div class="flex items-center px-5 py-4">
                            <div class="w-32 text-sm text-gray-500 dark:text-gray-400">Owner</div>
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-xs font-bold uppercase">
                                    {{ substr($product->user->name ?? '-', 0, 1) }}
                                </div>
                                <span>{{ $product->user->name ?? '-' }}</span>
                            </div>
                        </div>

                        {{-- Created --}}
                        <div class="flex items-center px-5 py-4">
                            <div class="w-32 text-sm text-gray-500 dark:text-gray-400">Created At</div>
                            <div>{{ $product->created_at->format('d M Y, H:i') }}</div>
                        </div>

                        {{-- Updated --}}
                        <div class="flex items-center px-5 py-4">
                            <div class="w-32 text-sm text-gray-500 dark:text-gray-400">Updated At</div>
                            <div>{{ $product->updated_at->format('d M Y, H:i') }}</div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>