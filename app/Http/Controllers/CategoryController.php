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
        $validatedData = $request->validate([
            'title' => 'required|max:100',
            'image' => 'required|image|max:2048',
        ]);

        $image = $request->image;
        $imageName = $image->getClientOriginalName();
        $imageName = time() . '_' . $imageName;
        $image->move('images', $imageName);

        // $imagePath = $request->image->store('images', 'public');

        $validatedData['image'] = $imageName;

        Category::create($validatedData);

        return redirect('/categories')->with('success', 'Category created successfully!');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        Log::info($request);
        $validatedData = $request->validate([
            'title' => 'required|max:100',
            'image' => 'image|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $image = $request->image;
            $imageName = $image->getClientOriginalName();
            $imageName = time() . '_' . $imageName;
            $image->move('images', $imageName);

            $validatedData['image'] = $imageName;
        }
        $category->update($validatedData);

        return redirect('/categories')->with('success', 'Category updated successfully!');
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
