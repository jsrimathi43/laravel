<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
  
class AdminDropdownController extends Controller
{
    /**
     * Write code on Method
     *
     */
    public function index()
    {
        $data['countries'] = Country::get(["name", "id"]);
        return view('admin.orders.form', $data);
    }
    /**
     * Write code on Method
     *
     */
    public function fetchState(Request $request)
    {
        $data['states'] = State::where("country_id", $request->country_id)
                                ->get(["name", "id"]);
  
        return response()->json($data);
    }
    /**
     * Write code on Method
     *
     */
    public function fetchCity(Request $request)
    {
        $data['cities'] = City::where("state_id", $request->state_id)
                                    ->get(["name", "id"]);
                                      
        return response()->json($data);
    }
}