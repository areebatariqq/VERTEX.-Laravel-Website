<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modules = Module::all();
        return view('admin.modules.index', compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.modules.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:module,workshop,webinar,competition',
            'fee' => 'required|numeric',
            'earlybird_fee' => 'nullable|numeric',
            'team_min' => 'required|integer|min:1',
            'team_max' => 'required|integer|min:1',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
            'duration' => 'nullable|string',
            'date' => 'nullable|date',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/modules'), $imageName);
            $validated['image'] = 'images/modules/' . $imageName;
        }

        Module::create($validated);

        return redirect()->route('admin.modules.index')->with('success', 'Module created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Module $module)
    {
        return view('admin.modules.edit', compact('module'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Module $module)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:module,workshop,webinar,competition',
            'fee' => 'required|numeric',
            'earlybird_fee' => 'nullable|numeric',
            'team_min' => 'required|integer|min:1',
            'team_max' => 'required|integer|min:1',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
            'duration' => 'nullable|string',
            'date' => 'nullable|date',
        ]);

        if ($module->name !== $validated['name']) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($module->image && file_exists(public_path($module->image))) {
                unlink(public_path($module->image));
            }
            
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/modules'), $imageName);
            $validated['image'] = 'images/modules/' . $imageName;
        }

        $module->update($validated);

        return redirect()->route('admin.modules.index')->with('success', 'Module updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module)
    {
        $module->delete();
        return redirect()->route('admin.modules.index')->with('success', 'Module deleted successfully.');
    }
}
