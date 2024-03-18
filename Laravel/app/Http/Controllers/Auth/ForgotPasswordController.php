<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\Auth\Admin;
use App\Models\Auth\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('admin.auth.forgot-password');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admins'
        ]);
        $token = Str::random(64);
        DB::table('password_reset_tokens')->insert([
            'email' => $request->get('email'),
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        Mail::send('emails.forgot-password', ['token' => $token], function ($message) use ($request) {
            $message->to($request->get('email'));
            $message->subject('Reset Password Notification');
        });
        return redirect()->to(route('password.request'))->with('success', 'we have send an email to reset password.');
    }

    public function resetPasswordIndex($token)
    {
        return view('admin.auth.reset-password', ['token' => $token]);
    }
    
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $updatePassword = DB::table('password_reset_tokens')->where([
            'token' => $request->get('token'),
            'email' => $request->get('email')
        ])->first();
        if (!$updatePassword) {
            return redirect()->to(route('password.reset', ['token' => $request->get('token')]))->with('error', "Invalid");
        }

        Admin::where('email', $request->get('email'))->update(['password' => Hash::make($request->get('password'))]);
        $updatePassword = DB::table('password_reset_tokens')->where([
            'email' => $request->get('email')
        ])->delete();
        return redirect()->route('login')->with('success', 'Password Updated Successfully.');
    }

    //user forgot password
    public function userIndex()
    {
        return view('userpassword.forgot-password');
    }

    public function userForgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users'
        ]);
        $token = Str::random(64);
        DB::table('password_reset_tokens')->insert([
            'email' => $request->get('email'),
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        Mail::send('emails.user-forgot-password', ['token' => $token], function ($message) use ($request) {
            $message->to($request->get('email'));
            $message->subject('Reset Password Notification');
        });
        return redirect()->to(route('user.password.request'))->with('success', 'we have send an email to reset password.');
    }

    public function userResetPasswordIndex($token)
    {
        return view('userpassword.reset-password', ['token' => $token]);
    }
    
    public function userResetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $updatePassword = DB::table('password_reset_tokens')->where([
            'token' => $request->get('token'),
            'email' => $request->get('email')
        ])->first();
        if (!$updatePassword) {
            return redirect()->to(route('user.password.reset', ['token' => $request->get('token')]))->with('error', "Invalid user email");
        }

        User::where('email', $request->get('email'))->update(['password' => Hash::make($request->get('password'))]);
        $updatePassword = DB::table('password_reset_tokens')->where([
            'email' => $request->get('email')
        ])->delete();
        return redirect()->to('myaccount/login')->with('success', 'User Password Updated Successfully.');
    }
}
