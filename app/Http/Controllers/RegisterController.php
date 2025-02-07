<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function login(Request $request)  {
        $incomeField = $request->validate([
            'logname' => ['required'],
            'logpassword' => 'required',
        ]);

        if(auth()->guard()->attempt(['name' => $incomeField['logname'], 'password' => $incomeField['logpassword'] ])){
            $request -> session()->regenerate();
        }
        
        return redirect('/');
    }
    public function logout(){
        auth()->guard()->logout();
        return redirect('/');
    }

    public function register(Request $request){
        $incomeField = $request->validate([
            'name' => ['required', Rule::unique('users', 'name')],
            'email' => ['required','email', Rule::unique('users', 'email')],
            'password' => 'required',
        ]);

        $incomeField['password'] = bcrypt($incomeField['password']);
        $userDetails = User::create($incomeField);
        auth()->guard()->login($userDetails);
        return redirect('/');
    }
}
