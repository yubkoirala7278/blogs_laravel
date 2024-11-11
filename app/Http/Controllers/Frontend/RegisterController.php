<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){
       return view('frontend.register.register');
    }

    public function register(RegisterRequest $request){
       try{
            User::create([
                'is_admin'=>0,
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password)
            ]);
            return redirect()->route('admin.login')->with('success','Account created successfully!');
       }catch(\Throwable $th){
        return back()->with('error',$th->getMessage());
       }
    }
}
