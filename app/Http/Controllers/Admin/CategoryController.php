<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        return response()->json($categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;

        $category->save();

        return response()->json([
            "success" => "Category created successfully.",
            "category" => $category,
            "status" => 200
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $category = Category::findOrFail($id);
            return response()->json($category);
        } catch (ModelNotFoundException $e) {
            return response()->json(["error" => "Category not found."], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $category = Category::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
            ]);

            $category->name = $request->name;
            $category->description = $request->description;

            $category->save();

            return response()->json([
                "success" => "Category updated successfully.",
                "category" => $category,
                "status" => 200
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                "error" => "Category not found."
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                "error" => "An error occurred: " . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();
            return response()->json([
                "success" => "Category deleted successfully.",
                "status" => 200
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(["error" => "Category not found."], 404);
        } catch (\Exception $e) {
            return response()->json([
                "error" => "An error occurred: " . $e->getMessage()
            ], 500);
        }
    }
}
