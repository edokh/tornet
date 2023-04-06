<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('category', 'author')->paginate(2);
        return view('blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        Log::info($request);
        $validatedData = $request->validate([
            'title' => 'required|max:100',
            'content' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // $imagePath = $request->file('image')->store('image');

        $image = $request->image;
        $imageName = $image->getClientOriginalName();
        $imageName = time() . '_' . $imageName;
        $image->move('images', $imageName);

        $blog = new Blog();
        $blog->title = $validatedData['title'];
        $blog->content = $validatedData['content'];
        $blog->category_id = $validatedData['category_id'];
        $blog->image = $imageName;
        $blog->author_id = Auth::id();
        $blog->save();

        return redirect()->route('blogs.index')->with('success', 'Blog post created successfully.');
    }

    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        $categories = Category::all();
        return view('blogs.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:100',
            'content' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {

            $image = $request->image;
            $imageName = $image->getClientOriginalName();
            $imageName = time() . '_' . $imageName;
            $image->move('images', $imageName);

            unlink('images/' . $blog->image);
            $blog->image = $imageName;
        }

        $blog->title = $validatedData['title'];
        $blog->content = $validatedData['content'];
        $blog->category_id = $validatedData['category_id'];
        $blog->save();

        return redirect()->route('blogs.index')->with('success', 'Blog post updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        unlink('images/' . $blog->image);
        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog post deleted successfully.');
    }
}
