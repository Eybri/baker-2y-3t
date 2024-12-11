<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Storage;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('position')->orderBy('id', 'DESC')->get();
        return response()->json($employees);
    }

    public function getPositionData()
{
    $positions = Employee::select('position_id', \DB::raw('count(*) as total'))
        ->groupBy('position_id')
        ->with('position') // Assuming you have a relationship with the Position model
        ->get();
        
    return response()->json(['data' => $positions]);
}


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'position_id' => 'required|exists:positions,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $employee = new Employee;
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->position_id = $request->position_id;

        if ($request->hasFile('image')) {
            $fileName = Str::random(20) . '.' . $request->image->getClientOriginalExtension();
            $request->image->storeAs('public/images', $fileName);
            $employee->image = 'storage/images/' . $fileName;
        }

        $employee->save();

        return response()->json(["success" => "Employee created successfully.", "employee" => $employee, "status" => 200]);
    }

    public function show(string $id)
    {
        try {
            $employee = Employee::findOrFail($id);
            return response()->json($employee);
        } catch (ModelNotFoundException $e) {
            return response()->json(["error" => "Employee not found."], 404);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $employee = Employee::findOrFail($id);

            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'position_id' => 'required|exists:positions,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->position_id = $request->position_id;

            if ($request->hasFile('image')) {
                // Delete old image from storage
                if ($employee->image) {
                    Storage::delete(str_replace('storage/', 'public/', $employee->image));
                }

                // Store new image
                $fileName = Str::random(20) . '.' . $request->image->getClientOriginalExtension();
                $request->image->storeAs('public/images', $fileName);
                $employee->image = 'storage/images/' . $fileName;
            }

            $employee->save();

            return response()->json(["success" => "Employee updated successfully.", "employee" => $employee, "status" => 200]);
        } catch (ModelNotFoundException $e) {
            return response()->json(["error" => "Employee not found."], 404);
        }
    }

    public function destroy(string $id)
    {
        try {
            $employee = Employee::findOrFail($id);

            if ($employee->image) {
                Storage::delete(str_replace('storage/', 'public/', $employee->image));
            }

            $employee->delete();

            return response()->json(["success" => "Employee and associated image deleted successfully.", "status" => 200]);
        } catch (ModelNotFoundException $e) {
            return response()->json(["error" => "Employee not found."], 404);
        }
    }
}
