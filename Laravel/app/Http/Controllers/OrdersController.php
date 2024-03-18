<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\OrderItemRequest;
use App\Models\Auth\User;
use App\Models\Category;
use App\Models\City;
use App\Models\DeliveryPartner;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\ReviewRating;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Barryvdh\DomPDF\Facade\Pdf;
use Notification;
use App\Notifications\EmailNotification;
use App\Models\Country;
use Illuminate\Support\Facades\Hash;
use App\Models\OrderAddress;
use App\Models\State;

// use PDF;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $this->data['orders'] = DB::table('orders as t1')->select('t1.id as ord_id','t1.order_number','t1.created_at as order_date','t1.grand_total', 't1.delivery_partner_id as delParID', 't2.id as delivery_id', 't2.name as delivery_partner_name', 't2.available_status as delivery_partners_status', 't2.contact_number as delivery_partners_number', 't3.*', 't3.id as order_addressesID', 'c1.id as billing_county_id', 'c1.name as billing_county_name', 's1.id as billing_state_id', 's1.name as billing_state_name', 'ct1.id as billing_city_id', 'ct1.name as billing_city_name', 'c11.id as shipping_county_id', 'c11.name as shipping_county_name', 's11.id as shipping_state_id', 's11.name as shipping_state_name', 'ct11.id as shipping_city_id', 'ct11.name as shipping_city_name','os.status_name')->Join('order_status AS os', 'os.id', '=', 't1.status')->leftJoin('delivery_partners AS t2', 't2.id', '=', 't1.delivery_partner_id')->leftJoin('order_addresses as t3', 't3.id', '=', 't1.address_id')->leftJoin('countries as c1', 'c1.id', '=', 't3.billing_country_id')->leftJoin('states as s1', 's1.id', '=', 't3.billing_state_id')->leftJoin('cities as ct1', 'ct1.id', '=', 't3.billing_city_id')->leftJoin('countries as c11', 'c11.id', '=', 't3.shipping_country_id')->leftJoin('states as s11', 's11.id', '=', 't3.shipping_state_id')->leftJoin('cities as ct11', 'ct11.id', '=', 't3.shipping_city_id')->get();
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
        $this->data['orderstatus'] = OrderStatus::get();
        $this->data['countries'] = Country::get(["name", "id"]);
        $this->data['cities'] = City::get(["name", "id"]);
        $this->data['states'] = State::get(["name", "id"]);
        $this->data['deliverypartners'] = DB::table('delivery_partners')->select('*')->where('available_status', '=', 1)->get();
        $this->data['delivery_time'] = array('09:00 am - 10:00 am' => '09:00 am - 10:00 am', '10:00 am - 11:00 am' => '10:00 am - 11:00 am', '11:00 am - 12:00 am' => '11:00 am - 12:00 am', '12:00 am - 01:00 pm' => '12:00 am - 01:00 pm', '01:00 pm - 02:00 pm' => '01:00 pm - 02:00 pm', '02:00 pm - 03:00 pm' => '02:00 pm - 03:00 pm', '03:00 pm - 04:00 pm' => '03:00 pm - 04:00 pm', '04:00 pm - 05:00 pm' => '04:00 pm - 05:00 pm', '05:00 pm - 06:00 pm' => '05:00 pm - 06:00 pm', '06:00 pm - 07:00 pm' => '06:00 pm - 07:00 pm', '07:00 pm - 08:00 pm' => '07:00 pm - 08:00 pm', '08:00 pm - 09:00 pm' => '08:00 pm - 09:00 pm');
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
        if (!$request->get('shipping_detail_checkbox')) {
            $formData['shipping_first_name'] = $request->get('billing_first_name');
            $formData['shipping_last_name'] = $request->get('billing_last_name');
            $formData['shipping_country_id'] = $request->get('billing_country_id');
            $formData['shipping_state_id'] = $request->get('billing_state_id');
            $formData['shipping_city_id'] = $request->get('billing_city_id');
            $formData['shipping_street'] = $request->get('billing_street');
            $formData['shipping_zip_code'] = $request->get('billing_zip_code');
            $formData['shipping_phone_number'] = $request->get('billing_phone_number');
        }
        $formData['order_number'] = 'ORD-' . strtoupper(uniqid());
        $formData['grand_total'] = 0;
        $formData['item_count'] = 0;
        $userDetails = User::find($formData['user_id']);

        $formData['first_name'] = $userDetails->first_name;
        $formData['last_name'] = $userDetails->last_name;
        $formData['billing_first_name'] = $userDetails->first_name;
        $formData['billing_last_name'] = $userDetails->last_name;
        $formData['delivery_collection_time'] = '';
        $orderAddressDetails = OrderAddress::create($formData);
        $formData['address_id'] = $orderAddressDetails->id;
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
        $this->data['order']        = DB::table('orders as t1')->select('t2.delivery_time', 't2.delivery_collection_time', 't2.billing_country_id', 't2.billing_state_id', 't2.billing_city_id', 't2.billing_street', 't2.billing_zip_code', 't2.billing_phone_number', 't2.shipping_country_id', 't2.shipping_state_id', 't2.shipping_city_id', 't2.shipping_street', 't2.shipping_zip_code', 't2.shipping_phone_number', 't2.email_id', 't2.billing_first_name', 't2.billing_last_name', 't2.shipping_first_name', 't2.shipping_last_name', 't2.notes', 't1.*')->Join('order_addresses AS t2', 't2.id', '=', 't1.address_id')->where('t1.id', '=', $id)->get();
        $this->data['mode']         = 'edit';
        $this->data['headline']     = 'Update Order';
        $this->data['orders'] = Order::get();
        $this->data['orderItems'] = DB::table('order_items as t1')->select('t2.title', 't1.*')->Join('products AS t2', 't2.id', '=', 't1.product_id')->where('t1.order_id', '=', $id)->get();
        $this->data['products'] = Product::get();
        $this->data['users'] = User::get();
        $this->data['orderstatus'] = OrderStatus::get();
        $this->data['countries'] = Country::get(["name", "id"]);
        $this->data['cities'] = City::get(["name", "id"]);
        $this->data['states'] = State::get(["name", "id"]);
        $this->data['deliverypartners'] = DB::table('delivery_partners')->select('*')->where('available_status', '=', 1)->get();
        $this->data['delivery_time'] = array('09:00 am - 10:00 am' => '09:00 am - 10:00 am', '10:00 am - 11:00 am' => '10:00 am - 11:00 am', '11:00 am - 12:00 am' => '11:00 am - 12:00 am', '12:00 am - 01:00 pm' => '12:00 am - 01:00 pm', '01:00 pm - 02:00 pm' => '01:00 pm - 02:00 pm', '02:00 pm - 03:00 pm' => '02:00 pm - 03:00 pm', '03:00 pm - 04:00 pm' => '03:00 pm - 04:00 pm', '04:00 pm - 05:00 pm' => '04:00 pm - 05:00 pm', '05:00 pm - 06:00 pm' => '05:00 pm - 06:00 pm', '06:00 pm - 07:00 pm' => '06:00 pm - 07:00 pm', '07:00 pm - 08:00 pm' => '07:00 pm - 08:00 pm', '08:00 pm - 09:00 pm' => '08:00 pm - 09:00 pm');
        return view('admin.orders.form', $this->data);
    }

    public function getOrderName($statusId)
    {
        $orderStatusName = DB::table('order_status')->select('status_name', 'id')->where('id', '=', $statusId)->get();
        return $orderStatusName;
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
        $orderAddress = OrderAddress::find($order->address_id);
        $previous_order_status = $order->status;

        //OrderAddress 
        $orderAddress->delivery_time    = $request->get('delivery_time');
        $orderAddress->billing_country_id    = $request->get('billing_country_id');
        $orderAddress->billing_state_id    = $request->get('billing_state_id');
        $orderAddress->billing_city_id    = $request->get('billing_city_id');
        $orderAddress->billing_street    = $request->get('billing_street');
        $orderAddress->billing_zip_code    = $request->get('billing_zip_code');
        $orderAddress->billing_phone_number    = $request->get('billing_phone_number');
        $orderAddress->email_id    = $request->get('email_id');
        $orderAddress->shipping_first_name    = $request->get('shipping_first_name');
        $orderAddress->shipping_last_name    = $request->get('shipping_last_name');
        $orderAddress->shipping_country_id    = $request->get('shipping_country_id');
        $orderAddress->shipping_state_id    = $request->get('shipping_state_id');
        $orderAddress->shipping_city_id    = $request->get('shipping_city_id');
        $orderAddress->shipping_street    = $request->get('shipping_street');
        $orderAddress->shipping_zip_code    = $request->get('shipping_zip_code');
        $orderAddress->shipping_phone_number    = $request->get('shipping_phone_number');
        $orderAddress->shipping_zip_code    = $request->get('shipping_zip_code');

        //order
        $order->delivery_partner_id    = $request->get('delivery_partner_id');
        $order->status    = $request->get('status');
        $order->notes    = $request->get('notes');
        $order->user_id    = $request->get('user_id');
        $updateOrderAddress = $orderAddress->save();
        $updateOrder = $order->save();

        if ($updateOrder && $updateOrderAddress) {
            if ($previous_order_status != $request->get('status')) {
                $statusDetails = $this->getOrderName($request->get('status'));
                $userDetails = DB::table('users')->select('email')->where('id', '=', $order->user_id)->get();
                $project = [
                    'subject' => 'Your order with ' . config('app.name') . ' is ' . $statusDetails[0]->status_name,
                    'greeting' => 'Hi ' . $order->first_name . ' ' .  $order->last_name . ',',
                    'body' => 'The status of your order at ' . config('app.name') . ' (Number:' . $order->order_number . ') on ' . $order->updated_at . ' has changed.<br>The new status is as follows : ' . $statusDetails[0]->status_name . '.</br>',
                    'thanks' => 'Thank you',
                    'actionText' => 'View Order details',
                    'actionURL' => url('/myaccount/ordersview/' . $id),
                    'id' => $id
                ];
                Notification::route('mail', $userDetails[0]->email)->notify(new EmailNotification($project));
            }
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
        $orderAddressId = Order::find($id)->address_id;
        if (Order::find($id)->delete()) {
            OrderAddress::find($orderAddressId)->delete();
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
    }

    public function ordersView()
    {
        if (Auth::check()) {
            $this->data['categories']     = Category::all();
            $this->data['orders'] = DB::table('orders as t1')->select('t2.status_name', 't1.*')->leftJoin('order_status AS t2', 't2.id', '=', 't1.status')->where('t1.user_id', '=', Auth::id())->simplePaginate(10);
            return view('myaccount.ordersview', $this->data);
        } else {
            Session::flash('message', 'No orders yet');
        }
    }

    public function accountDetailsView()
    {
        if (Auth::check()) {
            $this->data['categories']     = Category::all();
            $this->data['accountdetails'] = DB::table('users as t1')->select('t1.*')->where('t1.id', '=', Auth::id())->get();
            return view('myaccount.accountdetailsview', $this->data);
        } else {
            return redirect()->to('myaccount/login');
        }
    }

    public function accountDetailsUpdate(Request $request, $user_id)
    {
        $user               = User::find($user_id);
        $request->validate([
            'first_name' => 'required',
            'email' => 'required|email'
        ]);
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->email = $request->get('email');
        $user->save();
        if (!empty($request->get('current_password'))) {
            if (Hash::check($request->get('current_password'), $user->password)) {
                if (!empty($request->get('new_password')) && !empty($request->get('confirm_new_password'))) {
                    if ($request->get('new_password') == $request->get('confirm_new_password')) {
                        $user->password     = Hash::make($request->get('new_password'));
                        if ($user->save()) {
                            return Redirect::to('/myaccount/accountdetailsview')->withSuccess('Account Details Updated Successfully');
                        }
                    } else {
                        return Redirect::to('/myaccount/accountdetailsview')->withFail('Password mismatch');
                    }
                } else {
                    return Redirect::to('/myaccount/accountdetailsview')->withFail('Enter both new password and confirm password field.');
                }
            } else {
                return Redirect::to('/myaccount/accountdetailsview')->withFail('Current password is a mismatch with old password.');
            }
        }
        return Redirect::to('/myaccount/accountdetailsview')->withSuccess('Account Details Updated Successfully');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function reviewstore(Request $request): RedirectResponse
    {
        $formData = $request->all();
        if (ReviewRating::create($formData)) {
            Session::flash('message', $formData['star_rating'] . ' Added Successfully');
        }
        return redirect()->to('myaccount/ordersview/' . $formData['order_id']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function ordersViewEdit($id)
    {
        $this->data['order']        = Order::findOrFail($id);
        $this->data['mode']         = 'edit';
        $this->data['headline']     = 'Update Order';
        $this->data['orders']       = Order::get();
        $this->data['ord_deldet']   = DB::table('orders as t1')->select('t1.id as ord_id', 't1.delivery_partner_id as delParID', 't2.id as delivery_id', 't2.name as delivery_partner_name', 't2.available_status as delivery_partners_status', 't2.contact_number as delivery_partners_number', 't3.*', 't3.id as order_addressesID', 'c1.id as billing_county_id', 'c1.name as billing_county_name', 's1.id as billing_state_id', 's1.name as billing_state_name', 'ct1.id as billing_city_id', 'ct1.name as billing_city_name', 'c11.id as shipping_county_id', 'c11.name as shipping_county_name', 's11.id as shipping_state_id', 's11.name as shipping_state_name', 'ct11.id as shipping_city_id', 'ct11.name as shipping_city_name','os.status_name')->leftJoin('delivery_partners AS t2', 't2.id', '=', 't1.delivery_partner_id')->leftJoin('order_addresses as t3', 't3.id', '=', 't1.address_id')->leftJoin('countries as c1', 'c1.id', '=', 't3.billing_country_id')->leftJoin('states as s1', 's1.id', '=', 't3.billing_state_id')->leftJoin('cities as ct1', 'ct1.id', '=', 't3.billing_city_id')->leftJoin('countries as c11', 'c11.id', '=', 't3.shipping_country_id')->leftJoin('states as s11', 's11.id', '=', 't3.shipping_state_id')->leftJoin('cities as ct11', 'ct11.id', '=', 't3.shipping_city_id')->leftJoin('order_status as os', 'os.id', '=', 't1.status')->where('t1.id', '=', $id)->get();
        $this->data['categories']     = Category::all();
        $this->data['orderItems']   = DB::table('order_items as t1')->select('t2.title', 't1.*')->Join('products AS t2', 't2.id', '=', 't1.product_id')->where('t1.order_id', '=', $id)->get();
        $this->data['products']     = Product::get();
        $this->data['users']        = User::get();
        $this->data['orderstatus']  = OrderStatus::get();
        $this->data['ratings']      = DB::table('orders as t1')->select('t1.id as order_review_id', 't2.*')->leftJoin('review_ratings as t2', 't2.order_id', '=', 't1.id')->where('t1.id', '=', $id)->get();
        return view('myaccount.ordersedit', $this->data);
    }
    public function ordersViewDelete($id)
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
        return redirect()->to('myaccount/ordersview');
    }

    public function deliveryLogin()
    {
        $this->data['headline'] = "Login";
        $this->data['categories']     = Category::all();
        return view('myaccount.deliveryLogin', $this->data);
    }

    public function deliveryPartner(Request $request)
    {
        $this->data['users'] = DB::table('users as a1')->select('a1.role_id', 'a1.first_name', 'a1.last_name', 'a1.email_verified_at', 'a1.email', 'a2.id', 'a2.role_name')->leftJoin('role as a2', 'a2.id', '=', 'a1.role_id')->where('email', Auth::user()->email)->get();
        foreach ($this->data['users'] as $key => $item) {
            if ((strtolower($item->role_name) === "delivery_boy" || strtolower($item->role_name) === "delivery boy") && $item->email === Auth::user()->email) {
                if (Auth::user()) {
                    $this->data['email'] = Auth::user()->email;
                    $this->data['delivery_person_id'] = Auth::id();
                    $this->data['delivery_person_detail'] = DB::table('delivery_partners')->select('*')->where('id', '=', $this->data['delivery_person_id'])->get();
                    $this->data['deliveryPartnerDetails'] = DB::table('delivery_partners as dp')->select('dp.*', 'dp.id as delivery_partnerID', 'od.created_at as orderDate', 'od.id as orderID', 'od.*', 'os.id as order_status_id', 'os.status_name')->Join('orders as od', 'od.delivery_partner_id', '=', 'dp.id')->leftJoin('order_status as os', 'os.id', '=', 'od.status')->where('dp.email', '=', $this->data['email'])->get();
                    $this->data['delivery_boy_details'] = DB::table('delivery_partners')->select('*')->where('email', '=', $this->data['email'])->get();
                    $this->data['categories']     = Category::all();
                    return view('myaccount/delivery_partner', $this->data);
                } else {
                    return redirect()->back()->withErrors(['email' => 'These credentials do not match our records.']);
                }
            } else {
                return redirect()->to('myaccount/deliveryLogin');
            }
        }
    }

    public function acceptOrder(Request $request)
    {
        $formData = $request->all();
        if (!isset($formData['available_status'])) {
            $formData['available_status'] = 0;
        }
        DB::table('delivery_partners')->where('id', $formData['delivery_person_id'])->update(array('available_status' => $formData['available_status']));
        return redirect()->to('myaccount/delivery_partner');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function deliverypartnerEdit($id)
    {
        $this->data['orderstatus'] = OrderStatus::get();
        $this->data['deliveryPartnerDetails'] = DB::table('orders as od')->select('dp.*', 'od.id as orderID', 'od.*', 'os.id as order_status_id', 'os.status_name', 'oadd.id as orderAddressID', 'oadd.order_id as order_add_id', 'oadd.*', 'od.created_at as order_created_date', 'oadd.created_at as order_address_created_at', 'c1.id as order_shipping_county_id', 'c1.name as order_shipping_county_name', 's1.id as order_shipping_state_id', 's1.name as order_shipping_state_name', 'ct1.id as order_shipping_city_id', 'ct1.name as order_shipping_city_name', 'oitem.id as order_item_id', 'oitem.product_id as order_item_product_id', 'oitem.order_id as order_items_order_id', 'prod.id as product_id', 'prod.title as order_product_name')->leftJoin('delivery_partners as dp', 'od.delivery_partner_id', '=', 'dp.id')->leftJoin('order_status as os', 'os.id', '=', 'od.status')->leftJoin('order_addresses as oadd', 'oadd.id', '=', 'od.address_id')->leftJoin('countries as c1', 'c1.id', '=', 'oadd.shipping_country_id')->leftJoin('states as s1', 's1.id', '=', 'oadd.shipping_state_id')->leftJoin('cities as ct1', 'ct1.id', '=', 'oadd.shipping_city_id')->leftJoin('order_items as oitem', 'oitem.order_id', '=', 'od.id')->leftJoin('products as prod', 'prod.id', '=', 'oitem.product_id')->where('od.id', '=', $id)->get();
        $this->data['categories']     = Category::all();
        return view('myaccount.delivery_partner_edit', $this->data);
    }
    function download_invoice($oid)
    {
        $this->data['orderItems'] = DB::table('order_items as t1')->select('t2.title', 't1.*')->Join('products AS t2', 't2.id', '=', 't1.product_id')->where('t1.order_id', '=', $oid)->get();
        $this->data['order'] = DB::table('orders as t1')->select('t2.first_name as customer_first_name', 't2.last_name as customer_last_name', 't1.*', 't3.name as delivery_partner_name', 'c1.name as country_name', 's1.name as state_name', 'ct1.name as city_name', 't4.billing_street', 't4.billing_zip_code', 't4.billing_first_name', 't4.billing_last_name', 't4.billing_phone_number')->leftJoin('delivery_partners as t3', 't3.id', '=', 't1.delivery_partner_id')->leftJoin('users as t2', 't2.id', '=', 't1.user_id')->leftJoin('order_addresses as t4', 't4.id', '=', 't1.address_id')->leftJoin('countries as c1', 'c1.id', '=', 't4.billing_country_id')->leftJoin('states as s1', 's1.id', '=', 't4.billing_state_id')->leftJoin('cities as ct1', 'ct1.id', '=', 't4.billing_city_id')->where('t1.id', '=', $oid)->get();

        $invoice_date = date('jS F Y', strtotime($this->data['order'][0]->created_at));
        $pdf = PDF::loadView('admin.orders.invoice_template', $this->data);
        return $pdf->download('Invoice_' . config('app.name') . '_Order_No # ' . $oid . ' Date_' . $invoice_date . '.pdf');
    }
    function view_invoice($oid)
    {
        $this->data['order'] = DB::table('orders as t1')->select('t2.first_name as customer_first_name', 't2.last_name as customer_last_name', 't1.*', 't3.name as delivery_partner_name', 'c1.name as country_name', 's1.name as state_name', 'ct1.name as city_name', 't4.billing_street', 't4.billing_zip_code', 't4.billing_first_name', 't4.billing_last_name', 't4.billing_phone_number')->leftJoin('delivery_partners as t3', 't3.id', '=', 't1.delivery_partner_id')->leftJoin('users as t2', 't2.id', '=', 't1.user_id')->leftJoin('order_addresses as t4', 't4.id', '=', 't1.address_id')->leftJoin('countries as c1', 'c1.id', '=', 't4.billing_country_id')->leftJoin('states as s1', 's1.id', '=', 't4.billing_state_id')->leftJoin('cities as ct1', 'ct1.id', '=', 't4.billing_city_id')->where('t1.id', '=', $oid)->get();

        $this->data['orderItems'] = DB::table('order_items as t1')->select('t2.title', 't1.*')->Join('products AS t2', 't2.id', '=', 't1.product_id')->where('t1.order_id', '=', $oid)->get();
        return view('admin.orders.invoice_template', $this->data);
    }

    public function show($id)
    {
        $this->data['orders']     = DB::table('orders as t1')->select('t2.first_name as customer_first_name', 't2.last_name as customer_last_name', 't1.*', 't3.name as delivery_partner_name', 'c1.name as country_name', 's1.name as state_name', 'ct1.name as city_name', 't4.billing_street', 't4.billing_zip_code')->leftJoin('delivery_partners as t3', 't3.id', '=', 't1.delivery_partner_id')->leftJoin('users as t2', 't2.id', '=', 't1.user_id')->leftJoin('order_addresses as t4', 't4.id', '=', 't1.address_id')->leftJoin('countries as c1', 'c1.id', '=', 't4.billing_country_id')->leftJoin('states as s1', 's1.id', '=', 't4.billing_state_id')->leftJoin('cities as ct1', 'ct1.id', '=', 't4.billing_city_id')->where('t1.id', '=', $id)->get();

        $this->data['tab_menu']     = 'order_info';
        $this->data['headline']     = 'View Order Details';
        $this->data['orderItems'] = DB::table('order_items as t1')->select('t2.title', 't1.*')->Join('products AS t2', 't2.id', '=', 't1.product_id')->where('t1.order_id', '=', $id)->get();

        return view('admin.orders.show', $this->data);
    }

    public function updateStatus(Request $request)
    {
        $order          = Order::find($request->get('order_id'));
        $previous_order_status = $order->status;
        if ($previous_order_status != $request->get('status')) {
            $updateOrder  = DB::table('orders')->where('id', $request->get('order_id'))->update(array('status' => $request->get('status')));
            $statusDetails = $this->getOrderName($request->get('status'));
            $userDetails = DB::table('users')->select('email')->where('id', '=', $order->user_id)->get();
            $project = [
                'subject' => 'Your order with ' . config('app.name') . ' is ' . $statusDetails[0]->status_name,
                'greeting' => 'Hi ' . $order->first_name . ' ' .  $order->last_name . ',',
                'body' => 'The status of your order at ' . config('app.name') . ' (Number:' . $order->order_number . ') on ' . $order->updated_at . ' has changed.<br>The new status is as follows : ' . $statusDetails[0]->status_name . '.</br>',
                'thanks' => 'Thank you',
                'actionText' => 'View Order details',
                'actionURL' => url('/myaccount/ordersview/' . $request->get('order_id')),
                'id' => $request->get('order_id')
            ];
            Notification::route('mail', $userDetails[0]->email)->notify(new EmailNotification($project));
        }
        return redirect()->to('myaccount/delivery_partner/' . $request->get('order_id'));
    }

    public function reOrder($order_id)
    {
        $orderItemDetails = DB::table('order_items')->select('*')->where('order_id', '=', $order_id)->get();
        if (!empty($orderItemDetails)) {
            foreach ($orderItemDetails as $orderItem) {
                $product = Product::findOrFail($orderItem->product_id);

                $cart = session()->get('cart', []);

                if (isset($cart[$orderItem->product_id])) {
                    $cart[$orderItem->product_id]['quantity']++;
                } else {
                    $cart[$orderItem->product_id] = [
                        "title" => $product->title,
                        "quantity" => $orderItem->quantity,
                        "price" => $product->price,
                        "image" => $product->image
                    ];
                }
                session()->put('cart', $cart);
            }
        }
        return redirect('/menu');
    }

    public function ordersViewUpdate($id)
    {
        $orderItemDetails = Order::find($id);
        $orderStatus = DB::table('order_status as t1')->select('t1.id')->where(strtolower('status_name'),'=','cancelled')->get()->first();
        if (!empty($orderItemDetails)) {
            $order_id = $orderItemDetails->id;
            if (!empty($order_id)) {
                DB::table('orders')->where('id', $order_id)->update(array('status' => $orderStatus->id));
            }
            
            Session::flash('message', 'Order Item Cancelled Successfully');
        }
        return redirect()->to('myaccount/ordersview/');
    }
}
