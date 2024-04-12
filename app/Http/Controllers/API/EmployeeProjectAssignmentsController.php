<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployeeProjectAssignment;

class EmployeeProjectAssignmentsController extends Controller
{
    // Create a new employee project assignment
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id', // Validate that the EmployeeID exists in the employees table
            'project_id' => 'required|exists:projects,id', // Validate that the ProjectID exists in the projects table
            'assignment_date' => 'required|date',
            // You can add more validation rules here if needed
        ]);

        // Create the employee project assignment
        $assignment = new EmployeeProjectAssignment();
        $assignment->employee_id = $request->input('employee_id');
        $assignment->project_id = $request->input('project_id');
        $assignment->assignment_date = $request->input('assignment_date');
        // Add other properties if needed
        $assignment->save();

        return response()->json([
            "status" => true,
            "message" => "Employee project assignment created successfully",
            "data" => $assignment
        ], 201);
    }
    
    // Retrieve all employee project assignments
    public function index()
    {
        $assignments = EmployeeProjectAssignment::all();
        return response()->json([
            'status' => true,
            'data' => $assignments,
            'message' => 'List of employee project assignments'
        ]);
    }

    // Retrieve a specific employee project assignment by ID
    public function show($id)
    {
        $assignment = EmployeeProjectAssignment::find($id);
        if (!$assignment) {
            return response()->json([
                'status' => false,
                'message' => 'Employee project assignment not found'
            ], 404);
        }
        return response()->json([
            'status' => true,
            'data' => $assignment,
            'message' => 'Employee project assignment found'
        ]);
    }

    // Update an employee project assignment
    public function update(Request $request, $id)
    {
        $assignment = EmployeeProjectAssignment::find($id);
        if (!$assignment) {
            return response()->json([
                'status' => false,
                'message' => 'Employee project assignment not found'
            ], 404);
        }
        $assignment->update($request->all());
        return response()->json([
            'status' => true,
            'data' => $assignment,
            'message' => 'Employee project assignment updated successfully'
        ]);
    }

    // Delete an employee project assignment
    public function destroy($id)
    {
        $assignment = EmployeeProjectAssignment::find($id);
        if (!$assignment) {
            return response()->json([
                'status' => false,
                'message' => 'Employee project assignment not found'
            ], 404);
        }
        $assignment->delete();
        return response()->json([
            'status' => true,
            'message' => 'Employee project assignment deleted successfully'
        ]);
    }
}
