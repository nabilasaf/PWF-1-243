<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-4">
                    <a href="{{ route('product.index') }}"
                       class="text-gray-400 hover:text-white transition"
                       title="Back">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                    <div>
                        <h1 class="text-3xl font-extrabold text-white tracking-tight">Product Detail</h1>
                        <p class="text-sm text-gray-400 mt-0.5">Viewing product #{{ $product->id }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    @can('update', $product)
                    <a href="{{ route('product.edit', $product) }}"
                       class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-lg border-2 border-amber-500 text-amber-400 hover:bg-amber-500/10 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit
                    </a>
                    @endcan

                    @can('delete', $product)
                    <form action="{{ route('product.destroy', $product->id) }}" method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this product?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-lg border-2 border-red-500 text-red-400 hover:bg-red-500/10 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Delete
                        </button>
                    </form>
                    @endcan
                </div>
            </div>

            {{-- Detail Card --}}
            <div class="rounded-xl border border-gray-600/50 overflow-hidden bg-gray-800/40">

                {{-- Product Name --}}
                <div class="grid grid-cols-3 items-center px-6 py-5 border-b border-gray-700/60">
                    <dt class="text-sm text-gray-400">Product Name</dt>
                    <dd class="col-span-2 text-base font-bold text-white">{{ $product->name }}</dd>
                </div>

                {{-- Quantity --}}
                <div class="grid grid-cols-3 items-center px-6 py-5 border-b border-gray-700/60">
                    <dt class="text-sm text-gray-400">Quantity</dt>
                    <dd class="col-span-2 flex items-center gap-3">
                        @if($product->qty > 10)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-500/20 text-green-400 border border-green-500/30">
                                {{ $product->qty }} In Stock
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-500/20 text-red-400 border border-red-500/30">
                                {{ $product->qty }} Low Stock
                            </span>
                        @endif
                    </dd>
                </div>

                {{-- Price --}}
                <div class="grid grid-cols-3 items-center px-6 py-5 border-b border-gray-700/60">
                    <dt class="text-sm text-gray-400">Price</dt>
                    <dd class="col-span-2 text-base font-bold text-white">
                        Rp&nbsp;{{ number_format($product->price, 0, ',', '.') }}
                    </dd>
                </div>

                {{-- Owner --}}
                <div class="grid grid-cols-3 items-center px-6 py-5 border-b border-gray-700/60">
                    <dt class="text-sm text-gray-400">Owner</dt>
                    <dd class="col-span-2 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-indigo-600 flex items-center justify-center text-xs font-bold text-white uppercase">
                            {{ substr($product->user->name ?? '?', 0, 1) }}
                        </div>
                        <span class="text-base font-semibold text-white">{{ $product->user->name ?? 'Unknown' }}</span>
                    </dd>
                </div>

                {{-- Created At --}}
                <div class="grid grid-cols-3 items-center px-6 py-5 border-b border-gray-700/60">
                    <dt class="text-sm text-gray-400">Created At</dt>
                    <dd class="col-span-2 text-sm text-gray-200">
                        {{ $product->created_at->format('d M Y, H:i') }}
                    </dd>
                </div>

                {{-- Updated At --}}
                <div class="grid grid-cols-3 items-center px-6 py-5">
                    <dt class="text-sm text-gray-400">Updated At</dt>
                    <dd class="col-span-2 text-sm text-gray-200">
                        {{ $product->updated_at->format('d M Y, H:i') }}
                    </dd>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>