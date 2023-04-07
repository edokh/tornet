@extends('layouts.app')
@section('content')
    <div class="py-12 bg-white min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Edit Category') }}
                </h2>
                <div class="max-w-7xl mx-auto py-10 ">
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <form action="{{ route('categories.update', $category->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="overflow-hidden sm:rounded-md">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-4">
                                        <label for="title"
                                            class="block font-medium text-sm text-gray-700">{{ __('Title') }}</label>

                                        <input id="title" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                            type="text" name="title" value="{{ old('title', $category->title) }}"
                                            autofocus />
                                        @error('title')
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
                                    <a href="{{ route('categories.index') }}"
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
@endsection
