<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use function PHPSTORM_META\type;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::all();

        return view('admin.menu.index', compact('menus')); // Assuming you have a view for listing menu items
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.menu.create', compact('categories')); // Assuming you have a view for creating a menu item
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $menu = new Menu();
        $menu->name = $request->name;
        $menu->slug = Str::slug($request->name); // Generate slug from name
        $menu->description = $request->description;
        $menu->price = $request->price;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/menus'), $imageName);
            $menu->image = $imageName;
        }

        $menu->save();

        // I was here
        if ($request->has('categories')) {
            // dd($request->categories);
            $menu->categories()->sync($request->categories); // Attach selected categories
        }


        return redirect()->route('menu.index')->with('success', 'Menu item added successfully.');
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
    public function edit(Menu $menu)
    {
        $categories = Category::all();


        foreach ($menu->categories as $category) {
            $all = $category->selected = $menu->categories->contains($category->id);
        }
        // return $menu->category_id;

        // dd();
        return view('admin.menu.edit', compact(['menu', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $menu->name = $request->name;
        $menu->slug = Str::slug($request->name); // Generate slug from name
        $menu->description = $request->description;
        $menu->price = $request->price;

        // check if image exist and user add new image replace it with new image and remove previus one




        if ($request->hasFile('image')) {
            if ($menu->image && file_exists(public_path('images/menus/' . $menu->image))) {
                unlink(public_path('images/menus/' . $menu->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/menus'), $imageName);
            $menu->image = $imageName;
        }

        $menu->update();

        if ($request->has('categories')) {
            $menu->categories()->sync($request->categories); // Sync selected categories
        } else {
            $menu->categories()->detach(); // Detach all categories if none selected
        }

        return redirect()->route('menu.index')->with('success', 'Menu item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu  )
    {
        // Delete associated image file if exists
        if ($menu->image && file_exists(public_path('images/menus/' . $menu->image))) {
            unlink(public_path('images/menus/' . $menu->image));
        }

        // Detach all categories
        $menu->categories()->detach();

        // Delete the menu item
        $menu->delete();

        return redirect()->route('menu.index')->with('success', 'Menu item deleted successfully.');
    }
}
