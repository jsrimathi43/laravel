<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use App\Notifications\EmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Notification;
use Illuminate\Support\Facades\Redirect;

// use Auth;


class FrontendAuthController extends Controller
{
    public function index()
    {
        $this->data['categories']     = Category::all();
        return view('myaccount.dashboard', $this->data);
    }
    public function loginGet(Request $request)
    {
        $this->data['categories']     = Category::all();
        return view('myaccount.register', $this->data);
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'The password field is required.',
        ]);
        // echo"<pre>";print_r($request->all());
        Session::put('customer_details', $request->all());

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            //    echo"<pre>";print_r($credentials);die;
        }
        // die;
        // echo"<pre>";print_r($request->get('email'));
        // $userDetails = User::where('email', '=',$request->get('email'))->first();
        // // echo"<pre>";print_r(Hash::check($request->get('password'), $userDetails->password));die;

        // echo"<pre>";print_r($userDetails->password);die;

        // if($userDetails && $request->get('password') == $userDetails->password){
        //     echo"<pre>";print_r("success");die;

        // }
        // if (Auth::guard('user')->attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
        //     echo"<pre>";print_r("hello");die;
        // }
        // ['username' => $credentials['username'], 'password' => $credentials['password']
        // echo"<pre>";print_r(!Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']]));die;

        $this->data['users'] = DB::table('users as a1')->select('a1.role_id', 'a1.first_name', 'a1.last_name', 'a1.email_verified_at', 'a1.email', 'a2.id', 'a2.role_name')->leftJoin('role as a2', 'a2.id', '=', 'a1.role_id')->where('email', $credentials['email'])->get()->first();

        // foreach ($this->data['users'] as $key => $item) {
        if (!empty($this->data['users'])) {
            if ((strtolower($this->data['users']->role_name) == "delivery_boy" || strtolower($this->data['users']->role_name) == "delivery boy")) {
           
                if (Auth::attempt($credentials)) {
                    $this->data['email'] = Auth::user()->email;
                    $this->data['delivery_person_id'] = Auth::id();
                    $this->data['delivery_person_detail'] = DB::table('delivery_partners')->select('*')->where('id', '=', $this->data['delivery_person_id'])->get();
                    $this->data['deliveryPartnerDetails'] = DB::table('delivery_partners as dp')->select('dp.*', 'dp.id as delivery_partnerID', 'od.created_at as orderDate', 'od.id as orderID', 'od.*', 'os.id as order_status_id', 'os.status_name')->Join('orders as od', 'od.delivery_partner_id', '=', 'dp.id')->leftJoin('order_status as os', 'os.id', '=', 'od.status')->where('dp.email', '=', $this->data['email'])->get();
                    $this->data['delivery_boy_details'] = DB::table('delivery_partners')->select('*')->where('email', '=', $this->data['email'])->get();
                    $this->data['categories']     = Category::all();
                    return view('myaccount/delivery_partner', $this->data);
                    // return redirect()->to('myaccount/delivery_partner', $this->data);
                } else {
                    return redirect()->to('myaccount/deliveryLogin');
                    // return redirect()->back()->withErrors(['email' => 'These credentials do not match our records.']);
                }
            } else {
                if (Auth::attempt($credentials)) {
                    $cartDetails = ($request->session()->get('cart') !== null ? $request->session()->get('cart') : []);
                    if (!empty($cartDetails)) {
                        return redirect("checkout");
                    } else {
                        // Redirect the user to the home page or any other desired page
                        return redirect("menu");
                    }
                } else {
                    // return redirect()->back()->withErrors(['email' => 'These credentials do not match our records.']);
                    return Redirect::to('/myaccount/login')->withFail('These credentials do not match our records.');
                }
                // return redirect()->to('myaccount/deliveryLogin');
            }
        } else {
            return redirect()->to('myaccount/login');
        }
        // if (Auth::attempt($credentials)) {
        //     return redirect()->to('checkout');
        //     // return redirect()->intended('/');
        // } else {
        //     return redirect()->back()->withErrors(['email' => 'These credentials do not match our records.']);
        // }
    }

    public function logout()
    {
        Auth::logout();
        Session::flush(); // Clear all session data
        Session::regenerate(); // Regenerate the session ID
        return redirect()->to('myaccount/login');
    }

    public function registerGet()
    {
        $this->data['categories']     = Category::all();
        return view('myaccount/register', $this->data);
    }

    public function registerPost(Request $request)
    {
        $roleDetails = DB::table('role')->select('id')->where('role_name', '=', 'Customer')->get();
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            // 'country' => 'required|string|max:255',
            // 'address' => 'required|string|max:255',
            // 'post_code' => 'required',
            // 'city' => 'required',
            // 'phone' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'min:8',
            // 'confirm_password' => 'min:8|required_with:password|same:password'
        ], [
            'first_name.required' => 'The first name field is required.',
            'last_name.required' => 'The last name field is required.',
            // 'country.required' => 'The country field is required.',
            // 'address.required' => 'The address field is required.',
            // 'post_code.required' => 'The postal code field is required.',
            // 'city.required' => 'The city field is required.',
            // 'phone.required' => 'The conatct number field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already registered.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters.',
            // 'confirm_password.password' => 'The password confirmation does not match.',
        ]);

        // Create a new user record
        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        if (!empty($roleDetails)) {
            $user->role_id = $roleDetails[0]->id;
        }
        // $user->country = $request->input('country');
        // $user->address = $request->input('address');
        // $user->post_code = $request->input('post_code');
        // $user->city = $request->input('city');
        // $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        // echo"<pre>";print_r($request->input('Password'));

        $user->password = $request->input('Password');
        // echo"<pre>";print_r($user->password);die;

        // $user->confirm_password = Hash::make($request->input('confirm_password'));
        $user->email_verified_at = 1;
        $user->save();

        $data = [
            "id" => $user->id,
            "email" => $user->email,
            "first_name" => $user->first_name,
            "last_name" => $user->last_name,
        ];

        $this->sendMail($data);
        // Log in the newly registered user
        Auth::login($user);
        $cartDetails = ($request->session()->get('cart') !== null ? $request->session()->get('cart') : []);
        // die;
        if (!empty($cartDetails)) {
            return redirect("checkout");
        } else {
            // Redirect the user to the home page or any other desired page
            return redirect("myaccount/dashboard");
        }
    }
    public function sendMail($data)
    {
        // print"<pre>";print_r($data);die;
        $user = $data['email'];

        $project = [
            'subject' => 'Your sign-up with Laravel',
            'greeting' => 'Hi ' . $data['first_name'] . $data['last_name'] . ',',
            'body' => 'Thank you for your signing up with our Shop .</br>
            <div class="h5" >You will gain access via the email address <b>' . $user . ' </b> and the password you have chosen.</div></br>
            <div class="h5" >You can change your password anytime. </div></br>',
            'thanks' => 'Thank you',
            'actionText' => 'View shop',
            'actionURL' => url('/'),
            'id' => $data['id']
        ];
        Notification::route('mail', $user)->notify(new EmailNotification($project));
        // Notification::send($user, new EmailNotification($project));

        // dd('Notification sent!');
    }
}