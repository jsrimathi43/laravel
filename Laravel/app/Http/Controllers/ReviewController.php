<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\OrderStatusRequest;
use App\Http\Requests\ReviewRequest;
use App\Models\Auth\User;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ReviewRating;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $this->data['review'] = ReviewRating::all();
        return view('admin.reviews.review', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $this->data['headline'] = "Add New Review";
        $this->data['mode']         = 'create';
        $this->data['ratings']     = array(array('id' => 1, 'value' => 1), array('id' => 2, 'value' => 2), array('id' => 3, 'value' => 3), array('id' => 4, 'value' => 4), array('id' => 5, 'value' => 5));
        $ReviewRating    = DB::table('review_ratings')->select('order_id')->get();
        $OrderId = [];
        foreach($ReviewRating as $value){
            $OrderId[] = $value->order_id;
        }
        $this->data['orderIds'] =  DB::table('orders')->select('id','order_number')->whereNotIn('id',$OrderId)->get();

        return view('admin.reviews.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReviewRequest $request)
    {
        $formData = $request->all();
        if (ReviewRating::create($formData)) {
            Session::flash('message','Reviews Added Successfully');
        }
        return redirect()->to('admin/reviews');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $this->data['review']        = ReviewRating::findOrFail($id);
        $this->data['mode']         = 'edit';
        $this->data['headline']     = 'Update Review';
        $this->data['orderIds'] = [];
        $this->data['ratings']     = array(array('id' => 1, 'value' => 1), array('id' => 2, 'value' => 2), array('id' => 3, 'value' => 3), array('id' => 4, 'value' => 4), array('id' => 5, 'value' => 5));
        return view('admin.reviews.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReviewRequest $request, $id)
    {
        $review          = ReviewRating::find($id);
        $updateReviewRating    = DB::table('review_ratings')->where('id', $id)->update(array('comments' => $request->get('comments'),'star_rating' => $request->get('star_rating')));
        if ($updateReviewRating) {
            Session::flash('message Updated Successfully');
        }
        return redirect()->to('admin/reviews');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (ReviewRating::find($id)->delete()) {
            Session::flash('message', 'ReviewRating Deleted Successfully');
        }
        return redirect()->to('admin/reviews'); 
    }
}
