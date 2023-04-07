@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-center">
            <div class="w-full lg:w-1/2 bg-white p-8 rounded-lg shadow-lg">
                <h1 class="text-2xl font-bold mb-1">{{ __('Blog Details') }}</h1>
                <p class="text-sm">Created by <strong> {{ $blog->author->name }}</strong></p>
                <p class="mb-8 text-sm">Category
                    <strong>{{ $blog->category ? $blog->category->title : 'Uncategorized' }}</strong>
                </p>
                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">{{ __('Title (English)') }}</label>
                    <p>{{ $blog->getTranslation('title', 'en') }}</p>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">{{ __('Title (Arabic)') }}</label>
                    <p>{{ $blog->getTranslation('title', 'ar') }}</p>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">{{ __('Title (Kurdish)') }}</label>
                    <p>{{ $blog->getTranslation('title', 'ku') }}</p>
                </div>


                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">{{ __('Content (English)') }}</label>
                    <p>{{ $blog->getTranslation('content', 'en') }}</p>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">{{ __('Content (Arabic)') }}</label>
                    <p>{{ $blog->getTranslation('content', 'ar') }}</p>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">{{ __('Content (Kurdish)') }}</label>
                    <p>{{ $blog->getTranslation('content', 'ku') }}</p>
                </div>
                @if ($blog->image)
                    <div class="mb-6">
                        <label class="block text-gray-700 font-bold mb-2">{{ __('Image') }}</label>
                        <img src="{{ '/images/' . $blog->image }}" alt="{{ __('Blog Image') }}" class="w-full h-auto">
                    </div>
                @endif
                <div>
                    <a href="{{ route('blogs.edit', $blog->id) }}"
                        class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-400">{{ __('Edit') }}</a>
                    <a href="{{ route('blogs.index') }}"
                        class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-400">{{ __('Back') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
