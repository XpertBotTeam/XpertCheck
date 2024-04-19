<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;

class RoleUserController extends Controller
{
    // Assign a role to a user
    public function assignRoleToUser(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id'
        ]);

        $user = User::findOrFail($validated['user_id']);
        $user->roles()->syncWithoutDetaching([$validated['role_id']]);

        return response()->json([
            'status' => true,
            'message' => 'Role assigned to user successfully'
        ]);
    }

    // Remove a role from a user
    public function removeRoleFromUser($userId, $roleId)
    {
        $user = User::findOrFail($userId);
        $user->roles()->detach($roleId);

        return response()->json([
            'status' => true,
            'message' => 'Role removed from user successfully'
        ]);
    }

    // Update (swap) a role for a user
    public function updateRoleForUser(Request $request, $userId)
    {
        $validated = $request->validate([
            'old_role_id' => 'required|exists:roles,id',
            'new_role_id' => 'required|exists:roles,id'
        ]);

        $user = User::findOrFail($userId);
        $user->roles()->detach($validated['old_role_id']);
        $user->roles()->attach($validated['new_role_id']);

        return response()->json([
            'status' => true,
            'message' => 'Role updated successfully for user'
        ]);
    }

    // Get all users by a specific role
    public function getUsersByRole($roleId)
    {
        $role = Role::findOrFail($roleId);
        return response()->json([
            'status' => true,
            'data' => $role->users,
            'message' => 'List of users with the role'
        ]);
    }

    // Get all roles by a specific user
    public function getRolesByUser($userId)
    {
        $user = User::findOrFail($userId);
        return response()->json([
            'status' => true,
            'data' => $user->roles,
            'message' => 'List of roles assigned to user'
        ]);
    }
}
