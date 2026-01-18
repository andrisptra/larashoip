<x-admin-layout>
    <div class="max-w-3xl">
        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl">
            <div class="px-6 py-5 border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-900">Add New Product</h2>
            </div>

            <div class="px-6 py-4">
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-900 mb-2">Product Name <span class="text-red-500">*</span></label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="mt-1 block w-full rounded-md shadow-sm focus:border-green-500 focus:ring-green-500 px-4 py-3 text-base bg-gray-50 {{ $errors->has('name') ? 'border-red-300' : 'border-gray-300' }}"
                                required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="category_id" class="block text-sm font-semibold text-gray-900 mb-2">Category</label>
                            <select name="category_id" id="category_id"
                                class="mt-1 block w-full rounded-md shadow-sm focus:border-green-500 focus:ring-green-500 px-4 py-3 text-base bg-gray-50 {{ $errors->has('category_id') ? 'border-red-300' : 'border-gray-300' }}">
                                <option value="">-- Select Category --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <label for="price" class="block text-sm font-semibold text-gray-900 mb-2">Selling Price (Rp) <span class="text-red-500">*</span></label>
                                <input type="number" name="price" id="price" value="{{ old('price') }}"
                                    class="mt-1 block w-full rounded-md shadow-sm focus:border-green-500 focus:ring-green-500 px-4 py-3 text-base bg-gray-50 {{ $errors->has('price') ? 'border-red-300' : 'border-gray-300' }}"
                                    required>
                                @error('price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="cost" class="block text-sm font-semibold text-gray-900 mb-2">Cost Price (Rp) <span class="text-red-500">*</span></label>
                                <input type="number" name="cost" id="cost" value="{{ old('cost') }}"
                                    class="mt-1 block w-full rounded-md shadow-sm focus:border-green-500 focus:ring-green-500 px-4 py-3 text-base bg-gray-50 {{ $errors->has('cost') ? 'border-red-300' : 'border-gray-300' }}"
                                    required>
                                @error('cost')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="stock" class="block text-sm font-semibold text-gray-900 mb-2">Initial Stock <span class="text-red-500">*</span></label>
                            <input type="number" name="stock" id="stock" value="{{ old('stock') }}"
                                class="mt-1 block w-full rounded-md shadow-sm focus:border-green-500 focus:ring-green-500 px-4 py-3 text-base bg-gray-50 {{ $errors->has('stock') ? 'border-red-300' : 'border-gray-300' }}"
                                required>
                            @error('stock')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-semibold text-gray-900 mb-2">Description</label>
                            <textarea name="description" id="description" rows="4"
                                class="mt-1 block w-full rounded-md shadow-sm focus:border-green-500 focus:ring-green-500 px-4 py-3 text-base bg-gray-50 {{ $errors->has('description') ? 'border-red-300' : 'border-gray-300' }}">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="image" class="block text-sm font-semibold text-gray-900 mb-2">Product Image</label>
                            <input type="file" name="image" id="image" accept="image/*"
                                class="mt-1 block w-full text-base text-gray-500 file:mr-4 file:py-3 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 border border-gray-300 rounded-md px-3 py-2 bg-gray-50">
                            @error('image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-x-3">
                        <a href="{{ route('admin.products.index') }}"
                            class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                            Cancel
                        </a>
                        <button type="submit"
                            class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">
                            Save Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
