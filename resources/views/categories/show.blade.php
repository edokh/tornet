@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-center">
            <div class="w-full lg:w-1/2 bg-white p-8 rounded-lg shadow-lg">
                <h1 class="text-2xl font-bold mb-8">{{ __('Category Details') }}</h1>
                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">{{ __('Title (English)') }}</label>
                    <p>{{ $category->getTranslation('title', 'en') }}</p>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">{{ __('Title (Arabic)') }}</label>
                    <p>{{ $category->getTranslation('title', 'ar') }}</p>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">{{ __('Title (Kurdish)') }}</label>
                    <p>{{ $category->getTranslation('title', 'ku') }}</p>
                </div>
                @if ($category->image)
                    <div class="mb-6">
                        <label class="block text-gray-700 font-bold mb-2">{{ __('Image') }}</label>
                        <img src="{{ '/images/' . $category->image }}" alt="{{ __('Category Image') }}"
                            class="w-full h-auto">
                    </div>
                @endif
                <div>
                    <a href="{{ route('categories.edit', $category->id) }}"
                        class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-400">{{ __('Edit') }}</a>
                    <a href="{{ route('categories.index') }}"
                        class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-400">{{ __('Back') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
