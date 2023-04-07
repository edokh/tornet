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
        $blog->author_id = $request['author_id'];
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
