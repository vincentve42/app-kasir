<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    public function LoginUi()
    {
        return view('login');
    }
    public function RegisterUi()
    {
        return view('register');
    }
    public function RegisterUser(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:8'
        ]);
        try{
            $user = new User;
            $user->name = $request->username;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();
            return redirect()->route('LoginUi');

        }
        catch(Exception  $e)
        {
            return $e;
        }
    }
    public function LoginUser(Request $request)
    {
        $request->validate(
            [
                'email' => 'required',
                'password' => 'required'
            ]
        );
        $data = $request->only('email','password');
        if(Auth::attempt($data))
        {
            $request->session()->regenerate();
            return redirect()->route('Dashboard');
        }
        else
        {
            session('log','Username atau Password Kamu Salah');
            return redirect()->back();
        }
        
        
    }
}
