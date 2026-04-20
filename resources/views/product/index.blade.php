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

                        <div class="flex items-center gap-2">

                            {{-- Export --}}
                            @can('export-product')
                            <a href="{{ route('product.export') }}"
                               class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition duration-150 shadow-sm">
                                Export CSV
                            </a>
                            @endcan

                            {{-- ✅ Add Product Component --}}
                            @can('manage-products')
                                <x-add-product 
                                    :url="route('product.create')" 
                                    :name="'Product'" 
                                />
                            @endcan

                        </div>
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
                                    <th class="px-4 py-3 text-center text-xs font-bold">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold">Product Name</th>
                                    <th class="px-4 py-3 text-center text-xs font-bold">Qty</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold">Price</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold">Owner</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($products as $product)
                                    <tr class="border-b">

                                        {{-- ID --}}
                                        <td class="text-center py-3">{{ $product->id }}</td>

                                        {{-- Name --}}
                                        <td class="py-3">{{ $product->name }}</td>

                                        {{-- Qty --}}
                                        <td class="text-center py-3">{{ $product->qty }}</td>

                                        {{-- Price --}}
                                        <td class="py-3">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </td>

                                        {{-- Owner --}}
                                        <td class="py-3">
                                            {{ $product->user->name ?? '-' }}
                                        </td>

                                        {{-- Actions --}}
                                        <td class="text-center py-3">
                                            <div class="flex justify-center gap-2">

                                                {{-- View --}}
                                                <a href="{{ route('product.show', $product->id) }}">
                                                    👁️
                                                </a>

                                                {{-- ✅ Edit Component --}}
                                                @can('update', $product)
                                                    <x-edit-button 
                                                        :url="route('product.edit', $product->id)" 
                                                    />
                                                @endcan

                                                {{-- ✅ Delete Component --}}
                                                @can('delete', $product)
                                                    <x-delete-button 
                                                        :url="route('product.destroy', $product->id)" 
                                                    />
                                                @endcan

                                            </div>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            No products found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>