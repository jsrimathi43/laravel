<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountryRequest;
use App\Http\Requests\StateRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $this->data['country'] = Country::all();
        return view('admin.countries.country', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $this->data['headline'] = "Add New Country";
        $this->data['mode']         = 'create';
        $this->data['country'] = Country::get();
        return view('admin.countries.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountryRequest $request)
    {
        $formData = $request->all();
        if (Country::create($formData)) {
            Session::flash('message', $formData['name'] . ' Added Successfully');
        }
        return redirect()->to('admin/country');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $this->data['country']      = Country::findOrFail($id);
        $this->data['mode']         = 'edit';
        $this->data['headline']     = 'Update Country';
        $this->data['state']        =  DB::table('states')->select('*')->where('country_id', '=', $id)->get();
        return view('admin.countries.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CountryRequest $request, $id)
    {
        $country          = Country::find($id);
        $updateCountry    = DB::table('countries')->where('id', $id)->update(array('name' => $request->get('name')));
        if ($updateCountry) {
            Session::flash('message', $country->name . ' Updated Successfully');
        }
        return redirect()->to('admin/country');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stateDetails = DB::table('states')->select('*')->where('country_id', '=', $id)->get();
        if (!empty($stateDetails)) {
            foreach ($stateDetails as $state) {
                State::find($state->id)->delete();
                $cityDetails = DB::table('cities')->select('*')->where('state_id', '=', $state->id)->get();
                if (!empty($cityDetails)) {
                    foreach ($cityDetails as $city) {
                        City::find($city->id)->delete();
                    }
                }
            }
        }
        if (Country::find($id)->delete()) {
            Session::flash('message', 'Country Deleted Successfully');
        }
        return redirect()->to('admin/country');
    }


    public function destroystate($id)
    {
        $cityDetails = DB::table('cities')->select('*')->where('state_id', '=', $id)->get();
        if(!empty($cityDetails)){
            foreach($cityDetails as $city){
                City::find($city->id)->delete();
            }
        }
        $stateDetails = State::find($id);
        if (State::find($id)->delete()) {
            Session::flash('message', $stateDetails->name . ' Deleted Successfully');
        }
        return redirect()->to('admin/country');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createstate(StateRequest $request)
    {
        $formData = $request->all();
        if (State::create($formData)) {
            Session::flash('message',  $formData['name'] . ' Added Successfully');
        }
        $this->data['country']      = Country::findOrFail($formData['country_id']);
        $this->data['mode']         = 'edit';
        $this->data['headline']     = 'Update State';
        return redirect()->to('admin/country');
    }
}
