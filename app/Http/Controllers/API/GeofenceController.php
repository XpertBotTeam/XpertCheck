<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Geofence;

class GeofenceController extends Controller
{
    // Create a new geofence
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'latitude1' => 'required|numeric',
            'longitude1' => 'required|numeric',
            'latitude2' => 'required|numeric',
            'longitude2' => 'required|numeric',
            'latitude3' => 'required|numeric',
            'longitude3' => 'required|numeric',
            'latitude4' => 'required|numeric',
            'longitude4' => 'required|numeric',
        ]);

        // Create the geofence
        $geofence = new Geofence();
        $geofence->name = $request->input('name');
        $geofence->latitude1 = $request->input('latitude1');
        $geofence->longitude1 = $request->input('longitude1');
        $geofence->latitude2 = $request->input('latitude2');
        $geofence->longitude2 = $request->input('longitude2');
        $geofence->latitude3 = $request->input('latitude3');
        $geofence->longitude3 = $request->input('longitude3');
        $geofence->latitude4 = $request->input('latitude4');
        $geofence->longitude4 = $request->input('longitude4');
        $geofence->save();

        return response()->json([
            "status" => true,
            "message" => "Geofence created successfully",
            "data" => $geofence
        ], 201);
    }
    
    // Retrieve all geofences
    public function index()
    {
        $geofences = Geofence::all();
        return response()->json([
            'status' => true,
            'data' => $geofences,
            'message' => 'List of geofences'
        ]);
    }

    // Retrieve a specific geofence by ID
    public function show($id)
    {
        $geofence = Geofence::find($id);
        if (!$geofence) {
            return response()->json([
                'status' => false,
                'message' => 'Geofence not found'
            ], 404);
        }
        return response()->json([
            'status' => true,
            'data' => $geofence,
            'message' => 'Geofence found'
        ]);
    }

    // Update a geofence
    public function update(Request $request, $id)
    {
        $geofence = Geofence::find($id);
        if (!$geofence) {
            return response()->json([
                'status' => false,
                'message' => 'Geofence not found'
            ], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'latitude1' => 'required|numeric',
            'longitude1' => 'required|numeric',
            'latitude2' => 'required|numeric',
            'longitude2' => 'required|numeric',
            'latitude3' => 'required|numeric',
            'longitude3' => 'required|numeric',
            'latitude4' => 'required|numeric',
            'longitude4' => 'required|numeric',
        ]);

        $geofence->update($request->all());
        return response()->json([
            'status' => true,
            'data' => $geofence,
            'message' => 'Geofence updated successfully'
        ]);
    }

    // Delete a geofence
    public function destroy($id)
    {
        $geofence = Geofence::find($id);
        if (!$geofence) {
            return response()->json([
                'status' => false,
                'message' => 'Geofence not found'
            ], 404);
        }
        $geofence->delete();
        return response()->json([
            'status' => true,
            'message' => 'Geofence deleted successfully'
        ]);
    }
}
