<?php

namespace App\Http\Controllers;

use App\Models\OrderStatus;
use App\Http\Requests\OrderStatusRequest;
use App\Http\Requests\OrderItemRequest;
use App\Models\Auth\User;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class OrderStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $this->data['orderstatus'] = OrderStatus::all();
        return view('admin.orderstatus.orderstatus', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $this->data['headline'] = "Add New OrderStatus";
        $this->data['mode']         = 'create';
        $this->data['orderstatus'] = OrderStatus::get();
        return view('admin.orderstatus.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderStatusRequest $request)
    {
        $formData = $request->all();
        if (OrderStatus::create($formData)) {
            Session::flash('message', $formData['status_name'] . ' Added Successfully');
        }
        return redirect()->to('admin/orderstatus');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $this->data['orderstatus']        = OrderStatus::findOrFail($id);
        $this->data['mode']         = 'edit';
        $this->data['headline']     = 'Update Order Status';
        return view('admin.orderstatus.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrderStatusRequest $request, $id)
    {
        $order          = OrderStatus::find($id);
        $updateOrderStatus    = DB::table('order_status')->where('id', $id)->update(array('status_name' => $request->get('status_name')));
        if ($updateOrderStatus) {
            Session::flash('message', $order->status_name . ' Updated Successfully');
        }
        return redirect()->to('admin/orderstatus');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (OrderStatus::find($id)->delete()) {
            Session::flash('message', 'OrderStatus Deleted Successfully');
        }
        return redirect()->to('admin/orderstatus');
    }
}
