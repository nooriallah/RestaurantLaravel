<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tables = Table::all();
         
        return view('admin.tables.index', compact('tables')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tables.create'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:tables,name',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|string',
            'location' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        

        $table = new Table();
        $table->name = $request->input('name');
        $table->capacity = $request->input('capacity');
        $table->status = $request->input('status');
        $table->location = $request->input('location');
        $table->description = $request->input('description');

        // if ($request->hasFile('image')) {
        //     $imagePath = $request->file('image')->store('images/tables', 'public');
        //     $table->image = $imagePath;
        // }
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/table'), $imageName);
            $table->image = $imageName;
        }

        $table->save();

        return redirect()->route('tables.index')->with('success', 'Table created successfully.');
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
    public function edit(Table $table)
    {
        
        return view('admin.tables.edit', compact('table')); // Assuming you have a view for editing a table
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Table $table)
    {
        $request->validate([
            'name' => 'required|unique:tables,name,' . $table->id,
            'capacity' => 'required|integer|min:1',
            'status' => 'required|string',
            'location' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $table->name = $request->input('name');
        $table->capacity = $request->input('capacity');
        $table->status = $request->input('status');
        $table->location = $request->input('location');
        $table->description = $request->input('description');

        if ($request->hasFile('image')) {
            // remove old image file if exists
            if ($table->image && file_exists(public_path("images/table/$table->image"))) {
                unlink(public_path('images/table/' . $table->image));
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/table'), $imageName);
            $table->image = $imageName;
        }

        $table->update();

        return redirect()->route('tables.index')->with('success', 'Table updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Table $table)
    {
        // remove associated image file if exists
        if ($table->image && file_exists(public_path("images/tables/$table->image"))) {
            unlink(public_path("images/tables/$table->image"));
        }
        $table->delete();
        return redirect()->route('tables.index')->with('success', 'Table deleted successfully.');
    }
}
