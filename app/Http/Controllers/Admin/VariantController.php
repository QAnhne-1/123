<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Variant;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\VariantRequest;

class VariantController extends Controller
{
    public function listVariant() {
        $list = Variant::get();
        return view('admin.variant.list')->with([
            'list' => $list
        ]);
    }

    public function addVariant() {
        $product = Product::select('id', 'name')->get();
        return view('admin.variant.add')->with([
            'product' => $product
        ]);
    }

    public function addPostVariant(VariantRequest $request) {
        $imagePath = "";

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $newName = time() . "." . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('imageProduct', $newName, 'public');
        }

        $data = [
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'color' => $request->color,
            'price' => $request->price,
            'image' => $imagePath,
            'price_khuyen_mai' => $request->price_khuyen_mai,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status
        ];

        Variant::create($data);
        return redirect()->route('admin.variants.listVariant');
    }

    public function updateVariant($id) {
        $variant = Variant::findOrFail($id);
        $product = Product::select('id', 'name')->get();
        return view('admin.variant.update')->with([
            'variant' => $variant,
            'product' => $product
        ]);
    }

    public function updatePutVariant(VariantRequest $request, $id) {
        $variant = Variant::findOrFail($id);

        $imagePath = $variant->image;
        if($request->hasFile('image')) {
            if($variant->image != null) {
                File::delete(public_path(Storage::url($variant->image)));
            }
            $image = $request->file('image');
            $newName = time() . "." . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('imageProduct', $newName, 'public');
        }

        $data = [
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'color' => $request->color,
            'price' => $request->price,
            'price_khuyen_mai' => $request->price_khuyen_mai,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'image' => $imagePath,
            'status' => $request->status
        ];

        $variant->update($data);
        return redirect()->route('admin.variants.listVariant');
    }

    
}
