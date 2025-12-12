<?php
namespace App\Services;

use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ModuleService
{
    /**
     * Get all modules.
     */
    public function getAllModules()
    {
        return Module::all();
    }

    /**
     * Create a new module.
     */
    public function createModule(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:module,workshop,webinar,competition',
            'fee' => 'required|numeric',
            'earlybird_fee' => 'nullable|numeric',
            'team_min' => 'required|integer|min:1',
            'team_max' => 'required|integer|min:1',
            'duration' => 'nullable|string|max:255',
            'date' => 'nullable|date',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $data = $request->all();
            
            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/modules'), $imageName);
                $data['image'] = 'images/modules/' . $imageName;
            }
            
            Module::create($data);
            return ['success' => true, 'message' => 'Module created successfully!'];
        } catch (\Exception $e) {
            Log::error('Module creation failed: ' . $e->getMessage());
            return ['success' => false, 'message' => 'Something went wrong. Please try again later.'];
        }
    }

    /**
     * Edit a module.
     */
    public function editModule($id)
    {
        return Module::findOrFail($id);
    }

    /**
     * Update a module's information.
     */
    public function updateModule(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required|string|max:255',
            'type' => 'required|in:module,workshop,webinar,competition',
            'fee' => 'required|numeric',
            'earlybird_fee' => 'nullable|numeric',
            'team_min' => 'required|integer|min:1',
            'team_max' => 'required|integer|min:1',
            'duration' => 'nullable|string|max:255',
            'date' => 'nullable|date',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $module = Module::findOrFail($request->id);

        if ($module) {
            try {
                $data = $request->all();
                
                // Handle image upload
                if ($request->hasFile('image')) {
                    // Delete old image
                    if ($module->image && file_exists(public_path($module->image))) {
                        unlink(public_path($module->image));
                    }
                    
                    $image = $request->file('image');
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('images/modules'), $imageName);
                    $data['image'] = 'images/modules/' . $imageName;
                }
                
                $module->update($data);
                return ['success' => true, 'message' => 'Module updated successfully!'];
            } catch (\Exception $e) {
                Log::error('Update Failed. ' . $e->getMessage());
                return ['success' => false, 'message' => 'Something went wrong. Please try again later.'];
            }
        }

        return ['success' => false, 'message' => 'Invalid Module ID'];
    }

    /**
     * Delete a module.
     */
    public function deleteModule($id)
    {
        $module = Module::findOrFail($id);

        try {
            // Delete image if exists
            if ($module->image && file_exists(public_path($module->image))) {
                unlink(public_path($module->image));
            }
            
            $module->delete();
            return ['success' => true, 'message' => 'Module deleted successfully!'];
        } catch (\Exception $e) {
            Log::error('Delete operation failed. ' . $e->getMessage());
            return ['success' => false, 'message' => 'Something went wrong. Please try again later.'];
        }
    }
}
