<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Header --}}
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-2xl font-bold tracking-tight">Product List</h2>
                            <p class="text-sm text-gray-400">Manage your product inventory</p>
                        </div>

                        <a href="{{ route('product.create') }}"
                           class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition duration-150 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-4 w-4"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 4v16m8-8H4" />
                            </svg>
                            Add Product
                        </a>
                    </div>

                    {{-- Flash Message --}}
                    @if(session('success'))
                        <div class="mb-4 px-4 py-3 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 text-green-700 dark:text-green-300 rounded-lg text-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Table --}}
                    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
                        <table class="w-full min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-3 text-center font-bold uppercase tracking-wider text-xs text-gray-500 dark:text-gray-400">ID</th>
                                    <th class="px-6 py-3 text-left font-bold uppercase tracking-wider text-xs text-gray-500 dark:text-gray-400">Product Name</th>
                                    <th class="px-4 py-3 text-center font-bold uppercase tracking-wider text-xs text-gray-500 dark:text-gray-400">Qty</th>
                                    <th class="px-6 py-3 text-left font-bold uppercase tracking-wider text-xs text-gray-500 dark:text-gray-400">Price (IDR)</th>
                                    <th class="px-6 py-3 text-left font-bold uppercase tracking-wider text-xs text-gray-500 dark:text-gray-400">Owner</th>
                                    <th class="px-6 py-3 text-center font-bold uppercase tracking-wider text-xs text-gray-500 dark:text-gray-400">Actions</th>
                                </tr>
                            </thead>

                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-100 dark:divide-gray-700">
                                @forelse($products as $product)
                                    <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/30 transition duration-150 border-b border-gray-100 dark:border-gray-700 last:border-0">
                                        {{-- ID --}}
                                        <td class="px-4 py-5 text-center align-middle">
                                            <div class="inline-flex items-center justify-center">
                                                <span class="font-mono text-sm text-gray-500 dark:text-gray-400">{{ $product->id }}</span>
                                            </div>
                                        </td>

                                        {{-- Name --}}
                                        <td class="px-6 py-5 align-middle">
                                            <div class="flex items-center">
                                                <span class="font-bold text-gray-900 dark:text-gray-100">{{ $product->name }}</span>
                                            </div>
                                        </td>

                                        {{-- Qty --}}
                                        <td class="px-4 py-5 align-middle text-center">
                                            <div class="flex justify-center items-center">
                                                <span class="inline-flex items-center justify-center px-2.5 py-1 rounded-full text-xs font-bold
                                                    {{ $product->qty > 10 ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' }}">
                                                    {{ $product->qty }}
                                                </span>
                                            </div>
                                        </td>

                                        {{-- Price --}}
                                        <td class="px-6 py-5 align-middle">
                                            <div class="flex items-center">
                                                <span class="font-bold text-gray-900 dark:text-gray-100">
                                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </td>

                                        {{-- Owner --}}
                                        <td class="px-6 py-5 align-middle">
                                            <div class="flex items-center gap-2.5">
                                                <div class="w-7 h-7 flex-shrink-0 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-xs font-bold text-gray-500 dark:text-gray-400 uppercase border border-gray-200 dark:border-gray-600">
                                                    {{ substr($product->user->name ?? '?', 0, 1) }}
                                                </div>
                                                <span class="text-sm text-gray-600 dark:text-gray-400 font-medium">{{ $product->user->name ?? '-' }}</span>
                                            </div>
                                        </td>

                                        {{-- Actions --}}
                                        <td class="px-6 py-5 align-middle text-center">
                                            <div class="flex items-center justify-center gap-1.5">
                                                {{-- View --}}
                                                <a href="{{ route('product.show', $product->id) }}"
                                                   class="p-1.5 rounded-md text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 transition shadow-sm"
                                                   title="View Information">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>

                                                @can('update', $product)
                                                {{-- Edit --}}
                                                <a href="{{ route('product.edit', $product) }}"
                                                   class="p-1.5 rounded-md text-gray-400 hover:text-amber-600 hover:bg-amber-50 dark:hover:bg-amber-900/30 transition shadow-sm"
                                                   title="Edit Settings">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>
                                                @endcan

                                                @can('delete', $product)
                                                {{-- Delete --}}
                                                <form action="{{ route('product.delete', $product->id) }}" method="POST"
                                                      onsubmit="return confirm('Delete this product?')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                            class="p-1.5 rounded-md text-gray-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/30 transition shadow-sm"
                                                            title="Remove Product">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                            No products found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if($products->hasPages())
                        <div class="mt-4">
                            {{ $products->links() }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>