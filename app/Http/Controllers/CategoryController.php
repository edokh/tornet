<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
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

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
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

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect('/categories')->with('success', 'Category deleted successfully!');
    }
}
