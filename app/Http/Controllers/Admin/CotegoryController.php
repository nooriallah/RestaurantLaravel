<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CotegoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:20',
            'description' => 'nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        
        $category_image = null;
        if ($request->hasFile("image")) {
            $image = $request->image;
            $category_image = $request->name . "_" . time() . "." . $image->getClientOriginalExtension();
            $request->image->move("images/categories/", $category_image);
        }

        $category->image = $category_image;
        $category->save();

        return redirect()->back()->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // $category = Category::find($category->id);
        $categories = Category::all();
        return view('admin.categories.edit', compact(['category', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // dd($request->all(), $category);

        $request->validate(rules: [
            'name' => 'required|string|max:20',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $category->name = $request->name;
        $category->description = $request->description;

        if ($request->hasFile("image")) {
            // Delete old image if exists
            if ($category->image) {
                $old_image_path = public_path("images/categories/$category->image");
                if (file_exists($old_image_path)) {
                    unlink($old_image_path);
                }
                $image = $request->image;
                $category_image = $request->name . "_" . time() . "." . $image->getClientOriginalExtension();
                $request->image->move("images/categories/", $category_image);
                $category->image = $category_image;
            }
        }

        $category->update();

        return redirect()->back()->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category) {
            if ($category->image) {
                $image_path = public_path('images/categories/' . $category->image);
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
            $category->delete();
            return redirect()->back()->with('success', 'Category deleted successfully.');
        }
        return redirect()->back()->with('error', 'Category not found.');
    }
}
