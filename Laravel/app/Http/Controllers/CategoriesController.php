<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $this->data['categories'] = Category::all();
        $this->data['category'] = DB::table('categories as t1')->select('t2.*','t1.title as categoryTitle')->rightJoin('categories AS t2', 't2.parent_id', '=', 't1.id')->get();
        return view('admin.category.categories', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $this->data['headline'] = "Add New Category";
        $this->data['mode']         = 'create';
        $this->data['categories'] = Category::where('parent_id', null)->orderby('title', 'asc')->get();
        $this->data['category']         = '';
        return view('admin.category.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
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
        if( Category::create($formData) ) {
            Session::flash('message', $formData['title'] . ' Added Successfully');
        }
        return redirect()->to('admin/categories');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $this->data['category']         = Category::findOrFail($id);
        $this->data['mode']         = 'edit';
        $this->data['headline']     = 'Update Category';
        $this->data['categories'] = Category::where('parent_id', null)->orderby('title', 'asc')->get();
        return view('admin.category.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category           = Category::find($id);
        $category->title    = $request->get('title');
        $category->route    = $request->get('route');
        $category->parent_id= $request->get('parent_id');
        if ($image = $request->file('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            ]);
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $category->image = "$profileImage";
        }
        if( $category->save() ) {
            Session::flash('message', $category->title.'Updated Successfully');
        }
        
        return redirect()->to('admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if( Category::find($id)->delete() ) {
            Session::flash('message', 'Category Deleted Successfully');
        }
        return redirect()->to('admin/categories');
    }
}