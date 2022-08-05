<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AParent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request){
        $parent = AParent::where('name', $request->input('name'))->first();

        if ($parent && auth()->loginUsingId($parent->id)) {
            // Authentication passed...
            $user = auth()->user();
            $token = $user->createToken('api-token')->plainTextToken;
    
            $response = [
                'user' => $user,
                'token' => $token
            ];
            return $response;
        }
        
        return response()->json([
            'error' => 'Unauthenticated user',
            'code' => 401,
        ], 401);
    }

    public function register(Request $request){
        $rules = [
            'name' => 'unique:parents|required',
        ];
    
        $input     = $request->only('name');
        $validator = Validator::make($input, $rules);
    
        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }

        $name = $request->name;
       
        $parent = AParent::create(['name' => $name]);
        
        return response()->json($parent, 200);
    }
}
