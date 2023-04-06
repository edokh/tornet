<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                                @if ($errors->any())
                                    <div class="mb-4 text-red-600">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ route('blogs.update', $blog->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mt-4">
                                        <label for="title"
                                            class="block font-medium text-sm text-gray-700">{{ __('Title') }}</label>

                                        <input id="title" class="form-input mt-1 block w-full" type="text"
                                            name="title" value="{{ old('title', $blog->title) }}" required
                                            autofocus />
                                    </div>

                                    <div class="mt-4">
                                        <label for="content"
                                            class="block font-medium text-sm text-gray-700">{{ __('Content') }}</label>

                                        <textarea id="content" class="form-input mt-1 block w-full" name="content" rows="6" required>{{ old('content', $blog->content) }}</textarea>
                                    </div>

                                    <div class="mt-4">
                                        <label for="category"
                                            class="block font-medium text-sm text-gray-700">{{ __('Category') }}</label>

                                        <select id="category" class="form-select mt-1 block w-full" name="category_id"
                                            required>
                                            <option value="">{{ __('Select a category') }}</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    @if ($category->id === $blog->category_id) selected @endif>
                                                    {{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mt-4">
                                        <label for="image"
                                            class="block font-medium text-sm text-gray-700">{{ __('Image') }}</label>

                                        <input id="image" class="form-input mt-1 block w-full" type="file"
                                            name="image" accept="image/*" />
                                    </div>

                                    <div class="flex items-center justify-end mt-4">
                                        <button type="submit"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            {{ __('Update Post') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
