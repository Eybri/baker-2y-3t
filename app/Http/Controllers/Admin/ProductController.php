<?php

// app/Http/Controllers/Admin/ProductController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
// use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use DataTable;
use Storage;

class ProductController extends Controller
{

    public function products()
    {
        return view('admin.products.index');
    }
    
    public function showdata()
    {
        $products = Product::all();
        return response()->json(['data' => $products]);
    }

    public function get()
    {
        $products = Product::all();
        return response()->json(['data' => $products]);
    }


    public function getProductData(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::all();
            return DataTables::of($data)
                ->addColumn('image', function ($row) {
                    return '<img src="' . asset('images/products/' . $row->image) . '" width="100" height="100">';
                })
                ->addColumn('actions', function ($row) {
                    $btn = '<button class="btn btn-primary btnEdit" data-id="'.$row->id.'">Edit</button>';
                    $btn .= ' <button class="btn btn-danger btnDelete" data-id="'.$row->id.'">Delete</button>';
                    return $btn;
                })
                ->rawColumns(['image', 'actions'])
                ->make(true);
        }
        return view('admin.products.index');
    }
    public function getProductsPerCategory()
    {
        $categories = Category::withCount('products')->get();
        return response()->json($categories);
    }


    public function edit(Request $request)
    {
        $productId = $request->input('id');
        $product = Product::find($productId);

        if ($product) {
            return response()->json(['success' => true, 'data' => $product]);
        } else {
            return response()->json(['success' => false, 'message' => 'Product not found.']);
        }
    }



    public function index()
    {
        $products = Product::with('category')->orderBy('id', 'DESC')->get();
        //  dd($products);
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'cost_price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->cost_price = $request->cost_price;
        $product->quantity = $request->quantity;
        $product->image = '';
        $product->category_id = $request->category_id;

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/images', $fileName);
                $product->image .= 'storage/images/' . $fileName . ',';
            }
            $product->image = rtrim($product->image, ',');
        }

        $product->save();

        return response()->json(["success" => "Product created successfully.", "product" => $product, "status" => 200]);
    }

    public function show(string $id)
    {
        try {
            $product = Product::findOrFail($id);
            return response()->json($product);
        } catch (ModelNotFoundException $e) {
            return response()->json(["error" => "Product not found."], 404);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $product = Product::findOrFail($id);
    
            $request->validate([
                'name' => 'required',
                'description' => 'required',
                'price' => 'required|numeric',
                'cost_price' => 'required|numeric',
                'quantity' => 'required|numeric',
                'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'category_id' => 'required|exists:categories,id',
            ]);
    
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->cost_price = $request->cost_price;
            $product->category_id = $request->category_id;
    
            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old images from storage
                if ($product->image) {
                    $imagePaths = explode(',', $product->image);
                    foreach ($imagePaths as $path) {
                        $filePath = public_path('storage/images/' . basename($path));
                        if (file_exists($filePath)) {
                            unlink($filePath);
                        }
                    }
                }
    
                // Store new images
                $imagePaths = [];
                foreach ($request->file('image') as $file) {
                    $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('public/images', $fileName);
                    $imagePaths[] = 'storage/images/' . $fileName;
                }
    
                $product->image = implode(',', array_unique($imagePaths));
            }
    
            $product->save();
    
            return response()->json(["success" => "Product updated successfully.", "product" => $product, "status" => 200]);
        } catch (ModelNotFoundException $e) {
            return response()->json(["error" => "Product not found."], 404);
        } catch (\Exception $e) {
            return response()->json(["error" => "An error occurred: " . $e->getMessage()], 500);
        }
    }
    

    public function destroy(string $id)
    {
        try {
            $product = Product::findOrFail($id);

            if ($product->image) {
                $imagePaths = explode(',', $product->image);
                foreach ($imagePaths as $path) {
                    $filePath = public_path($path);
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
            }

            $product->delete();

            return response()->json(["success" => "Product and associated images deleted successfully.", "status" => 200]);
        } catch (ModelNotFoundException $e) {
            return response()->json(["error" => "Product not found."], 404);
        } catch (\Exception $e) {
            return response()->json(["error" => "An error occurred: " . $e->getMessage()], 500);
        }
    }
}