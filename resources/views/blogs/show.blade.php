@extends('layouts.app')
@section('content')
    <div class="py-12 bg-white min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Create Blog') }}
                </h2>
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h1 class="text-2xl font-bold mb-2">{{ $blog->title }}</h1>
                            <p class="text-gray-600 text-sm mb-4">
                                {{ $blog->category ? 'Category: ' . $blog->category->title : 'Uncategorized' }}
                            </p>
                            <p class="text-gray-600 text-sm mb-4">By {{ $blog->author->name }} on
                                {{ $blog->created_at->format('F j, Y') }}</p>

                            <img src="{{ '/images/' . $blog->image }}" alt="{{ $blog->title }}" class="mb-4">
                            <p class="text-gray-700 text-base mb-6">{{ $blog->content }}</p>
                            <a href="{{ route('blogs.edit', $blog) }}"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Edit</a>
                            <form action="{{ route('blogs.destroy', $blog) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                    onclick="return confirm('Are you sure you want to delete this blog?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
