<!-- Sidebar -->
<aside class="bg-indigo-600 h-full min-h-screen w-64 hidden sm:block">
    <div class="p-6">
        <a href="{{ route('dashboard') }}"
            class="text-white text-3xl font-semibold uppercase hover:text-indigo-300">Dashboard</a>
    </div>
    <nav class="text-white text-base font-semibold pt-3">
        <a href="{{ route('blogs.index') }}"
            class="flex items-center py-2 px-6 hover:bg-indigo-700 @if (Request::is('blogs*')) bg-indigo-700 @endif">
            <i class="fas fa-newspaper mr-3"></i>
            Posts
        </a>
        <a href="{{ route('categories.index') }}"
            class="flex items-center py-2 px-6 hover:bg-indigo-700 @if (Request::is('categories*')) bg-indigo-700 @endif">
            <i class="fas fa-th-large mr-3"></i>
            Categories
        </a>
        {{-- <a href="{{ route('profile.index') }}"
            class="flex items-center py-2 px-6 hover:bg-indigo-700 @if (Request::is('profile*')) bg-indigo-700 @endif">
            <i class="fas fa-user mr-3"></i>
            Profile
        </a> --}}
    </nav>
</aside>
