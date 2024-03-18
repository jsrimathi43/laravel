<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    
    public function login()
    {
    	$this->data['headline'] = 'Login';
        if (Auth::guard('admin')){

            return view('admin.login.form', $this->data);
        } else if (Auth::guard('user')) {
            return redirect()->intended('/checkout');
        }else {
    		return redirect()->route('login.confirm')->withErrors(['Invalid email and password']);
    	}
    }



    public function authenticate(LoginRequest $request)
    {
		$this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        // Attempt to log the user in
        // Passwordnya pake bcrypt
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // if successful, then redirect to their intended location
            return redirect()->intended('/admin/dashboard');
        } else if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('/');
        }else {
    		return redirect()->route('login.confirm')->withErrors(['Invalid email and password']);
    	}

    }


    public function logout()
    {
    	Auth::logout();

    	return redirect()->route('login.show');
    }

}