<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;
use Auth;

class AuthController extends Controller
{
    use GeneralTrait;
    public function register (Request $request)
    {
        //validation
        $rules = [
            'name' => 'required|max:150',
            'email' => 'required|email|max:150|unique:users,email,',
            'password' => 'required|min:3'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);

        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            $user->save();

            return response()->json([
                'status' => true,
                'msg' => 'The user added successfully'
            ]);
        }
    }

    public function login (Request $request)
    {
        //validation
        $rules = [
            'email' => 'required|exists:users,email',
            'password' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        //login
        $credentials = $request->only(['email','password']);
        $token = Auth::guard('user')->attempt($credentials);
        if (!$token){
            return response()->json([
                'status' => 'data_error',
                'msg' => 'بيانات الدخول غير صحيحة'
            ]);
        }else{
            //return token
            $user = Auth::guard('user')->user();
            $user->token = $token;

            return $this->returnData('user', $user,'تم تسجيل الدخول بنجاح');
        }
    }
}
