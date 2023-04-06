<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>
    <div class="py-12 bg-white min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                @if (session('success'))
                    <div class="bg-green-200 text-green-700 px-4 py-2 mb-4 rounded-md">{{ session('success') }}</div>
                @endif

                <a href="{{ route('categories.create') }}"
                    class="  text-white px-4 py-2 rounded-md bg-indigo-600 hover:bg-indigo-700 mb-4 inline-block">Create
                    Category</a>

                <table class="table-auto w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="px-4 py-2 border">ID</th>
                            <th class="px-4 py-2 border">Title</th>
                            <th class="px-4 py-2 border">Image</th>
                            <th class="px-4 py-2 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr class="border">
                                <td class="px-4 py-2 border">{{ $category->id }}</td>
                                <td class="px-4 py-2 border">{{ $category->title }}</td>
                                <td class="px-4 py-2 border">
                                    <img src="{{ 'images/' . $category->image }}" alt="{{ $category->title }}"
                                        width="100">
                                </td>
                                <td class="px-4 py-2 border">

                                    <a href="{{ route('categories.show', $category) }}"
                                        class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600">View</a>
                                    <a href="{{ route('categories.edit', $category->id) }}"
                                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Edit</a>

                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 ml-2"
                                            onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
