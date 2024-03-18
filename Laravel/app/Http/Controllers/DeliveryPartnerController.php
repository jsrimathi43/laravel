<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDeliveryPartnerRequest;
use App\Http\Requests\UpdateDeliveryPartnerRequest;
use App\Models\DeliveryPartner;
use Illuminate\Support\Facades\Session;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Auth\User;


class DeliveryPartnerController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $this->data['deliveryPartners'] = DB::table('delivery_partners as t1')->select('t2.role_name', 't1.*')->leftJoin('role AS t2', 't2.id', '=', 't1.role_id')->get();
        return view('admin.deliveryPartners.index', $this->data);
    }
     /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $this->data['headline'] = "Add New Delivery Partner";
        $this->data['mode']         = 'create';
        $this->data['roles']         = Role::get();
        $this->data['available']     = array(array('id' => 0, 'available_status_name' => 'Not Available'), array('id' => 1, 'available_status_name' => 'Available'));
        return view('admin.deliveryPartners.form',$this->data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDeliveryPartnerRequest $request)
    {
        $request->validated();
        $formData = $request->all();
        if (!empty($formData['password'])) {
            $formData['password'] = Hash::make($formData['password']);
        }
        if( DeliveryPartner::create($formData) ) {
            $formData['first_name'] = $formData['name'];
            $formData['last_name'] = '';
            $formData['phone'] = $formData['contact_number'];

            User::create($formData);
            Session::flash('message', $formData['name'] . ' Added Successfully');
        }
        return redirect()->route('deliveryPartners.index');
    }

    public function show($id)
    {
        //$this->data['deliveryPartners']     = DeliveryPartner::find($id);
        //$this->data['tab_menu'] = 'deliverypartner_info';
        // return view('admin.users.show', $this->data);
        // $this->data['deliveryPartners'] = DeliveryPartner::all();
        // return view('admin.deliveryPartners.index', $this->data);
    }

    public function edit($id)
    {
        $this->data['deliveryPartners']         = DeliveryPartner::findOrFail($id);
        $this->data['mode']         = 'edit';
        $this->data['headline']     = 'Update Information';
        $this->data['roles']         = Role::get();
        $this->data['available']     = array(array('id' => 0, 'available_status_name' => 'Not Available'), array('id' => 1, 'available_status_name' => 'Available'));
        return view('admin.deliveryPartners.form', $this->data);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDeliveryPartnerRequest $request,$id)
    {
        $data               = $request->all();
        $deliveryPartner    = DeliveryPartner::find($id);
        $deliveryPartner->name             = $data['name'];
        $deliveryPartner->role_id          = $data['role_id'];
        $deliveryPartner->contact_number   = $data['contact_number'];
        $deliveryPartner->email            = $data['email'];
        $deliveryPartner->vechicle_name    = $data['vechicle_name'];
        $deliveryPartner->vechicle_number  = $data['vechicle_number'];
        $deliveryPartner->available_status = $data['available_status'];
        if (!empty($data['new_password'])) {
            $deliveryPartner->password     = Hash::make($data['new_password']);
        }
        if ($deliveryPartner->save()) {
            Session::flash('message', 'DeiveryPartner Details Updated Successfully');
        }
        return redirect()->to('admin/deliveryPartners');
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (DeliveryPartner::find($id)->delete()) {
            Session::flash('message', 'DeliveryPartner Details Deleted Successfully');
        }
        return redirect()->to('admin/deliveryPartners');
    }
}
