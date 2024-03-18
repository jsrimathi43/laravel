<?php

namespace App\Http\Controllers;

use App\Models\Groups;
use App\Models\Role;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->data['users'] = User::all();
        $this->data['users'] = DB::table('users as t1')->select('t2.role_name', 't1.*')->leftJoin('role AS t2', 't2.id', '=', 't1.role_id')->get();
        return view('admin.users.users', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['groups']       = Groups::arrayForSelect();
        $this->data['mode']         = 'create';
        $this->data['headline']     = 'Add New User';
        $this->data['roles']         = Role::get();
        return view('admin.users.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $formData = $request->all();
        if (!empty($formData['password'])) {
            $formData['password'] = Hash::make($formData['password']);
        }
        if (User::create($formData)) {
            Session::flash('message', 'User Created Successfully');
        }
        return redirect()->to('admin/users');
    }


    public function show($id)
    {
        $this->data['user']     = User::find($id);
        $this->data['tab_menu'] = 'user_info';
        return view('admin.users.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['user']         = User::findOrFail($id);
        $this->data['groups']       = Groups::arrayForSelect();
        $this->data['mode']         = 'edit';
        $this->data['headline']     = 'Update Information';
        $this->data['roles']         = Role::get();
        return view('admin.users.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $data               = $request->all();
        $user               = User::find($id);
        $user->group_id     = $data['group_id'];
        $user->role_id      = $data['role_id'];
        $user->first_name   = $data['first_name'];
        $user->first_name   = $data['last_name'];
        $user->email        = $data['email'];
        $user->phone        = $data['phone'];
        $user->address      = $data['address'];
        if (!empty($data['new_password'])) {
            $user->password     = Hash::make($data['new_password']);
        }

        if ($user->save()) {
            Session::flash('message', 'User Updated Successfully');
        }

        return redirect()->to('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (User::find($id)->delete()) {
            Session::flash('message', 'User Deleted Successfully');
        }

        return redirect()->to('admin/users');
    }
}
