<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Variant;
use App\Models\Category;
use App\Models\Cart;
use App\Models\CartDetail;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function detailProduct($id, Request $request)
    {
        // $showComment = Comment::where('product_id', $id)
        // ->where('status', '=', '1')
        // ->get();
        $product = Product::with('variant')
            ->findOrFail($id);
        $variant = Variant::with('images');
        $variantId = $request->input('variant_id');
        if ($variantId) {
            $colorVariant = $product->variant->firstWhere('id', $variantId);
        } else {
            $colorVariant = $product->variant->first();
        }

        return view('client.detail')->with([
            'product' => $product,
            'colorVariant' => $colorVariant,
            'variant' => $variant,
            // 'showComment' => $showComment
        ]);
    }

    
    // Cart

    public function addToCart(Request $request)
    {
        $cart = Cart::where('user_id', Auth::id());
        if ($cart->exists()) {
            // Đã có giỏ hàng => Cập nhật Cart detail
            $cart = $cart->first();
            $cartDetail = CartDetail::where('cart_id', $cart->id)->where('variant_id', $request->variant_id);
            if ($cartDetail->exists()) {
                // User đã mua sản phẩm này và có trong giỏ hàng rồi
                // Và khi mua lại sản phẩm có id variant và user thì phần quantity trong cart sẽ cập nhật lại
                $cartDetail->update([
                    'quantity' => intval($cartDetail->first()->quantity) + intval($request->quantity)
                ]);
            } else {
                // Sản phẩm chưa được mua và sẽ được tạo mới
                CartDetail::create([
                    'cart_id' => $cart->id,
                    'variant_id' => $request->variant_id,
                    'quantity' => $request->quantity
                ]);
            }
        } else {
            // Tạo giỏ hàng => Tạo cart detail
            $newCart = Cart::create([
                'user_id' => Auth::id()
            ]);

            CartDetail::create([
                'cart_id' => $newCart->id,
                'variant_id' => $request->variant_id,
                'quantity' => $request->quantity
            ]);
        }
        

        return redirect()->route('product.viewCart');
    }

    public function tinhTien($cart)
    {
        $totalPrice = 0;
        

        if ($cart && $cart->cartDetail) {
            foreach ($cart->cartDetail as $cartDetail) {
                $variant = $cartDetail->variant;
                $quantity = $cartDetail->quantity;

                // Sử dụng giá khuyến mãi nếu có
                $price = $variant->price;
                $price_khuyen_mai = $variant->price_khuyen_mai > 0 ? $variant->price_khuyen_mai : $price;

                // Cộng dồn vào tổng tiền
                $totalPrice += $price_khuyen_mai * $quantity;
            }
        }

        return $totalPrice;
    }

    public function viewCart()
    {
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())
                ->with('cartDetail:id,cart_id,variant_id,quantity')
                ->with('cartDetail.variant:id,price,price_khuyen_mai,color')
                ->with('cartDetail.variant.product:id,name')
                ->first();

            // Tính tổng tiền giỏ hàng
            $totalPrice = $this->tinhTien($cart);
        } else {
            $cart = null;
            $totalPrice = 0;  // Nếu không có giỏ hàng
        }

        return view('client.cart')->with([
            'cart' => $cart,
            'totalPrice' => $totalPrice
        ]);
    }

    public function updateCart(Request $request)
    {
        foreach ($request->cartDetailId as $key => $cartDetailId) {
            CartDetail::find($cartDetailId)->update([
                'quantity' => $request->quantity[$key]
            ]);
        }

        $cart = Cart::where('user_id', Auth::id())
            ->with('cartDetail.variant')
            ->first();

        $totalPrice = $this->tinhTien($cart);

        return redirect()->back()->with([
            'totalPrice' => $totalPrice
        ]);
    }

    public function deleteCart(Request $request)
    {
        $cartDetail = CartDetail::find($request->cartDetailId);
        if ($cartDetail) {
            $cartDetail->delete();  // Sử dụng phương thức delete() để xóa
        }
        return redirect()->back();
    }

}
