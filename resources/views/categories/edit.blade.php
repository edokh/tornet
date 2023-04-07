@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-center">
            <div class="w-full lg:w-1/2 bg-white p-8 rounded-lg shadow-lg">
                <h1 class="text-2xl font-bold mb-8">{{ __('Edit Category') }}</h1>
                <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-6">
                        <label for="title_en" class="block text-gray-700 font-bold mb-2">{{ __('Title (English)') }}</label>
                        <input type="text" name="title_en" id="title_en"
                            class="form-input rounded-md shadow-sm w-full @error('title_en') border-red-500 @enderror"
                            value="{{ old('title_en', $category->getTranslation('title', 'en')) }}">
                        @error('title_en')
                            <span class="text-red-500 mt-2 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="title_ar" class="block text-gray-700 font-bold mb-2">{{ __('Title (Arabic)') }}</label>
                        <input type="text" name="title_ar" id="title_ar" dir="rtl"
                            class="form-input rounded-md shadow-sm w-full @error('title_ar') border-red-500 @enderror"
                            value="{{ old('title_ar', $category->getTranslation('title', 'ar')) }}">
                        @error('title_ar')
                            <span class="text-red-500 mt-2 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="title_ku" class="block text-gray-700 font-bold mb-2">{{ __('Title (Kurdish)') }}</label>
                        <input type="text" name="title_ku" id="title_ku" dir="rtl"
                            class="form-input rounded-md shadow-sm w-full @error('title_ku') border-red-500 @enderror"
                            value="{{ old('title_ku', $category->getTranslation('title', 'ku')) }}">
                        @error('title_ku')
                            <span class="text-red-500 mt-2 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="image" class="block text-gray-700 font-bold mb-2">{{ __('Image') }}</label>
                        <input type="file" name="image" id="image"
                            class="form-input rounded-md shadow-sm @error('image') border-red-500 @enderror">
                        @error('image')
                            <span class="text-red-500 mt-2 text-sm">{{ $message }}</span>
                        @enderror
                        @if ($category->image)
                            <div class="mt-4">
                                <img src="{{ '/images/' . $category->image }}" alt="{{ __('Category Image') }}"
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
