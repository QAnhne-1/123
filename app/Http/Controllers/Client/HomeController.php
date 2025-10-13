<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Variant;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        $products = Product::with('variant')->get();
        $newProduct = Product::orderBy('created_at','DESC')->take(6)->get();
        $khuyenMaiProduct = Product::whereHas('variant', function ($query) {
            $query->where('price_khuyen_mai', '>', 0);
        })->take(4)->get();
        
        return view('client.index')->with([
            'products' => $products,
            'newProduct' => $newProduct,
            'khuyenMaiProduct' => $khuyenMaiProduct,
        ]);
    }
}
