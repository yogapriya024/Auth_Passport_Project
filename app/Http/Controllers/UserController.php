<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    public function registeration(Request $request)
    {
       $validation = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'c_password'=>'required|same:password',
       ]);
        if($validation->fails()){
            return response()->json($validation->errors(),202);
        }
        $allData = $request->all();
        $allData['password'] = bcrypt($allData['password']);
        $user = User::create($allData);
        $resArr = [];
        $resArr['token']=$user->createToken('api-application')->accessToken;
        $resArr['name']=$user->name;
        return response()->json($resArr,200);
    }
    public function login(Request $request)
    {
       if(Auth::attempt([
           'email'=>$request->email,
           'password'=>$request->password
       ])){
           $user =Auth::user();
           $resArr = [];
        $resArr['token']=$user->createToken('api-application')->accessToken;
        $resArr['name']=$user->name;
        return response()->json($resArr,200);
       }else{
        return response()->json(["error"=>'Unauthorized Access'],203);
       }
    }
    public function logout(Request $request)
    {
        $token=$request->user()->token();
        $token->revoke();
        $response=["message"=>"You have successfully logout"];
        return response($response,200);
    }
}
