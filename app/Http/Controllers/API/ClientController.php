<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id', // Validate that the UserID exists in the users table
            // You can add more validation rules here if needed
        ]);

        // Create the client
        $client = new Client();
        $client->user_id = $request->input('user_id'); // Assign the provided UserID to the new client
        $client->save();

        return response()->json([
            "status" => true,
            "message" => "Client created successfully",
            "data" => $client
        ], 201);
    }
    
    // Retrieve all clients
    public function index()
    {
        $clients = Client::all();
        return response()->json([
            'status' => true,
            'data' => $clients,
            'message' => 'List of clients'
        ]);
    }

    // Retrieve a specific client by ID
    public function show($id)
    {
        $client = Client::find($id);
        if (!$client) {
            return response()->json([
                'status' => false,
                'message' => 'Client not found'
            ], 404);
        }
        return response()->json([
            'status' => true,
            'data' => $client,
            'message' => 'Client found'
        ]);
    }

    // Update a client
    public function update(Request $request, $id)
    {
        $client = Client::find($id);
        if (!$client) {
            return response()->json([
                'status' => false,
                'message' => 'Client not found'
            ], 404);
        }
        $client->update($request->all());
        return response()->json([
            'status' => true,
            'data' => $client,
            'message' => 'Client updated successfully'
        ]);
    }

    // Delete a client
    public function destroy($id)
    {
        $client = Client::find($id);
        if (!$client) {
            return response()->json([
                'status' => false,
                'message' => 'Client not found'
            ], 404);
        }
        $client->delete();
        return response()->json([
            'status' => true,
            'message' => 'Client deleted successfully'
        ]);
    }
}
