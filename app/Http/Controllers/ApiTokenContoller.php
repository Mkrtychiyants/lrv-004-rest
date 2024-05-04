<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class ApiTokenContoller extends Controller
{
    public function createToken(Request $request ){
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'passwords' => ['required', 'string', 'min:8'],
            'device_name' => ['required', 'string'],

        ]);
        if($validator->fails())
        {
            return response()->json([
                'err'=> $validator->errors()]);
        }

        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password))
        {
            return response()->json([
                'err'=> 'user not found', 401]);
        }
        
        $token = $user ->createToken($request->device_name);

        return ['token' => $token->plainTextToken];
    }
}
