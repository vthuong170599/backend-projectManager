<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;

class UserController extends Controller
{
    /**
     * register user
     *  @param  \Illuminate\Http\Request  $request
     * @return message if register success
     */
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id'=>$request->role_id
        ]);
        $user->save();
        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }
    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
        $token->save();
        return response()->json([
            'accessToken' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'user' => Auth::user()
        ]);
    }

    /**
     * show infor user by id
     * @param Interger id user 
     * @return Json data user
     */
    public function show($id)
    {
        $user = User::find($id);
        return response()->json(["user" => $user], 200);
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json(['user' => $request->user()], 200);
    }

    /**
     * get all user in database
     * @return Array user
     */
    public function getAllUser(){
        return User::all();
    }

    /**
     * search user 
     * @param \Illuminate\Http\Request  $request
     * @param App\Models\User
     * @return Json data user after search
     */
    public function searchUser(Request $request, User $user)
    {
        $user = $user->search($request->username);
        return response()->json($user, 200);
    }

    /**
     * update user 
     * @param \Illuminate\Http\Request  $request
     * @param Interger id user
     * @return boolean user update
     */
    public function update(Request $request,$id){
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|',
            'password' => 'confirmed'
        ]);
        $user = User::find($id);
        $request->password == '' ? $user->password : bcrypt($request->password);
        $user = User::find($id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password == '' ? $user->password : bcrypt($request->password),
            'role_id'=>$request->role_id
        ]);
        return response()->json(['user'=>$user],200);
    }
}
