<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserRole;
use App\Models\User;
use App\Models\Student;
use App\Models\Professor;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AuthenticationController extends Controller
{
    public function register(Request $request){

        $request->validate([
            'name' => 'required',
            'role' => 'required',
            'email' => 'required|email',
            'password'=> 'required|min:7'
            ]);
        $user = null; 
        $roleId = UserRole::where('name', $request->role)->get();

        if ($roleId->count() > 0){

            $names = explode(" ", $request->name);

            if (count($names) != 2) {

                return response("Name must include first and last name seperated by a single space", 404);
            }


            if ($roleId->first()->name == "Student"){

                $nameVerification = Student::where('firstName', $names[0]) 
                ->where('lastName', $names[1])->get();
                if($nameVerification->count() > 0){

                    $user = User::create([
                        'name'=> $request->name,
                        'role' => $request->role,
                        'email'=> $request->email,
                        'password'=> bcrypt($request->password),
                        'user_id' => $nameVerification->first()->id,
                        ]);

                }else{
                    
                    return response("Error, Such a student does not exist in the database", 404);
                }

            }
            if($roleId->first()->name == "Professor"){
                $nameVerification = Professor::where('firstName', $names[0]) 
                ->where('lastName', $names[1])->get();
                if($nameVerification->count() > 0){
                    $user = User::create([
                        'name'=> $request->name,
                        'role' => $request->role,
                        'email'=> $request->email,
                        'password'=> bcrypt($request->password),
                        'user_id' => $nameVerification->first()->id,
                        ]);
                }else{

                    return response("Error, Such a student does not exist in the database", 404);

                }
            }
        }else{

            return response('Incorrect Role, Please write either "Student" or "Professor"', 422);

        }
                
        return response()->json($user);
    }

    public function login(Request $request){

        $request->validate([
            'email'=> 'email|required',
            'password'=> 'required'
        ]);

        $credentials = request (['email','password']);
        if (!auth()->attempt($credentials)){

            return response()->json([
                'message' => 'The given data was invalid',
                'errors' => [
                    'password' => [
                        'Invalid Credentials'
                    ]
                ]
            ], 422);
            
        }
        
        $user = User::where('email', $request->email)->first();
        $authToken = $user->createToken('auth-token')->plainTextToken;  
        
        return response()->json([
            'auth_token' => $authToken,   
            'role' => $user['role'],
            'user_id' => $user['id'],
            'name' => $user['name'],
        ]);
        
    }
    
}
