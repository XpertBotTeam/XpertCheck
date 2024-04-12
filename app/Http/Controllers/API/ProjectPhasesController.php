<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectPhase;

class ProjectPhasesController extends Controller
{
    // Create a new project phase
    public function store(Request $request)
    {
        $request->validate([
            'phase_name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'required|in:planned,in_progress,completed',
            'project_id' => 'required|exists:projects,id', // Validate that the ProjectID exists in the projects table
            // You can add more validation rules here if needed
        ]);

        // Create the project phase
        $phase = new ProjectPhase();
        $phase->phase_name = $request->input('phase_name');
        $phase->description = $request->input('description');
        $phase->start_date = $request->input('start_date');
        $phase->end_date = $request->input('end_date');
        $phase->status = $request->input('status');
        $phase->project_id = $request->input('project_id');
        // Add other properties if needed
        $phase->save();

        return response()->json([
            "status" => true,
            "message" => "Project phase created successfully",
            "data" => $phase
        ], 201);
    }
    
    // Retrieve all project phases
    public function index()
    {
        $phases = ProjectPhase::all();
        return response()->json([
            'status' => true,
            'data' => $phases,
            'message' => 'List of project phases'
        ]);
    }

    // Retrieve a specific project phase by ID
    public function show($id)
    {
        $phase = ProjectPhase::find($id);
        if (!$phase) {
            return response()->json([
                'status' => false,
                'message' => 'Project phase not found'
            ], 404);
        }
        return response()->json([
            'status' => true,
            'data' => $phase,
            'message' => 'Project phase found'
        ]);
    }

    // Update a project phase
    public function update(Request $request, $id)
    {
        $phase = ProjectPhase::find($id);
        if (!$phase) {
            return response()->json([
                'status' => false,
                'message' => 'Project phase not found'
            ], 404);
        }
        $phase->update($request->all());
        return response()->json([
            'status' => true,
            'data' => $phase,
            'message' => 'Project phase updated successfully'
        ]);
    }

    // Delete a project phase
    public function destroy($id)
    {
        $phase = ProjectPhase::find($id);
        if (!$phase) {
            return response()->json([
                'status' => false,
                'message' => 'Project phase not found'
            ], 404);
        }
        $phase->delete();
        return response()->json([
            'status' => true,
            'message' => 'Project phase deleted successfully'
        ]);
    }
}
