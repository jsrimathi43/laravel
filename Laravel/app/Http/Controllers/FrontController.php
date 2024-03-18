<?php

namespace App\Http\Controllers;

use App\Models\Auth\Admin;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Contacts;
use Illuminate\Support\Facades\Redirect;
use App\Notifications\EmailNotification;
use Notification;
use Illuminate\Support\Facades\Session;


class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function home()
    {
        $this->data['products']     = Product::all();
        $this->data['productLimit'] = Product::select("*")->limit(4)->get();
        $this->data['categories']     = Category::all();
        $this->data['category']     = Category::select("*")->limit(10)->get();

        return view('home', $this->data);
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function products()
    {
        return view('products');
    }

 
    public function menu()
    {
        $this->data['products'] = DB::table('products as t1')->select('t2.title as categoryTitle', 't1.*')->leftJoin('categories AS t2', 't2.id', '=', 't1.category_id')->get();
        $this->data['countries'] = Country::get(["name", "id"]);
        $this->data['categories']     = Category::all();
        return view('/menu/menu', $this->data);
    }

  

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $this->data['contacts'] = Contacts::all();
        return view('admin.contacts.contact', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $this->data['contacts']        = Contacts::findOrFail($id);
        $this->data['mode']         = 'edit';
        $this->data['headline']     = 'Update Contacts';
        return view('admin.contacts.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'response' => 'required'
        ]);
        $contact          = Contacts::find($id);
        $updateContact    = DB::table('contacts')->where('id', $id)->update(array('response' => $request->get('response')));
        if ($updateContact) {
            $projectUser = [
                'subject' => 'Your contact-us response from Laravel',
                'greeting' => 'Hi ' . $contact->name . ',',
                'body' => 'Your response from contact us request .</br>
                <div class="h5" >'.$request->get('response').' </div></br>',
                'thanks' => 'Thank you',
                'actionText' => 'Contact Us',
                'actionURL' => url('/')
            ];
            Notification::route('mail', $contact->email)->notify(new EmailNotification($projectUser));
            Session::flash('message', ' Updated Successfully');
        }
        return redirect()->to('admin/contactus');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Contacts::find($id)->delete()) {
            Session::flash('message', 'Contacts Deleted Successfully');
        }
        return redirect()->to('admin/contactus');
    }
}
