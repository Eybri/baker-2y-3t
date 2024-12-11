<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventories = Inventory::orderBy('id', 'DESC')->get();
        return response()->json($inventories);
    }

    public function getStockData()
{
    $stocks = Inventory::select('item', \DB::raw('SUM(stock) as total_stock'))
                        ->groupBy('item')
                        ->get();

    return response()->json($stocks);
}

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        $request->validate([
            'item' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'supplier' => 'required|string|max:255',
        ]);

        $inventory = new Inventory();
        $inventory->item = $request->item;
        $inventory->stock = $request->stock;
        $inventory->supplier = $request->supplier;

        $inventory->save();

        return response()->json([
            "success" => "Inventory item added successfully.",
            "inventory" => $inventory,
            "status" => 200
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $inventory = Inventory::findOrFail($id);
            return response()->json($inventory);
        } catch (ModelNotFoundException $e) {
            return response()->json(["error" => "Inventory item not found."], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $inventory = Inventory::findOrFail($id);

            $request->validate([
                'item' => 'required|string|max:255',
                'stock' => 'required|integer|min:0',
                'supplier' => 'required|string|max:255',
            ]);

            $inventory->item = $request->item;
            $inventory->stock = $request->stock;
            $inventory->supplier = $request->supplier;

            $inventory->save();

            return response()->json([
                "success" => "Inventory item updated successfully.",
                "inventory" => $inventory,
                "status" => 200
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(["error" => "Inventory item not found."], 404);
        } catch (\Exception $e) {
            return response()->json(["error" => "An error occurred: " . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $inventory = Inventory::findOrFail($id);
            $inventory->delete();
            return response()->json([
                "success" => "Inventory item deleted successfully.",
                "status" => 200
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(["error" => "Inventory item not found."], 404);
        } catch (\Exception $e) {
            return response()->json(["error" => "An error occurred: " . $e->getMessage()], 500);
        }
    }
}
