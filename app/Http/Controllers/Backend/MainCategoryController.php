<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MainCategoryController extends Controller
{
    public function index()
    {
        $categories = MainCategory::all();
        return view("backend.category.index", compact("categories"));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $category = new MainCategory();
            $category->name = $request->name;

            $image = upload_image($request, $category);

            if ($image) {
                $category->image = upload_image($request, $category);
            }
            $category->save();

            return redirect()->back()->with('success', 'Main Category created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $category = MainCategory::findOrFail($id);
            $category->name = $request->name;

            $image = upload_image($request, $category);

            if ($image) {
                $category->image = upload_image($request, $category);
            }

            $category->save();

            return redirect()->back()->with('success', 'Main Category updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Update failed: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $category = MainCategory::findOrFail($id);

            if ($category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }

            $category->delete();

            return redirect()->back()->with('success', 'Main Category deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Delete failed: ' . $e->getMessage());
        }
    }
}
