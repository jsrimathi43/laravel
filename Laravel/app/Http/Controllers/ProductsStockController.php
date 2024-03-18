<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsStockController extends Controller
{
    public function index()
    {
    	$this->data['products'] = Product::where('has_stock', 1)->get();

    	return view('admin.products.stocks', $this->data);
    }
}