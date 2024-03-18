<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Category;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function index()
    {
        $this->data['user'] = auth('admin')->user();
        $this->data['categories']     = Category::all();
        return view('profile.edit', $this->data);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request, $id)
    {
        $name = $request->get('name');
        $admin               = Admin::find($id);
        $admin->name     = $request->get('name');
        $admin->email      = $request->get('email');
        if ($admin->save()) {
            return Redirect::to('/admin/profile')->withSuccess('Admin Details Updated Successfully');
        }
    }

    /**
     * Update the user's profile information.
     */
    public function updatepassword(Request $request)
    {
        $admin               = Admin::find($request->get('admin_id'));
        if ($request->get('password') == $request->get('password_confirmation')) {
            $admin->password     = Hash::make($request->get('password'));
            if ($admin->save()) {
                return Redirect::to('/admin/profile')->withSuccess('Admin Password Updated Successfully');
            }
        } else {
            return Redirect::to('/admin/profile')->withFail('Password mismatch');
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request, $id): RedirectResponse
    {
        $admin               = Admin::find($id);
        $request->validateWithBag('userDeletion', [
            'password' => ['required'],
        ]);
        if (Hash::check($request->get('password'), $admin->password)) {
            if (Admin::destroy($id)) {
                auth('admin')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
            }
            return Redirect::to('/admin/login');
        } else {
            return Redirect::to('/admin/profile')->withFail('The password does not match the stored hashed password.');
        }      
    }
}
