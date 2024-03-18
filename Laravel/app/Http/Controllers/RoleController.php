<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Requests\RoleRequest;
use App\Http\Requests\OrderItemRequest;
use App\Models\Auth\User;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $this->data['roles'] = Role::all();
        return view('admin.roles.role', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $this->data['headline'] = "Add New Role";
        $this->data['mode']         = 'create';
        $this->data['roles'] = Role::get();
        return view('admin.roles.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $formData = $request->all();
        if (Role::create($formData)) {
            Session::flash('message', $formData['role_name'] . ' Added Successfully');
        }
        return redirect()->to('admin/role');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $this->data['roles']        = Role::findOrFail($id);
        $this->data['mode']         = 'edit';
        $this->data['headline']     = 'Update Role';
        return view('admin.roles.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $order          = Role::find($id);
        $updateRole    = DB::table('role')->where('id', $id)->update(array('role_name' => $request->get('role_name')));
        if ($updateRole) {
            Session::flash('message', $order->role_name . ' Updated Successfully');
        }
        return redirect()->to('admin/role');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Role::find($id)->delete()) {
            Session::flash('message', 'Role Deleted Successfully');
        }
        return redirect()->to('admin/role');
    }
}
