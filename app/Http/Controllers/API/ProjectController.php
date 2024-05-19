<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Http\Requests\ProjectRequest;
use Illuminate\Support\Facades\DB;

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
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'radius' => 'required|numeric',
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
        $project->latitude = $request->input('latitude');
        $project->longitude = $request->input('longitude');
        $project->radius = $request->input('radius');
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

    // Check project proximity
    public function checkProximity(Request $request)
    {
        // Validate request parameters
        $validatedData = $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'radius' => 'required|numeric',
        ]);
    
        // Extract validated data
        $latitude = $validatedData['latitude'];
        $longitude = $validatedData['longitude'];
        $radius = $validatedData['radius'];
    
        // Query projects within the specified proximity using Haversine formula
        $projects = Project::selectRaw("id, project_name, description, status, latitude, longitude, 
            ( 6371 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance", [$latitude, $longitude, $latitude, $longitude, $latitude])
            ->having("distance", "<", $radius)
            ->orderBy("distance")
            ->get();
    
        // Check if projects were found within the specified proximity
        if ($projects->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No projects found within the specified radius.',
            ], 404);
        }
    
        // Return the result
        return response()->json([
            'status' => true,
            'data' => $projects,
            'message' => 'Projects found within the specified radius.',
        ]);
    }
}