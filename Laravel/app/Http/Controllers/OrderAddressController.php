<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderAddressRequest;
use App\Http\Requests\UpdateOrderAddressRequest;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\OrderAddress;
use App\Models\State;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check())
        {
            $this->data['orderAddress'] = DB::table('orders as t1')->select('t1.id as ord_id', 't1.delivery_partner_id as delParID', 't2.id as delivery_id', 't2.name as delivery_partner_name', 't2.available_status as delivery_partners_status', 't2.contact_number as delivery_partners_number', 't3.*', 't3.id as order_addressesID', 'c1.id as billing_county_id', 'c1.name as billing_county_name', 's1.id as billing_state_id', 's1.name as billing_state_name', 'ct1.id as billing_city_id', 'ct1.name as billing_city_name', 'c11.id as shipping_county_id', 'c11.name as shipping_county_name', 's11.id as shipping_state_id', 's11.name as shipping_state_name', 'ct11.id as shipping_city_id', 'ct11.name as shipping_city_name')->leftJoin('delivery_partners as t2', 't2.id', '=', 't1.delivery_partner_id')->leftJoin('order_addresses as t3', 't3.id', '=', 't1.address_id')->leftJoin('countries as c1', 'c1.id', '=', 't3.billing_country_id')->leftJoin('states as s1', 's1.id', '=', 't3.billing_state_id')->leftJoin('cities as ct1', 'ct1.id', '=', 't3.billing_city_id')->leftJoin('countries as c11', 'c11.id', '=', 't3.shipping_country_id')->leftJoin('states as s11', 's11.id', '=', 't3.shipping_state_id')->leftJoin('cities as ct11', 'ct11.id', '=', 't3.shipping_city_id')->where('t1.user_id', '=', Auth::id())->get();
            $this->data['categories']     = Category::all();
            // $this->data['addresses'] = Addresses::where('user_id',Auth::id())->get();
            // $this->data['city'] = "";
            // $this->data['state'] = "";
            // $this->data['country'] = "";
            // foreach ($this->data['addresses'] as $key => $value) {
            //     // print"<pre>";print_r($value);
            //     $this->data['city'] = City::where('id',$value->city)->get();
            //     $this->data['state'] = State::where('id',$value->state)->get();
            //     $this->data['country'] = Country::where('id',$value->country_id)->get();
            // }
            return view('myaccount/addressess',$this->data);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->data['cities']     = City::all();
        $this->data['countries']     = Country::all();
        $this->data['states']     = State::all();
        $this->data['categories']     = Category::all();
        $this->data['mode']         = 'create';
        $this->data['headline']     = 'Add New Address';

        return view('myaccount.createAddress', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     */
    public function store(Request $request)
    {
        // $formData = $request->all();
        // // print"<pre>";print_r($formData);die;
        // if (Addresses::create($formData)) {
        //     Session::flash('message', 'Addresses Added Successfully');
        // }
        // return redirect()->to('myaccount/orderAddress');
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderAddress $orderAddress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->data['mode']         = 'edit';
        $this->data['orderAddressEdit'] = DB::table('orders as t1')->select('t1.id as ord_id', 't1.delivery_partner_id as delParID', 't2.id as delivery_id', 't2.name as delivery_partner_name', 't2.available_status as delivery_partners_status', 't2.contact_number as delivery_partners_number', 't3.*', 't3.id as order_addressesID', 'c1.id as billing_county_id', 'c1.name as billing_county_name', 's1.id as billing_state_id', 's1.name as billing_state_name', 'ct1.id as billing_city_id', 'ct1.name as billing_city_name', 'c11.id as shipping_county_id', 'c11.name as shipping_county_name', 's11.id as shipping_state_id', 's11.name as shipping_state_name', 'ct11.id as shipping_city_id', 'ct11.name as shipping_city_name')->leftJoin('delivery_partners as t2', 't2.id', '=', 't1.delivery_partner_id')->leftJoin('order_addresses as t3', 't3.id', '=', 't1.address_id')->leftJoin('countries as c1', 'c1.id', '=', 't3.billing_country_id')->leftJoin('states as s1', 's1.id', '=', 't3.billing_state_id')->leftJoin('cities as ct1', 'ct1.id', '=', 't3.billing_city_id')->leftJoin('countries as c11', 'c11.id', '=', 't3.shipping_country_id')->leftJoin('states as s11', 's11.id', '=', 't3.shipping_state_id')->leftJoin('cities as ct11', 'ct11.id', '=', 't3.shipping_city_id')->where('t1.user_id', '=', Auth::id())->get();
        // print"<pre>";print_r($this->data['orderAddressEdit']);die;

        $this->data['cities']     = City::all();
        $this->data['countries']     = Country::all();
        $this->data['states']     = State::all();
        $this->data['categories']     = Category::all();

        return view('myaccount/orderAddressEdit',$this->data);

    }
    public function orderShippingAddress($id)
    {
        $this->data['mode']         = 'edit';
        $this->data['orderAddressEdit'] = DB::table('orders as t1')->select('t1.id as ord_id', 't1.delivery_partner_id as delParID', 't2.id as delivery_id', 't2.name as delivery_partner_name', 't2.available_status as delivery_partners_status', 't2.contact_number as delivery_partners_number', 't3.*', 't3.id as order_addressesID', 'c1.id as billing_county_id', 'c1.name as billing_county_name', 's1.id as billing_state_id', 's1.name as billing_state_name', 'ct1.id as billing_city_id', 'ct1.name as billing_city_name', 'c11.id as shipping_county_id', 'c11.name as shipping_county_name', 's11.id as shipping_state_id', 's11.name as shipping_state_name', 'ct11.id as shipping_city_id', 'ct11.name as shipping_city_name')->leftJoin('delivery_partners as t2', 't2.id', '=', 't1.delivery_partner_id')->leftJoin('order_addresses as t3', 't3.id', '=', 't1.address_id')->leftJoin('countries as c1', 'c1.id', '=', 't3.billing_country_id')->leftJoin('states as s1', 's1.id', '=', 't3.billing_state_id')->leftJoin('cities as ct1', 'ct1.id', '=', 't3.billing_city_id')->leftJoin('countries as c11', 'c11.id', '=', 't3.shipping_country_id')->leftJoin('states as s11', 's11.id', '=', 't3.shipping_state_id')->leftJoin('cities as ct11', 'ct11.id', '=', 't3.shipping_city_id')->where('t1.user_id', '=', Auth::id())->get();
        // print"<pre>";print_r($this->data['orderAddressEdit']);die;

        $this->data['cities']     = City::all();
        $this->data['countries']     = Country::all();
        $this->data['states']     = State::all();
        $this->data['categories']     = Category::all();

        return view('myaccount/orderShippingAddress',$this->data);

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function orderShippingAddressUpdate(Request $request,$id)
    {
        print_r($request->all());
        print"<pre>";print_r($id);die;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $data = $request->all();
        $orderAddressValue = OrderAddress::find($id);
        if ($request->get('orderAddressesType') == "billing" ) {
            $orderAddressValue = DB::table('order_addresses')->where('id', $id)->update(array(
                'billing_first_name' => $request->get('billing_first_name'),
                'billing_last_name' => $request->get('billing_last_name'),
                'billing_street' => $request->get('billing_street'),
                'billing_city_id' => $request->get('billing_city_id'),
                'billing_state_id' => $request->get('billing_state_id'),
                'billing_country_id' => $request->get('billing_country_id'),
                'billing_zip_code' => $request->get('billing_zip_code'),
                'billing_phone_number' => $request->get('billing_phone_number')                
            ));
            if( $orderAddressValue ) {
                Session::flash('message', 'Addresses Updated Successfully');
            }
        }
        if ($request->get('orderAddressesType') == "shipping" ) {
            $addressTable = DB::table('order_addresses')->where('id', $id)->get();
            // print"<pre>";print_r($addressTable[0]->billing_first_name);die;
            $orderBillingAddressValue  = DB::table('order_addresses')->where('id', $id)->update(array(
                'billing_first_name' => $addressTable[0]->billing_first_name,
                'billing_last_name' => $addressTable[0]->billing_last_name,
                'billing_street' => $addressTable[0]->billing_street,
                'billing_city_id' => $addressTable[0]->billing_city_id,
                'billing_state_id' => $addressTable[0]->billing_state_id,
                'billing_country_id' => $addressTable[0]->billing_country_id,
                'billing_zip_code' => $addressTable[0]->billing_zip_code,
                'billing_phone_number' => $addressTable[0]->billing_phone_number,

                'shipping_first_name' => $request->get('shipping_first_name'),
                'shipping_last_name' => $request->get('shipping_last_name'),
                'shipping_street' => $request->get('shipping_street'),
                'shipping_city_id' => $request->get('shipping_city_id'),
                'shipping_state_id' => $request->get('shipping_state_id'),
                'shipping_country_id' => $request->get('shipping_country_id'),
                'shipping_zip_code' => $request->get('shipping_zip_code'),
                'shipping_phone_number' => $request->get('shipping_phone_number')
            ));
            if( $orderBillingAddressValue ) {
                Session::flash('message', 'Addresses Updated Successfully');
            }
        }
        
        return redirect()->to('myaccount/orderAddress/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderAddress $orderAddress)
    {
        //
    }
}