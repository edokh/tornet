<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <h1 class="text-3xl font-semibold mb-4">Edit Category</h1>

                @if ($errors->any())
                    <div class="bg-red-200 text-red-700 px-4 py-2 mb-4 rounded-md">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('categories.update', $category->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="title" class="block font-medium text-gray-700 mb-2">Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $category->title) }}"
                            class="w-full border border-gray-400 py-2 px-4 rounded-md @error('title') border-red-500 @enderror">
                        @error('title')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="image" class="block font-medium text-gray-700 mb-2">Image</label>
                        <input type="file" name="image" id="image"
                            class="border border-gray-400 py-2 px-4 rounded-md @error('image') border-red-500 @enderror">
                        @error('image')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Update
                            Category</button>
                        <a href="{{ route('categories.index') }}"
                            class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400 ml-2">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
