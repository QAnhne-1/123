<?php

namespace App\Http\Controllers\Admin;
use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\ProductRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class ProductController extends Controller
{
    public function listProduct() {
        $list = Product::get();
        return view('admin.product.list')->with([
            'list' => $list
        ]);
    }

    public function addProduct() {
        $category = Category::select('id', 'name')->get();
        return view('admin.product.add')->with([
            'category' => $category
        ]);
    }

    public function addPostProduct(ProductRequest $request) {
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'status' => $request->input('status')
        ];

        Product::create($data);
        return redirect()->route('admin.products.listProduct');
    }

    public function updateProduct($id) {
        $product = Product::findOrFail($id);
        $category = Category::select('id', 'name')->get();
        return view('admin.product.update')->with([
            'product' => $product,
            'category' => $category
        ]);
    }

    public function updatePutProduct(ProductRequest $request, $id) {
        $product = Product::findOrFail($id);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'status' => $request->input('status')
        ];

        if($request->input('status') == 0) {
            $product->variant()->update(['status' => '0']);
        }

        $product->update($data);
        return redirect()->route('admin.products.listProduct');
    }
}
