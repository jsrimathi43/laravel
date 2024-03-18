<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $this->data['products'] = Product::all();

        return view('admin.products.products', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $this->data['categories']   = Category::arrayForSelect();
        $this->data['mode']         = 'create';
        $this->data['headline']     = 'Add New Product';

        return view('admin.products.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);
        $formData = $request->all();
        if ($image = $request->file('image')) {

            $destinationPath = 'images/';

            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();

            $image->move($destinationPath, $profileImage);

            $formData['image'] = "$profileImage";

        }
        if( Product::create($formData) ) {
            Session::flash('message', $formData['title'] .'Product Created Successfully');
        }
        
        return redirect()->to('admin/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        $this->data['product'] = Product::find($id);

        return view('admin.products.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $this->data['product']      = Product::findOrFail($id);
        $this->data['categories']   = Category::arrayForSelect();
        $this->data['mode']         = 'edit';
        $this->data['headline']     = 'Update Product Information';

        return view('admin.products.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $data                   = $request->all();
        $product                = Product::find($id);
        $product->category_id   = $data['category_id'];
        $product->title         = $data['title'];
        $product->description   = $data['description'];
        $product->cost_price    = $data['cost_price'];
        $product->price         = $data['price'];
        $product->has_stock     = $data['has_stock'];
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);
        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $product->image = "$profileImage";
        }else{
            unset($product->image);
        }

        if( $product->save() ) {
            Session::flash('message', $product->title.'Product Updated Successfully');
        }
        
        return redirect()->to('admin/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if( Product::destroy($id) ) {
            Session::flash('message', 'Product Deleted Successfully');
        }
        
        return redirect()->to('admin/products');   
    }

    public function cart()
    {
        return view('menu/menu');
    }
  
    /**
     * Write code on Method
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
          
        $cart = session()->get('cart', []);
        
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "title" => $product->title,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }
          
        session()->put('cart', $cart);
        return redirect('/menu')->with('success', 'Product added to cart successfully!');
    }
  
    /**
     * Write code on Method
     *
     * @param  \Illuminate\Http\Request  $request
     
     */
    public function productUpdate(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }
  
    /**
     * Write code on Method
     *
     * @param  \Illuminate\Http\Request  $request
     
     */
    public function productRemove(Request $request)
    {
        // echo"test";die;
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
}