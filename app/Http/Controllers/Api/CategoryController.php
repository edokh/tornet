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
        $validatedData = $request->validate([
            'title' => 'required|max:100',
            'image' => 'required',
        ]);

        $imageName = 'test.jpg';
        if ($request->hasFile('image')) {
            $image = $request->image;
            $imageName = $image->getClientOriginalName();
            $imageName = time() . '_' . $imageName;
            $image->move('images', $imageName);
        }

        // $imagePath = $request->image->store('images', 'public');

        $validatedData['image'] = $imageName;

        Category::create($validatedData);

        return 'Category created successfully!';
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if (!$category)
            return 'Category is not exist';
        $validatedData = $request->validate([
            'title' => 'required|max:100',
            'image' => 'image|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $image = $request->image;
            $imageName = $image->getClientOriginalName();
            $imageName = time() . '_' . $imageName;
            $image->move('images', $imageName);
            // if (file_exists('images/' . $category->image))
            //     unlink('images/' . $category->image);
            $validatedData['image'] = $imageName;
        }
        $category->update($validatedData);

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
