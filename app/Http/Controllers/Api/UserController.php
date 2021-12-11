<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        if(count($users) > 0)
        {
            return response([
                'message' => 'Retreive All User Success',
                'data' => $users
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id)
    {
        $users = User::find($id);
        
        if(!is_null($users))
        {
            return response([
                'message' => 'Retreive User Success',
                'data' => $users
            ], 200);
        }

        return response([
            'message' => 'User Not Found',
            'data' => null
        ], 404);
    }

    public function store(Request $request)
    {
        $storeData = $request->all();

        $validate = Validator::make($storeData, [
            'name' => 'required|max:60',
            'email'=> 'required|email:rfc,dns|unique:users',
            'username'=> 'required|unique:users',
            'password' => 'required',
            'imgURL' => 'required'
        ]);

        if($validate->fails()) return response(['message' => $validate->errors()], 400);
        
        $storeData['password'] = bcrypt($request->password);
        $user = User::create($storeData);
        return response([
            'message' => 'Add User Success',
            'data' => $user
        ], 200);
    }

    public function destroy($id)
    {
        $users = User::find($id);
        
        if(is_null($users))
        {
            return response([
                'message' => 'User Not Found',
                'data' => null
            ], 404);
        }

        if($users->delete())
        {
            return response([
                'message' => 'Delete User Success',
                'data' => $users
            ], 200);
        }
        
        return response([
            'message' => 'Delete User Failed',
            'data' => null
        ], 400);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        
        if(is_null($user))
        {
            return response([
                'message' => 'User Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        
        $validate = Validator::make($updateData, [
            'name' => 'required|max:60',
            'email'=> ['required', 'email:rfc,dns', Rule::unique('users')->ignore($user)],
            'username'=> ['required', Rule::unique('users')->ignore($user)],
            'imgURL' => 'required'
        ]);

        if($validate->fails()) return response(['message' => $validate->errors()], 400);
        
        $user->name = $updateData['name'];
        $user->email = $updateData['email'];
        $user->username = $updateData['username'];
        $user->imgURL = $updateData['imgURL'];
        
        if($user->save())
        {
            return response([
                'message' => 'Update User Success',
                'data' => $user
            ], 200);
        }
        
        return response([
            'message' => 'Update User Failed',
            'data' => null
        ], 400);
        
    }
}
