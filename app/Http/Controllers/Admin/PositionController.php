<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employeeposition = Position::orderBy('id', 'DESC')->get();
        return response()->json($employeeposition);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'position_name' => 'required|string|max:255',
            'salary' => 'required|numeric',
        ]);

        $employee = new Position();
        $employee->position_name = $request->position_name;
        $employee->salary = $request->salary;

        $employee->save();

        return response()->json([
            "success" => "Employee created successfully.",
            "employee" => $employee,
            "status" => 200
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $employee = Position::findOrFail($id);
            return response()->json($employee);
        } catch (ModelNotFoundException $e) {
            return response()->json(["error" => "Employee not found."], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $employee = Position::findOrFail($id);

            $request->validate([
                'position_name' => 'required|string|max:255',
                'salary' => 'required|numeric',
            ]);

            $employee->position_name = $request->position_name;
            $employee->salary = $request->salary;

            $employee->save();

            return response()->json([
                "success" => "Employee updated successfully.",
                "employee" => $employee,
                "status" => 200
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                "error" => "Employee not found."
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
            $employee = Position::findOrFail($id);
            $employee->delete();
            return response()->json([
                "success" => "Employee deleted successfully.",
                "status" => 200
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(["error" => "Employee not found."], 404);
        } catch (\Exception $e) {
            return response()->json([
                "error" => "An error occurred: " . $e->getMessage()
            ], 500);
        }
    }
}
