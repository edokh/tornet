<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('category', 'author')->where('author_id', Auth::id())->paginate(4);
        return view('blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required|max:100',
            'title_ar' => 'required|max:100',
            'title_ku' => 'required|max:100',
            'content_en' => 'required|max:255',
            'content_ar' => 'required|max:255',
            'content_ku' => 'required|max:255',
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

        $blog->setTranslations('title', [
            'en' => $request->input('title_en'),
            'ar' => $request->input('title_ar'),
            'ku' => $request->input('title_ku'),
        ]);
        $blog->setTranslations('content', [
            'en' => $request->input('content_en'),
            'ar' => $request->input('content_ar'),
            'ku' => $request->input('content_ku'),
        ]);

        $blog->category_id = $request['category_id'];
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
        Log::info($request);
        $request->validate([
            'title_en' => 'required|max:100',
            'title_ar' => 'required|max:100',
            'title_ku' => 'required|max:100',
            'content_en' => 'required|max:255',
            'content_ar' => 'required|max:255',
            'content_ku' => 'required|max:255',
            'category_id' => 'required',
        ]);

        $blog->setTranslations('title', [
            'en' => $request->input('title_en'),
            'ar' => $request->input('title_ar'),
            'ku' => $request->input('title_ku'),
        ]);

        $blog->setTranslations('content', [
            'en' => $request->input('content_en'),
            'ar' => $request->input('content_ar'),
            'ku' => $request->input('content_ku'),
        ]);

        if ($request->hasFile('image')) {
            $image = $request->image;
            $imageName = $image->getClientOriginalName();
            $imageName = time() . '_' . $imageName;
            $image->move('images', $imageName);
            $blog->image = $imageName;
        }

        $blog->category_id = $request['category_id'];
        $blog->save();

        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        // if (file_exists('images/' . $blog->image))
        //     unlink('images/' . $blog->image);
        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog post deleted successfully.');
    }
}
