<?php

namespace App\Http\Controllers;

use App\Models\OrderStatus;
use App\Http\Requests\CityRequest;
use App\Http\Requests\StateRequest;
use App\Models\Auth\User;
use App\Models\City;
use App\Models\Country;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\State;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Constraint\Count;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $this->data['city'] = DB::table('cities as t1')->select('t2.name as State_name', 't1.*')->leftJoin('states AS t2', 't2.id', '=', 't1.state_id')->get();
        return view('admin.cities.city', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $this->data['headline'] = "Add New City";
        $this->data['mode']         = 'create';
        // $this->data['city'] = City::get();
        $this->data['states'] = State::get();
        return view('admin.cities.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityRequest $request)
    {
        $formData = $request->all();
        if (City::create($formData)) {
            Session::flash('message', $formData['name'] . ' Added Successfully');
        }
        return redirect()->to('admin/cities');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $this->data['city']         = City::findOrFail($id);
        $this->data['mode']         = 'edit';
        $this->data['headline']     = 'Update City';
        $this->data['states']       = State::get();
        $this->data['state']        =  DB::table('states')->select('*')->where('country_id', '=', $id)->get();
        return view('admin.cities.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CityRequest $request, $id)
    {
        $city          = City::find($id);
        $updateCity   = DB::table('cities')->where('id', $id)->update(array('name' => $request->get('name'),'state_id' => $request->get('state_id')));
        if ($updateCity) {
            Session::flash('message', $city->name . ' Updated Successfully');
        }
        return redirect()->to('admin/cities');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (City::find($id)->delete()) {
            Session::flash('message', 'City Deleted Successfully');
        }
        return redirect()->to('admin/cities');
    }
}
