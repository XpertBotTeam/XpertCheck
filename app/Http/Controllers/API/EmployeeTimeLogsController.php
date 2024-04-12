<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployeeTimeLogs;

class EmployeeTimeLogsController extends Controller
{
    // Create a new employee time log
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id', // Validate that the EmployeeID exists in the employees table
            'check_in_time' => 'required|date',
            'project_id' => 'required|exists:projects,id', // Validate that the ProjectID exists in the projects table
            // You can add more validation rules here if needed
        ]);

        // Create the employee time log
        $log = new EmployeeTimeLogs();
        $log->employee_id = $request->input('employee_id');
        $log->check_in_time = $request->input('check_in_time');
        $log->project_id = $request->input('project_id');
        // Add other properties if needed
        $log->save();

        return response()->json([
            "status" => true,
            "message" => "Employee time log created successfully",
            "data" => $log
        ], 201);
    }
    
    // Retrieve all employee time logs
    public function index()
    {
        $logs = EmployeeTimeLogs::all();
        return response()->json([
            'status' => true,
            'data' => $logs,
            'message' => 'List of employee time logs'
        ]);
    }

    // Retrieve a specific employee time log by ID
    public function show($id)
    {
        $log = EmployeeTimeLogs::find($id);
        if (!$log) {
            return response()->json([
                'status' => false,
                'message' => 'Employee time log not found'
            ], 404);
        }
        return response()->json([
            'status' => true,
            'data' => $log,
            'message' => 'Employee time log found'
        ]);
    }

    // Update an employee time log
    public function update(Request $request, $id)
    {
        $log = EmployeeTimeLogs::find($id);
        if (!$log) {
            return response()->json([
                'status' => false,
                'message' => 'Employee time log not found'
            ], 404);
        }
        $log->update($request->all());
        return response()->json([
            'status' => true,
            'data' => $log,
            'message' => 'Employee time log updated successfully'
        ]);
    }

    // Delete an employee time log
    public function destroy($id)
    {
        $log = EmployeeTimeLogs::find($id);
        if (!$log) {
            return response()->json([
                'status' => false,
                'message' => 'Employee time log not found'
            ], 404);
        }
        $log->delete();
        return response()->json([
            'status' => true,
            'message' => 'Employee time log deleted successfully'
        ]);
    }
}
