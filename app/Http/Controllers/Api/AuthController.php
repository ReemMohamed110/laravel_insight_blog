<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        try {
            $token = $user->createToken('auth-token')->plainTextToken;
        } catch (Exception $e) {
            return response()->json(['error'=>'cannot create token']);
        }
        return response()->json(['token'=>$token,'user'=>$user]);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string'],
            'password' => ['required'],
        ]);

        $credentials =$request->only('email','password');
        if(Auth::attempt($credentials)){
            $user=Auth::user();
        }
        try {
            $token = $user->createToken('auth-token')->plainTextToken;
        } catch (Exception $e) {
            return response()->json(['error'=>'cannot create token']);
        }
        return response()->json(['token'=>$token,'user'=>$user]);
    }
    public function logout(Request $request)
    {   
        $request->user()->CurrentAccessToken()->delete();
        return response()->json(['message'=>'you are logged out']);
        
    }
    public function updateProfile(Request $request)
    {   
        $user=Auth::user();
        if(!$user){
         return response()->json(['error'=>'you are not authorized ']);
        }
        $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string'],
            'role' => ['nullable','in:admin,user'],
            'password' => ['nullable'],
            'current_password'=>['nullable','required_with:password']
        ]);
        if($request->filled('current_password') && !Hash::check($request->current_password, $user->password)){
            return response()->json(['error'=>'password does not match ']);
        }
        $data=[];
        if($request->filled('name')){
            $data['name']= $request->name;
        }
        if($request->filled('email')){
            $data['email']= $request->email;
        }
        if($request->filled('password')){
            $data['password']= Hash::make($request->password);
        }
        if($request->filled('role')){
            $data['role']= $request->role;
        }
        if(!empty($data)){
            $user->update($data);
            return response()->json(['user'=>$user ,'success'=>'profile updated successfully ']);
        }

        return response()->json(['success'=>'can not update data ']);
        
        
    }


   
}
