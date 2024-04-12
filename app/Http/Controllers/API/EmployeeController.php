<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    // Create a new employee
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id', // Validate that the UserID exists in the users table
            'salary' => 'required|numeric', // Validate the salary field
            // You can add more validation rules here if needed
        ]);

        // Create the employee
        $employee = new Employee();
        $employee->user_id = $request->input('user_id'); // Assign the provided UserID to the new employee
        $employee->salary = $request->input('salary'); // Assign the provided salary to the new employee
        // Add other properties if needed
        $employee->save();

        return response()->json([
            "status" => true,
            "message" => "Employee created successfully",
            "data" => $employee
        ], 201);
    }
    
    // Retrieve all employees
    public function index()
    {
        $employees = Employee::all();
        return response()->json([
            'status' => true,
            'data' => $employees,
            'message' => 'List of employees'
        ]);
    }

    // Retrieve a specific employee by ID
    public function show($id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json([
                'status' => false,
                'message' => 'Employee not found'
            ], 404);
        }
        return response()->json([
            'status' => true,
            'data' => $employee,
            'message' => 'Employee found'
        ]);
    }

    // Update an employee
    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json([
                'status' => false,
                'message' => 'Employee not found'
            ], 404);
        }
        $employee->update($request->all());
        return response()->json([
            'status' => true,
            'data' => $employee,
            'message' => 'Employee updated successfully'
        ]);
    }

    // Delete an employee
    public function destroy($id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json([
                'status' => false,
                'message' => 'Employee not found'
            ], 404);
        }
        $employee->delete();
        return response()->json([
            'status' => true,
            'message' => 'Employee deleted successfully'
        ]);
    }
}
