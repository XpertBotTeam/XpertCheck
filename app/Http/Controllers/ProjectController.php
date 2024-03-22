<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Employee;
use App\Models\Client;
use App\Models\ProjectPhase;
use App\Models\EmployeeProjectAssignment;

class ProjectController extends Controller
{
    public function showProject($id)
    {
        $Client = Client::all();
        $EmployeeProjectAssignments = EmployeeProjectAssignment::all();
        $projects = Project::findOrFail($id);
        $projectphases = ProjectPhase::all();

        return view('/user/Project/index', ['projects' => $projects, 'projectphases' => $projectphases, 'EmployeeProjectAssignments' => $EmployeeProjectAssignments, 'Client' => $Client]);
    }

    public function createProjectPhase($projectId)
    {
        return view('/user/project/createPhase', compact('projectId'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'phase_name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:planned,in_progress,completed',
            'project_id' => 'required|exists:projects,id',
        ]);

        // Create a new project phase instance
        $projectPhase = new ProjectPhase();
        $projectPhase->phase_name = $validatedData['phase_name'];
        $projectPhase->description = $validatedData['description'];
        $projectPhase->start_date = $validatedData['start_date'];
        $projectPhase->end_date = $validatedData['end_date'];
        $projectPhase->status = $validatedData['status'];
        $projectPhase->project_id = $validatedData['project_id'];
        $projectPhase->save();

        // Redirect back to the project details page
        return redirect()->route('projectDetails', ['id' => $validatedData['project_id']]);
    }

    public function assignEmployees($projectId)
    {
        $project = Project::findOrFail($projectId);
        $employees = Employee::all(); // Fetch all employees from the database
        return view('/user/project/assignEmployees', compact('project', 'employees'));
    }

    public function storeAssignment(Request $request, $projectId)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|array',
            'employee_id.*' => 'distinct|exists:employees,id',
            'assignment_date' => 'required|date',
        ]);

        // Create project assignments for each selected employee
        for ($i = 0; $i < count($validatedData['employee_id']); $i++) {
            EmployeeProjectAssignment::create([
                'employee_id' => $validatedData['employee_id'][$i],
                'project_id' => $projectId,
                'assignment_date' => $validatedData['assignment_date'],
                // Add any other assignment-related fields here
            ]);
        }

        return redirect()->route('projectDetails', ['id' => $projectId]);
    }

    public function editProjectPhase($projectId, $phaseId)
    {
        $projectPhase = ProjectPhase::findOrFail($phaseId);
        // You can add any additional data you need for the edit view
        return view('/user/Project/editphase', compact('projectPhase'));
    }

    public function updateProjectPhase(Request $request, $projectId, $phaseId)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'phase_name' => 'required|string|max:255',
            'description' => 'required|string',
            // Add validation rules for other fields as needed
        ]);

        // Find the project phase by its ID and project ID
        $projectPhase = ProjectPhase::where('id', $phaseId)
            ->where('project_id', $projectId)
            ->firstOrFail();

        // Update the project phase details
        $projectPhase->update([
            'phase_name' => $validatedData['phase_name'],
            'description' => $validatedData['description'],
            // Update other fields as needed
        ]);

        // Redirect back to the project details page with a success message
        return redirect()->route('projectDetails', ['id' => $projectId])
            ->with('success', 'Project phase updated successfully');
    }

    public function deleteProjectPhase($projectId, $phaseId)
    {
        $projectPhase = ProjectPhase::findOrFail($phaseId);
        $projectPhase->delete();
        return redirect()->back()->with('success', 'Project phase deleted successfully');
    }

    // Method for displaying the edit form for an employee assignment
    public function editEmployeeAssignment($projectId, $assignmentId)
    {
        // Retrieve the assignment and associated employee
        $assignment = EmployeeProjectAssignment::findOrFail($assignmentId);
        $employee = $assignment->employee;

        // Retrieve all employees to populate the dropdown
        $employees = Employee::all();

        // Pass the assignment, employee, and employees variables to the view
        return view('/user/Project/editassignment', compact('assignment', 'employee', 'employees'));
    }

    // Method for updating an employee assignment
    public function updateEmployeeAssignment(Request $request, $projectId, $assignmentId)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id', // Example validation rule for employee_id
            // Add more validation rules as needed
        ]);

        // Find the employee project assignment by ID
        $assignment = EmployeeProjectAssignment::findOrFail($assignmentId);

        // Update the assignment with the validated data
        $assignment->update($validatedData);

        // Redirect back to the project details page with a success message
        return redirect()->route('projectDetails', ['id' => $projectId])->with('success', 'Employee assignment updated successfully');
    }

    // Method for deleting an employee assignment
    public function deleteEmployeeAssignment($projectId, $assignmentId)
    {
        $assignment = EmployeeProjectAssignment::findOrFail($assignmentId);
        $assignment->delete();

        // Redirect back or to a different route
        return redirect()->route('projectDetails', ['id' => $projectId])->with('success', 'Employee assignment deleted successfully');
    }
}
