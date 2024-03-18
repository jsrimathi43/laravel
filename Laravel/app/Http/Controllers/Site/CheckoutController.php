<?php

namespace App\Http\Controllers\Site;

use Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\PayPalService;
use App\Contracts\OrderContract;
use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\Category;
// use App\Models\Cart;
use Darryldecode\Cart\Cart as CartCart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\OrderAddress;
use Gloudemans\Shoppingcart\Facades\Cart as FacadesCart;
use Illuminate\Support\Facades\DB;
use Notification;
use App\Notifications\EmailNotification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;


class CheckoutController extends Controller
{
    protected $payPal;

    protected $orderRepository;

    public function __construct(OrderContract $orderRepository,PayPalService $payPal)
    {
        $this->payPal = $payPal;
        $this->orderRepository = $orderRepository;
    }

    public function getCheckout()
    {
        // http://192.168.3.73:8000/myaccount/register
        // Session::get('variableName');
        $this->data['categories']     = Category::all();
        $this->data['countries'] = Country::get(["name", "id"]);
        $cartDetails['cartDetails'] = (Session::get('cart') !== null ? Session::get('cart') : []);
        if (!empty($cartDetails['cartDetails'])) {
            return view('site.pages.checkout', $this->data);
        } else {
            return Redirect::to('/menu')->withFail("Cart is empty");
        }
    }

    public function placeOrder(Request $request)
    {
        // echo"<pre>";print_r($request->all());
        // print"<pre>";print_r(OrderAddress::create($request->all()));die;
        // echo"test";die;
        if (Auth::check()) {
            if(!$request->get('shipping_detail_checkbox')){
                $request['shipping_first_name'] = $request->get('billing_first_name');
                $request['shipping_last_name'] = $request->get('billing_last_name');
                $request['shipping_country_id'] = $request->get('billing_country_id');
                $request['shipping_state_id'] = $request->get('billing_state_id');
                $request['shipping_city_id'] = $request->get('billing_city_id');
                $request['shipping_street'] = $request->get('billing_street');
                $request['shipping_zip_code'] = $request->get('billing_zip_code');
                $request['shipping_phone_number'] = $request->get('billing_phone_number');
            }

           
            $userDetails = OrderAddress::create($request->all());

            $userDetails['address_id'] = $userDetails->id;
            $userDetails['quantity'] = 0;
            $userDetails['sub_total'] = $request->get('sub_total');
            $userDetails['payment_method'] = $request->get('payment_method');
            $cartDetails['cartDetails'] = ($request->session()->get('cart') !== null ? $request->session()->get('cart') : []);
            // print"<pre>";print_r($userDetails);
            if (!empty($cartDetails['cartDetails'])) {
                foreach ($cartDetails['cartDetails'] as $detail) {
                    $userDetails['quantity'] = $userDetails['quantity'] + $detail['quantity'];
                    // $userDetails['sub_total'] = $userDetails['sub_total'] + $detail['price'];
                    // $userDetails['grand_total'] = $userDetails['sub_total'] * $detail['quantity'];
                }

                $order = $this->orderRepository->storeOrderDetails($userDetails, $cartDetails);
                $this->data['order'] = DB::table('orders as t1')->select('t1.id as ord_id','t1.order_number','t1.delivery_partner_id','t1.payment_method','t3.*','c1.id as billing_county_id','c1.name as billing_county_name','s1.id as billing_state_id','s1.name as billing_state_name','ct1.id as billing_city_id','ct1.name as billing_city_name','c11.id as shipping_county_id','c11.name as shipping_county_name','s11.id as shipping_state_id','s11.name as shipping_state_name','ct11.id as shipping_city_id','ct11.name as shipping_city_name','curr.code')->leftJoin('order_addresses as t3','t3.id', '=', 't1.address_id' )->leftJoin('countries as c1', 'c1.id', '=','t3.billing_country_id')->leftJoin('states as s1', 's1.id', '=','t3.billing_state_id')->leftJoin('cities as ct1', 'ct1.id', '=','t3.billing_city_id')->leftJoin('countries as c11', 'c11.id', '=','t3.shipping_country_id')->leftJoin('states as s11', 's11.id', '=','t3.shipping_state_id')->leftJoin('cities as ct11', 'ct11.id', '=','t3.shipping_city_id')->leftJoin('currencies as curr','curr.country_id','=','c1.id')->where('t1.id', '=', $order->id)->get();
                $this->data['address_details'] = $userDetails;
                $this->data['cart_products'] = $cartDetails['cartDetails'];
                $this->data['categories'] 	= Category::all();
                // You can add more control here to handle if the order is not stored properly
                if ($order && $request->get('payment_method') == 'paypal') {
                    $this->payPal->processPayment($order,$this->data['order']);
                }

                //clear the session value after place order process
                // $request->session()->flush();
                $products = $request->session()->get('cart');
                foreach ($products as $key => $value) {
                    unset($products[$key]);
                }
                //put back in session array without deleted item
                $request->session()->put('cart', $products);
                // echo'<pre>';print_r($this->data);die;
                // return redirect()->back()->with('message', 'Order placed');
                // return redirect('/checkout/order');
                $this->sendMail($this->data);

                return view('site.pages.success', $this->data);
            } else {
                return redirect('/menu');
            }
            // Before storing the order we should implement the
            // request validation which I leave it to you
        } else {
            return redirect('/myaccount/register');
        }
    }
    public function orderSuccess($id)
    {
        $this->data['userDetails'] = OrderAddress::all();
        $this->data['categories'] 	= Category::all();

        // print"<pre>";print_r($userDetails);
        // echo"<pre>";print_r($id);die;
        // Display the order confirmation page with order details
        return view('site.pages.success',$this->data);
    }
   
    public function complete(Request $request)
    {
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');

        $status = $this->payPal->completePayment($paymentId, $payerId);

        $order = Order::where('order_number', $status['invoiceId'])->first();
        $order->payment_order_status = 'processing';
        $order->payment_status = 1;
        $order->payment_method = 'PayPal -' . $status['salesId'];
        $order->save();
		$cartDetails['cartDetails'] = ($request->session()->get('cart') !== null ? $request->session()->get('cart') : []);
		$this->data['order'] = DB::table('orders as t1')->select('t1.id as ord_id','t1.order_number','t1.delivery_partner_id','t1.payment_method','t3.*','c1.id as billing_county_id','c1.name as billing_county_name','s1.id as billing_state_id','s1.name as billing_state_name','ct1.id as billing_city_id','ct1.name as billing_city_name','c11.id as shipping_county_id','c11.name as shipping_county_name','s11.id as shipping_state_id','s11.name as shipping_state_name','ct11.id as shipping_city_id','ct11.name as shipping_city_name')->leftJoin('order_addresses as t3','t3.id', '=', 't1.address_id' )->leftJoin('countries as c1', 'c1.id', '=','t3.billing_country_id')->leftJoin('states as s1', 's1.id', '=','t3.billing_state_id')->leftJoin('cities as ct1', 'ct1.id', '=','t3.billing_city_id')->leftJoin('countries as c11', 'c11.id', '=','t3.shipping_country_id')->leftJoin('states as s11', 's11.id', '=','t3.shipping_state_id')->leftJoin('cities as ct11', 'ct11.id', '=','t3.shipping_city_id')->where('t1.id', '=', $order->id)->get();
		$this->data['cart_products'] = $cartDetails['cartDetails'];
		$this->data['categories'] 	= Category::all();
        //~ FacadesCart::clear();
        session()->forget('cart');
        //~ print"<pre>";print_r($order);die;
        $this->sendMail($this->data);

        return view('site.pages.success', $this->data);
    }
     public function sendMail($data)
    {
        $this->data['order'] = $data['order'];
        // $this->data['address_details'] = $data['address_details'];
        $this->data['cart_products'] = $data['cart_products'];
        $this->data['url'] = url('/');
        // print"<pre>";print_r($this->data['order']);die;
        $user = $data['order'][0]->email_id;
        $view = View::make('site.pages.mail',$this->data);
        $project = [
            'subject' => 'Order confirmation',
            'greeting' => 'Dear ' . $data['order'][0]->billing_first_name . $data['order'][0]->billing_last_name,
            'body' => 'We have received your order from <span>' .Carbon::parse($data['order'][0]->created_at)->format('dd mm Y'). ' </span>.</br>'.$view.'',
            'thanks' => 'Thank you',
            'actionText' => 'View Booking',
            'actionURL' => url('/'),
            'id' => $data['order'][0]->ord_id
        ];

        Notification::route('mail', $user)->notify(new EmailNotification($project));
    }

}
