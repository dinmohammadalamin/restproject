<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserApiController extends Controller
{
    public function showUser($id = null)
    {
        if ($id == '') {
            $users = User::get();
            return response()->json(['users' => $users], 200);
        } else {
            $users = User::find($id);
            return response()->json(['users' => $users], 200);
        }
    }

    public function addUser(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
            ];

            $customMessage = [
                'name.required' => 'Name is required',
                'email.required' => 'Email is required',
                'email.email' => 'Invalid email format',
                'password.required' => 'Password is required',
            ];

            $validator = Validator::make($data, $rules, $customMessage);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->save();

            $message = 'User Successfully Added';

            return response()->json(['message' => $message], 201);
        }
    }

    //multiple user
    public function multipleUser(Request $request){
    if ($request->ismethod('post')){
        $data = $request->all();
dd($data);
        $rules = [
            'users.*.name' => 'required',
            'users.*.email' => 'required|email|unique:users',
            'users.*.password' => 'required',
        ];

        $customMessage = [
            'users.*.name.required' => 'Name is required',
            'users.*.email.required' => 'Email is required',
            'users.*.email.email' => 'Invalid email format',
            'users.*.password.required' => 'Password is required',
        ];

        $validator = Validator::make($data, $rules, $customMessage);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        foreach ($data['users'] as $addUser) {
            $user = new User();
            $user->name = $addUser['name'];
            $user->email = $addUser['email'];
            $user->password = bcrypt($addUser['password']);
            $user->save();
        }

        $message = 'Users Successfully Added';

        return response()->json(['message' => $message], 201);
    }
}
}
