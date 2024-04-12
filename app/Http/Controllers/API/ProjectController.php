<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Http\Requests\ProjectRequest;

class ProjectController extends Controller
{
    // Create a new project
    public function store(ProjectRequest $request)
    {
        $request->validate([
            'project_name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'required|in:active,completed,on_hold',
            'client_id' => 'required|exists:clients,id', // Validate that the ClientID exists in the clients table
            // You can add more validation rules here if needed
        ]);

        // Create the project
        $project = new Project();
        $project->project_name = $request->input('project_name');
        $project->description = $request->input('description');
        $project->start_date = $request->input('start_date');
        $project->end_date = $request->input('end_date');
        $project->status = $request->input('status');
        $project->client_id = $request->input('client_id');
        // Add other properties if needed
        $project->save();

        return response()->json([
            "status" => true,
            "message" => "Project created successfully",
            "data" => $project
        ], 201);
    }
    
    // Retrieve all projects
    public function index()
    {
        $projects = Project::all();
        return response()->json([
            'status' => true,
            'data' => $projects,
            'message' => 'List of projects'
        ]);
    }

    // Retrieve a specific project by ID
    public function show($id)
    {
        $project = Project::find($id);
        if (!$project) {
            return response()->json([
                'status' => false,
                'message' => 'Project not found'
            ], 404);
        }
        return response()->json([
            'status' => true,
            'data' => $project,
            'message' => 'Project found'
        ]);
    }

    // Update a project

  
    public function update(ProjectRequest $request, $id)
    {
        $project = Project::find($id);
        if (!$project) {
            return response()->json([
                'status' => false,
                'message' => 'Project not found'
            ], 404);
        }
        $project->update($request->all());
        return response()->json([
            'status' => true,
            'data' => $project,
            'message' => 'Project updated successfully'
        ]);
    }

    // Delete a project
    public function destroy($id)
    {
        $project = Project::find($id);
        if (!$project) {
            return response()->json([
                'status' => false,
                'message' => 'Project not found'
            ], 404);
        }
        $project->delete();
        return response()->json([
            'status' => true,
            'message' => 'Project deleted successfully'
        ]);
    }

}