<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Blog') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-white min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="max-w-7xl mx-auto py-10 ">
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="overflow-hidden sm:rounded-md">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-4">
                                        <label for="title"
                                            class="block font-medium text-sm text-gray-700">{{ __('Title') }}</label>

                                        <input id="title" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                            type="text" name="title" value="{{ old('title', $blog->title) }}"
                                            autofocus />
                                        @error('title')
                                            <p class="text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                        <label for="content"
                                            class="block font-medium text-sm text-gray-700">{{ __('Content') }}</label>

                                        <textarea id="content" class="form-input rounded-md shadow-sm mt-1 block w-full" name="content" rows="6">{{ old('content', $blog->content) }}</textarea>
                                        @error('content')
                                            <p class="text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                        <label for="category"
                                            class="block font-medium text-sm text-gray-700">{{ __('Category') }}</label>

                                        <select id="category"
                                            class="form-select rounded-md shadow-sm mt-1 block w-full p-2"
                                            name="category_id">
                                            <option value="">{{ __('Select a category') }}</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    @if ($category->id === $blog->category_id) selected @endif>
                                                    {{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <p class="text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                        <label for="image"
                                            class="block text-sm font-medium text-gray-700">{{ __('Image') }}</label>

                                        <input id="image"
                                            class="border border-gray-400 py-2 px-4 form-input rounded-md shadow-sm mt-1 block w-full"
                                            type="file" name="image" accept="image/*" />
                                        @error('image')
                                            <p class="text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="px-4 py-3 text-right sm:px-6">
                                    <a href="{{ route('blogs.index') }}"
                                        class="bg-gray-300 text-gray-700 px-4 py-2 mx-4 rounded-md hover:bg-gray-400 ml-2">Cancel</a>
                                    <button type="submit"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        {{ __('Update Post') }}
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
