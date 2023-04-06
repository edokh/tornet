<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Blog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <form method="post" action="{{ route('blogs.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="shadow overflow-hidden sm:rounded-md">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-4">
                                            <label for="title"
                                                class="block text-sm font-medium text-gray-700">Title</label>
                                            <input type="text" name="title" id="title"
                                                class="form-input rounded-md shadow-sm mt-1 block w-full"
                                                value="{{ old('title', '') }}" />
                                            @error('title')
                                                <p class="text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="col-span-6 sm:col-span-4">
                                            <label for="content"
                                                class="block text-sm font-medium text-gray-700">Content</label>
                                            <textarea name="content" id="content" rows="5" class="form-input rounded-md shadow-sm mt-1 block w-full">{{ old('content', '') }}</textarea>
                                            @error('content')
                                                <p class="text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="col-span-6 sm:col-span-4">
                                            <label for="category_id"
                                                class="block text-sm font-medium text-gray-700">Category</label>
                                            <select name="category_id" id="category_id"
                                                class="form-select rounded-md shadow-sm mt-1 block w-full">
                                                <option value="">Select a category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <p class="text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="col-span-6 sm:col-span-4">
                                            <label for="image"
                                                class="block text-sm font-medium text-gray-700">Image</label>
                                            <input type="file" name="image" id="image"
                                                class="form-input rounded-md shadow-sm mt-1 block w-full"
                                                value="{{ old('image', '') }}" />
                                            @error('image')
                                                <p class="text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                    <button type="submit"
                                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Create
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
