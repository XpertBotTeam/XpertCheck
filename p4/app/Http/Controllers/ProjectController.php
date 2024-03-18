<?php

namespace App\Http\Controllers;
use App\Models\Project;
use App\Models\Employee;

use Illuminate\Http\Request;
use App\Models\ProjectPhase;
use App\Models\EmployeeProjectAssignment;
class ProjectController extends Controller
{
    public function showProject($id)
    {
        $EmployeeProjectAssignments=EmployeeProjectAssignment::all();
        $projects = Project::findOrFail($id);
        $projectphases =ProjectPhase::all();
        return view('/user/Project/index',['projects' => $projects,'projectphases' => $projectphases,'EmployeeProjectAssignments'=>$EmployeeProjectAssignments]);
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
    }
