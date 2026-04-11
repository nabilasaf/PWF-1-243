<x-app-layout>
    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Header --}}
                    <div class="flex items-center gap-3 mb-6">
                        <a href="{{ route('product.index') }}"
                           class="p-1.5 rounded-md text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>

                        <div>
                            <h2 class="text-2xl font-bold tracking-tight">Edit Product</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">
                                Updating <span class="font-medium">{{ $product->name }}</span>
                            </p>
                        </div>
                    </div>

                    {{-- Warning Session --}}
                    @if (session('warning'))
                        <div class="mb-6 p-4 rounded-xl bg-orange-500/10 border border-orange-500/30 backdrop-blur-sm">
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm font-bold tracking-tight" style="color: #f97316 !important;">{{ session('warning') }}</span>
                            </div>
                        </div>
                    @endif

                    {{-- Validation Error Summary --}}
                    @if ($errors->any())
                        <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/30 backdrop-blur-sm">
                            <div class="flex items-center gap-2 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm font-bold tracking-tight" style="color: #ef4444 !important;">Periksa kembali inputan Anda:</span>
                            </div>
                            <ul class="space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li class="text-xs font-bold ml-7 list-disc" style="color: #f87171 !important;">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Form --}}
                    <form action="{{ route('product.update', $product->id) }}" method="POST" class="space-y-5" novalidate>
                        @csrf
                        @method('PUT')

                        {{-- Name --}}
                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-medium text-gray-300">
                                Product Name <span class="text-red-500">*</span>
                            </label>

                                 <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                                        class="w-full px-4 py-2.5 rounded-lg border @error('name') border-red-500 @else border-gray-300 @enderror bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                                        placeholder="e.g. Wireless Headphones">
                                 @error('name')
                                     <p class="mt-1.5 text-sm font-bold" style="color: #ef4444 !important;">{{ $message }}</p>
                                 @enderror
                            </div>

                            {{-- Quantity & Price --}}
                            <div class="grid grid-cols-2 gap-4">

                            {{-- Quantity --}}
                            <div class="space-y-2">
                                <label for="qty" class="block text-sm font-medium text-gray-300">
                                    Quantity <span class="text-red-500">*</span>
                                </label>

                                <input type="number" id="qty" name="qty" value="{{ old('qty', $product->qty) }}"
                                       min="0"
                                       class="w-full px-4 py-2.5 rounded-lg border @error('qty') border-red-500 @else border-gray-300 @enderror bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                                       placeholder="Enter quantity">

                                @error('qty')
                                     <p class="mt-1.5 text-sm font-bold" style="color: #ef4444 !important;">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Price --}}
                            <div class="space-y-2">
                                <label for="price" class="block text-sm font-medium text-gray-300">
                                    Price (Rp) <span class="text-red-500">*</span>
                                </label>

                                <input type="number" step="0.01" id="price" name="price" value="{{ old('price', $product->price) }}"
                                        min="0"
                                        class="w-full px-4 py-2.5 rounded-lg border @error('price') border-red-500 @else border-gray-300 @enderror bg-white text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                                        placeholder="0.00">
                                 @error('price')
                                     <p class="mt-1.5 text-sm font-bold" style="color: #ef4444 !important;">{{ $message }}</p>
                                 @enderror
                            </div>

                            </div>

                            {{-- User/Owner --}}
                            <div class="space-y-2">
                                <label for="user_id" class="block text-sm font-medium text-gray-300">
                                    Owner <span class="text-red-500">*</span>
                                </label>
                                <select name="user_id" id="user_id"
                                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-900 focus:ring-2 focus:ring-indigo-500 transition-all cursor-pointer">
                                    <option value="" disabled selected>Select Owner</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id', $product->user_id) == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                    @endforeach
                                </select>
                            </div>
                            @error('user_id')
                                <p class="mt-1.5 text-xs" style="color: #ef4444 !important;">{{ $message }}</p>
                            @enderror

                        {{-- Actions --}}
                        <div class="flex items-center justify-end gap-3 pt-6">
                            <a href="{{ route('product.index') }}"
                               class="px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                Cancel
                            </a>

                            <button type="submit"
                                    class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition">
                                Update Product
                            </button>
                        </div>

                    </form>

                    {{-- Form Delete (Terpisah di luar form update agar tidak error) --}}
                    <div class="mt-4 border-t border-gray-100 dark:border-gray-700 pt-4">
                        <form action="{{ route('product.delete', $product->id) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this product?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-sm font-medium text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 transition">
                                Delete Product
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
