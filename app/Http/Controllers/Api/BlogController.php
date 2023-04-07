<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $blogs = Blog::with('category', 'author')->where('author_id', $request->author_id)->paginate(10);
        return $blogs;
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
        $blog->author_id = $request->author_id;
        $blog->save();

        return 'Blog post created successfully.';
    }

    public function show($id)
    {
        $blog = Blog::find($id);
        if (!$blog)
            return 'Blog is not exist';
        return $blog;
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::find($id);
        if (!$blog)
            return 'Blog is not exist';
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

            $blog->image = $imageName;
        } else {

            $blog->image = 'default.jpg';
        }

        $blog->title = $validatedData['title'];
        $blog->content = $validatedData['content'];
        $blog->category_id = $validatedData['category_id'];
        $blog->author_id = $request->author_id;
        $blog->save();

        return 'Blog post updated successfully.';
    }

    public function destroy($id)
    {
        // if (file_exists('images/' . $blog->image))
        //     unlink('images/' . $blog->image);
        $blog = Blog::find($id);
        if (!$blog)
            return 'Blog is not exist';
        $blog->delete();

        return 'Blog post deleted successfully.';
    }
}
