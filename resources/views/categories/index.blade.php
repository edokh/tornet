@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-center">
            <div class="w-full lg:w-3/4 bg-white p-8 rounded-lg shadow-lg">
                <h1 class="text-2xl font-bold mb-8">{{ __('Categories') }}</h1>
                <div class="mb-6">
                    <a href="{{ route('categories.create') }}"
                        class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-400">{{ __('Create Category') }}</a>
                </div>
                @if (count($categories) > 0)
                    <table class="w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="text-left font-bold py-2 px-4">{{ __('Title (English)') }}</th>
                                <th class="text-left font-bold py-2 px-4">{{ __('Title (Arabic)') }}</th>
                                <th class="text-left font-bold py-2 px-4">{{ __('Title (Kurdish)') }}</th>
                                <th class="text-left font-bold py-2 px-4">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr class="border-t">
                                    <td class="py-2 px-4">{{ $category->getTranslation('title', 'en') }}</td>
                                    <td class="py-2 px-4">{{ $category->getTranslation('title', 'ar') }}</td>
                                    <td class="py-2 px-4">{{ $category->getTranslation('title', 'ku') }}</td>
                                    <td class="py-2 px-4">
                                        <a href="{{ route('categories.show', $category->id) }}"
                                            class="bg-blue-500 text-white py-1 px-2 rounded hover:bg-blue-400">{{ __('View') }}</a>
                                        <a href="{{ route('categories.edit', $category->id) }}"
                                            class="bg-yellow-500 text-white py-1 px-2 rounded hover:bg-yellow-400">{{ __('Edit') }}</a>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 text-white py-1 px-2 rounded hover:bg-red-400"
                                                onclick="return confirm('Are you sure you want to delete this Category?')">{{ __('Delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-gray-700">{{ __('No categories found.') }}</p>
                @endif
            </div>
        </div>
    </div>
@endsection
