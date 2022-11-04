<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Rules\Password;
use Symfony\Component\HttpFoundation\Response;
use Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phone_number' => ['nullable', 'string', 'max:255',],
                'password' => ['required', 'string', new Password()],
            ]);

            User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'password' => Hash::make($request->password) ,
            ]);

            $user = User::where('email', $request->email)->first();

            $tokenResult = $user->createToken('access_token')->plainTextToken;

            $response = [
                'message' => 'User successfully created',
                'data' => $user
              ];

            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $error) {
            return response()->json([
                'message' => 'User unsuccesfully created',
                $error->errorInfo,
                Response::HTTP_UNPROCESSABLE_ENTITY
              ]);
        }
    }

    public function login(Request $request) 
    {
        try {
            $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required']
            ]);

            $credentials = ([
                'email' => $request->email,
                'password' => $request->password
            ]);

            

            if( !Auth::attempt($credentials) ) {
                
                return response()->json([
                    'message' => 'unauthorized',
                    Response::HTTP_UNPROCESSABLE_ENTITY
                  ]);
            }

            
            $user = User::where('email', $request->email)->first();

            if (!Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Invalid Credentials');
            }
   
            $tokenResult = Auth::user()->createToken('authToken')->accessToken;

            $response = [
                'message' => 'User successfully login',
                'data' => $user
              ];

            return response(['user' => Auth::user(), 'access_token' => $tokenResult]);

        } catch (QueryException $error) {
            return response()->json([
                'message' => 'Something went wrong',
                $error->errorInfo,
                Response::HTTP_UNPROCESSABLE_ENTITY
              ]);
        }
    }
}
