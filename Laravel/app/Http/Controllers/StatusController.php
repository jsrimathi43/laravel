<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\OrderItemRequest;
use App\Models\Auth\User;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        // echo "hii";die;
        $this->data['orders'] = Order::all();
        // echo"<pre>";print_r($this->data['orders']);die;
        return view('admin.orders.orders', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $this->data['headline'] = "Add New Order";
        $this->data['mode']         = 'create';
        $this->data['orders'] = Order::get();
        $this->data['users'] = User::get();
        $this->data['order'] = '';
        return view('admin.orders.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $formData = $request->all();
        $formData['order_number'] = 'ORD-' . strtoupper(uniqid());
        $formData['grand_total'] = 0;
        $formData['item_count'] = 0;
        $userDetails = User::find($formData['user_id']);
        $formData['first_name'] = $userDetails->first_name;
        $formData['last_name'] = $userDetails->last_name;
        if (Order::create($formData)) {
            Session::flash('message', $formData['order_number'] . ' Added Successfully');
        }

        return redirect()->to('admin/orders');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $this->data['order']        = Order::findOrFail($id);
        $this->data['mode']         = 'edit';
        $this->data['headline']     = 'Update Order';
        $this->data['orders'] = Order::get();
        $this->data['orderItems'] = DB::table('order_items as t1')->select('t2.title', 't1.*')->Join('products AS t2', 't2.id', '=', 't1.product_id')->where('t1.order_id', '=', $id)->get();
        $this->data['products'] = Product::get();
        $this->data['users'] = User::get();

        return view('admin.orders.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, $id)
    {
        $order          = Order::find($id);
        $order->address    = $request->get('address');
        $order->city    = $request->get('city');
        $order->country    = $request->get('country');
        $order->post_code    = $request->get('post_code');
        $order->phone_number    = $request->get('phone_number');
        $order->notes    = $request->get('notes');
        $order->status    = $request->get('status');
        $order->user_id    = $request->get('user_id');
        $updateOrder  = DB::table('orders')->where('id', $id)->update(array('address' => $request->get('address'), 'city' => $request->get('city'), 'country' => $request->get('country'), 'post_code' => $request->get('post_code'), 'phone_number' => $request->get('phone_number'), 'notes' => $request->get('notes'), 'user_id' => $request->get('user_id'), 'status' => $request->get('status')));

        if ($updateOrder) {
            Session::flash('message', $order->order_number . ' Updated Successfully');
        }

        return redirect()->to('admin/orders');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Order::find($id)->delete()) {
            Session::flash('message', 'Order Deleted Successfully');
        }
        return redirect()->to('admin/orders');
    }

    public function destroyorderitem($id)
    {
        $orderItemDetails = OrderItem::find($id);
        if (!empty($orderItemDetails)) {
            $order_id = $orderItemDetails->order_id;
        }
        if (OrderItem::find($id)->delete()) {
            if (!empty($order_id)) {
                $this->data['orders'] = Order::find($order_id)->get();
                $OrderItemPrice = 0;
                $OrderItemQuantity = 0;
                if (!empty($this->data['orders'])) {
                    foreach ($this->data['orders'] as $order) {
                        $OrderItemPrice = $OrderItemPrice + $order->price;
                        $OrderItemQuantity = $OrderItemQuantity + $order->quantity;
                    }
                    DB::table('orders')->where('id', $order_id)->update(array('grand_total' => $OrderItemPrice, 'item_count' => $OrderItemQuantity));
                }
            }
            Session::flash('message', 'Order Item Deleted Successfully');
        }
        return redirect()->to('admin/orders');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createorderitem(OrderItemRequest $request)
    {
        $formData = $request->all();
        $productDetails         = Product::find($formData['product']);
        $formData['product_id'] = $formData['product'];
        $formData['price'] = $formData['quantity'] * $productDetails['price'];
        if (OrderItem::create($formData)) {
            $this->data['orderItems'] = DB::table('order_items as t1')->select('t2.title', 't1.*')->Join('products AS t2', 't2.id', '=', 't1.product_id')->where('t1.order_id', '=', $formData['order_id'])->get();
            $OrderItemPrice = 0;
            $OrderItemQuantity = 0;
            if (!empty($this->data['orderItems'])) {
                foreach ($this->data['orderItems'] as $orderItem) {
                    $OrderItemPrice = $OrderItemPrice + $orderItem->price;
                    $OrderItemQuantity = $OrderItemQuantity + $orderItem->quantity;
                }
                DB::table('orders')->where('id', $formData['order_id'])->update(array('grand_total' => $OrderItemPrice, 'item_count' => $OrderItemQuantity));
            }
            Session::flash('message',  'OrderItem Added Successfully');
        }
        $this->data['order']        = Order::findOrFail($formData['order_id']);
        $this->data['mode']         = 'edit';
        $this->data['headline']     = 'Update Order';
        $this->data['orders'] = Order::get();
        $this->data['products'] = Product::get();
        return redirect()->to('admin/orders');
        // return view('admin.orders.form', $this->data);
    }
}
