<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    // Get Users
    public function get_users(){
        $getUsers = User::all();
        return response()->json($getUsers, 200);
    }

    // Get User By ID
    public function get_by_id($id){
        $getUser = User::find($id);
        if(!$getUser){
            return response()->json(['error' => 'User not found!'], 404);
        }
        return response()->json($getUser, 200);
    }

    // Create User
    public function create_user(Request $request){
        $verifyEmail = User::where('email', $request->email)->exists();
        if($verifyEmail){
            return response()->json(['error' => 'This email is already registered!'], 422);
        }
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);
        return response()->json(['message' => 'User created successfully!'], 201);
    }

    // Update User
    public function update_user(Request $request, $id){
        $updateUser = User::find($id);
        if(!$updateUser){
            return response()->json(['error' => 'User not found!'], 404);
        }
        $updateUser->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);
        return response()->json(['message' => 'User updated successfully!'], 200);
    }

    // Delete User
    public function delete_user($id){
        $deleteUser = User::find($id);
        if(!$deleteUser){
            return response()->json(['error' => 'User not found!'], 404);
        }
        $deleteUser->delete();
        return response()->json(['message' => 'User deleted successfully!'], 200);
    }

}
