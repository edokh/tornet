<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('category', 'author')->where('author_id', Auth::id())->paginate(3);
        return view('blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:100',
            'content' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'required',
        ]);

        $imageName = 'test.jpg';
        if ($request->hasFile('image')) {
            $image = $request->image;
            $imageName = $image->getClientOriginalName();
            $imageName = time() . '_' . $imageName;
            $image->move('images', $imageName);
        }

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
        if ($blog->author_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('blogs.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        if ($blog->author_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        $categories = Category::all();
        return view('blogs.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:100',
            'content' => 'required|max:255',
            'category_id' => 'required',
            'image' => '',
        ]);

        if ($request->hasFile('image')) {

            $image = $request->image;
            $imageName = $image->getClientOriginalName();
            $imageName = time() . '_' . $imageName;
            $image->move('images', $imageName);

            // if (file_exists('images/' . $blog->image))
            //     unlink('images/' . $blog->image);
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
        // if (file_exists('images/' . $blog->image))
        //     unlink('images/' . $blog->image);
        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog post deleted successfully.');
    }
}
