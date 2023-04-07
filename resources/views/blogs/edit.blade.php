@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-center">
            <div class="w-full lg:w-1/2 bg-white p-8 rounded-lg shadow-lg">
                <h1 class="text-2xl font-bold mb-8">{{ __('Edit Blog') }}</h1>
                <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-6">
                        <label for="title_en" class="block text-gray-700 font-bold mb-2">{{ __('Title (English)') }}</label>
                        <input type="text" name="title_en" id="title_en"
                            class="form-input rounded-md shadow-sm w-full @error('title_en') border-red-500 @enderror"
                            value="{{ old('title_en', $blog->getTranslation('title', 'en')) }}">
                        @error('title_en')
                            <span class="text-red-500 mt-2 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="title_ar" class="block text-gray-700 font-bold mb-2">{{ __('Title (Arabic)') }}</label>
                        <input type="text" name="title_ar" id="title_ar" dir="rtl"
                            class="form-input rounded-md shadow-sm  w-full @error('title_ar') border-red-500 @enderror"
                            value="{{ old('title_ar', $blog->getTranslation('title', 'ar')) }}">
                        @error('title_ar')
                            <span class="text-red-500 mt-2 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="title_ku" class="block text-gray-700 font-bold mb-2">{{ __('Title (Kurdish)') }}</label>
                        <input type="text" name="title_ku" id="title_ku" dir="rtl"
                            class="form-input rounded-md shadow-sm  w-full @error('title_ku') border-red-500 @enderror"
                            value="{{ old('title_ku', $blog->getTranslation('title', 'ku')) }}">
                        @error('title_ku')
                            <span class="text-red-500 mt-2 text-sm">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="col-span-6 sm:col-span-4">
                        <label for="content_ar"
                            class="block text-gray-700 font-bold mb-2">{{ __('Content (English)') }}</label>

                        <textarea id="content_en" class="form-input rounded-md shadow-sm mt-1 block w-full" name="content_en" rows="6">{{ old('content_en', $blog->getTranslation('content', 'en')) }}</textarea>
                        @error('content_en')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <label for="content_ar"
                            class="block text-gray-700 font-bold mb-2">{{ __('Content (Arabic)') }}</label>
                        <textarea name="content_ar" dir="rtl" id="content_ar" rows="5"
                            class="form-input rounded-md shadow-sm mt-1 block w-full">{{ old('content_ar', $blog->getTranslation('content', 'ar')) }}</textarea>
                        @error('content_ar')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <label for="content_ku"
                            class="block text-gray-700 font-bold mb-2">{{ __('Content (Kurdish)') }}</label>
                        <textarea name="content_ku" id="content_ku" dir="rtl" rows="5"
                            class="form-input rounded-md shadow-sm mt-1 block w-full">{{ old('content_ku', $blog->getTranslation('content', 'ku')) }}</textarea>
                        @error('content_ku')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <label for="category" class="block font-medium text-sm text-gray-700">{{ __('Category') }}</label>

                        <select id="category" class="form-select rounded-md shadow-sm mt-1 block w-full p-2"
                            name="category_id">
                            <option value="">{{ __('Select a category') }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if ($category->id === $blog->category_id) selected @endif>
                                    {{ $category->title }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="image" class="block text-gray-700 font-bold mb-2">{{ __('Image') }}</label>
                        <input type="file" name="image" id="image"
                            class="form-input rounded-md shadow-sm @error('image') border-red-500 @enderror">
                        @error('image')
                            <span class="text-red-500 mt-2 text-sm">{{ $message }}</span>
                        @enderror
                        @if ($blog->image)
                            <div class="mt-4">
                                <img src="{{ '/images/' . $blog->image }}" alt="{{ __('Blog Image') }}"
                                    class="w-full h-auto">
                            </div>
                        @endif
                    </div>
                    <div>
                        <button type="submit"
                            class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-400">{{ __('Update') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
