@extends('layouts.app')
@section('content')
    <div class="py-12 bg-white min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <h1 class="text-3xl font-semibold mb-2">{{ $category->title }}</h1>
                        <p class="text-gray-500 text-sm">Created at {{ $category->created_at }}</p>
                    </div>
                    <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                        <dl class="sm:divide-y sm:divide-gray-200">
                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Title</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $category->title }}</dd>
                            </div>
                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Image</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <img src="{{ '/images/' . $category->image }}" alt="{{ $category->title }}"
                                        class="w-48 h-auto">
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('categories.edit', $category->id) }}"
                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Edit Category</a>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 ml-2"
                            onclick="return confirm('Are you sure you want to delete this category?')">Delete
                            Category</button>
                    </form>
                    <a href="{{ route('categories.index') }}"
                        class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400 ml-2">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
