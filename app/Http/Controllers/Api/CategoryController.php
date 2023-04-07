<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return $categories;
    }


    public function store(Request $request)
    {

        $request->validate([
            'title_en' => 'required|max:100',
            'title_ar' => 'required|max:100',
            'title_ku' => 'required|max:100',
            'image' => 'required',
        ]);

        $category = new Category;
        $category->setTranslations('title', [
            'en' => $request->input('title_en'),
            'ar' => $request->input('title_ar'),
            'ku' => $request->input('title_ku'),
        ]);
        $imageName = 'default.jpg';
        if ($request->hasFile('image')) {
            $imageName = 'test.jpg';
            if ($request->hasFile('image')) {
                $image = $request->image;
                $imageName = $image->getClientOriginalName();
                $imageName = time() . '_' . $imageName;
                $image->move('images', $imageName);
            }
        }

        $category->image = $imageName;
        $category->save();

        return 'Category created successfully.';
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if (!$category)
            return 'Category is not exist';
        $request->validate([
            'title_en' => 'required|max:255',
            'title_ar' => 'required|max:255',
            'title_ku' => 'required|max:255',
        ]);

        $category->setTranslations('title', [
            'en' => $request->input('title_en'),
            'ar' => $request->input('title_ar'),
            'ku' => $request->input('title_ku'),
        ]);

        if ($request->hasFile('image')) {
            $image = $request->image;
            $imageName = $image->getClientOriginalName();
            $imageName = time() . '_' . $imageName;
            $image->move('images', $imageName);
            $category->image = $imageName;
        }

        $category->save();

        return  'Category updated successfully!';
    }
    public function show($id)
    {
        $category = Category::find($id);
        if (!$category)
            return 'Category is not exist';
        return $category;
    }
    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category) {

            $category->delete();

            return 'Category deleted successfully!';
        }
        return 'Category is not exist';
    }
}
