@extends('layouts.app')
@section('content')
    <div class="container mx-auto">
        <div class="flex justify-center">
            <div class="w-full lg:w-1/2 bg-white p-8 rounded-lg shadow-lg">

                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Create Blog') }}
                </h2>
                <div class="max-w-7xl mx-auto py-10  ">
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <form method="post" action="{{ route('blogs.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="overflow-hidden sm:rounded-md">
                                <div class="">

                                    <div class="mb-6">
                                        <label for="title_en"
                                            class="block text-gray-700 font-bold mb-2">{{ __('Title (English)') }}</label>
                                        <input type="text" name="title_en" id="title_en"
                                            class="form-input rounded-md shadow-sm w-full @error('title_en') border-red-500 @enderror"
                                            value="{{ old('title_en') }}">
                                        @error('title_en')
                                            <span class="text-red-500 mt-2 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-6">
                                        <label for="title_ar"
                                            class="block text-gray-700 font-bold mb-2 ">{{ __('Title (Arabic)') }}</label>
                                        <input type="text" name="title_ar" id="title_ar" dir="rtl"
                                            class="form-input rounded-md shadow-sm w-full @error('title_ar') border-red-500 @enderror"
                                            value="{{ old('title_ar') }}">
                                        @error('title_ar')
                                            <span class="text-red-500 mt-2 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-6">
                                        <label for="title_ku"
                                            class="block text-gray-700 font-bold mb-2">{{ __('Title (Kurdish)') }}</label>
                                        <input type="text" name="title_ku" id="title_ku" dir="rtl"
                                            class="form-input rounded-md shadow-sm w-full @error('title_ku') border-red-500 @enderror"
                                            value="{{ old('title_ku') }}">
                                        @error('title_ku')
                                            <span class="text-red-500 mt-2 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                        <label for="content_en"
                                            class="block text-gray-700 font-bold mb-2">{{ __('Content (English)') }}</label>
                                        <textarea name="content_en" id="content_en" rows="5" class="form-input rounded-md shadow-sm mt-1 block w-full">{{ old('content_en', '') }}</textarea>
                                        @error('content_en')
                                            <p class="text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                        <label for="content_ar"
                                            class="block text-gray-700 font-bold mb-2">{{ __('Content (Arabic)') }}</label>
                                        <textarea name="content_ar" dir="rtl" id="content_ar" rows="5"
                                            class="form-input rounded-md shadow-sm mt-1 block w-full">{{ old('content_ar', '') }}</textarea>
                                        @error('content_ar')
                                            <p class="text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                        <label for="content_ku"
                                            class="block text-gray-700 font-bold mb-2">{{ __('Content (Kurdish)') }}</label>
                                        <textarea name="content_ku" dir="rtl" id="content_ku" rows="5"
                                            class="form-input rounded-md shadow-sm mt-1 block w-full">{{ old('content_ku', '') }}</textarea>
                                        @error('content_ku')
                                            <p class="text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                        <label for="category_id"
                                            class="block text-sm font-medium text-gray-700">Category</label>
                                        <select name="category_id" id="category_id"
                                            class="form-select rounded-md shadow-sm mt-1 block w-full p-2">
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
                                        <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                                        <input type="file" name="image" id="image"
                                            class=" border border-gray-400 py-2 px-4 form-input rounded-md shadow-sm mt-1 block w-full"
                                            value="{{ old('image', '') }}" />
                                        @error('image')
                                            <p class="text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="px-4 py-3 text-right sm:px-6">
                                    <a href="{{ route('blogs.index') }}"
                                        class="bg-gray-300 text-gray-700 px-4 py-2 mx-4 rounded-md hover:bg-gray-400 ml-2">Cancel</a>
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
@endsection
