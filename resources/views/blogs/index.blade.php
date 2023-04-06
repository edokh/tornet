<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="flex justify-between">
            <h2 class="text-2xl font-bold leading-tight text-gray-900">
                {{ __('Blog') }}
            </h2>
            <a href="{{ route('blogs.create') }}" class="px-4 py-2 text-white bg-indigo-600 rounded hover:bg-indigo-700">
                {{ __('Create Post') }}
            </a>
        </div>

        <div class="mt-6">
            @if ($blogs->isEmpty())
                <p class="text-gray-500">{{ __('No blogs found.') }}</p>
            @else
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @foreach ($blogs as $blog)
                        <div class="flex flex-col bg-white rounded-lg shadow-md overflow-hidden">
                            <div class="flex-shrink-0">
                                <img class="object-cover w-full h-48" src="{{ '/images/' . $blog->image }}"
                                    alt="{{ $blog->title }}">
                            </div>
                            <div class="flex-1 p-6">
                                <div class="flex justify-between">
                                    <p class="text-lg font-bold text-gray-900">{{ $blog->title }}</p>
                                    <p class="text-sm font-medium text-gray-500">{{ $blog->category->name }}</p>
                                </div>
                                <p class="mt-4 text-gray-700">{{ Str::limit($blog->content, 100) }}</p>
                                <div class="flex justify-between items-center mt-6">
                                    <a href="{{ route('blogs.show', $blog->id) }}"
                                        class="text-sm font-medium text-blue-500 hover:text-blue-600">{{ __('View') }}</a>
                                    <p class="text-sm font-medium text-gray-500">
                                        {{ __('Created on :date', ['date' => $blog->created_at->format('M d, Y')]) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-6">
                    {{ $blogs->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
