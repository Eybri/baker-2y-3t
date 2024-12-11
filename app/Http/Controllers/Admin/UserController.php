<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->get();
        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Update the admin status of the user.
     */
    public function updateAdmin(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->is_admin = $request->is_admin;
        $user->save();

        return response()->json(['message' => 'User admin status updated successfully.']);
    }

    /**
     * Deactivate the specified user.
     */
    public function deactivateUser($id)
    {
        $user = User::findOrFail($id);
        $user->is_active = false;
        $user->save();

        return response()->json(['message' => 'User deactivated successfully.']);
    }

    /**
     * Activate the specified user.
     */
    public function activateUser($id)
    {
        $user = User::findOrFail($id);
        $user->is_active = true;
        $user->save();

        return response()->json(['message' => 'User activated successfully.']);
    }
}
