@extends('layout.client.default')
@push('styles')
<style>
    .quantity {
        width: 50px;
        border: solid 1px #C9C9C9;
        border-radius: 5px;
        text-align: center;
    }
</style>
@endpush
@section('main')
<main class="main-content">
    <!--== Start Page Header Area Wrapper ==-->
    <div class="page-header-area" data-bg-img="https://www.shutterstock.com/image-photo/panoramic-abstract-blue-background-product-260nw-2500946363.jpg">
        <div class="container pt--0 pb--0">
            <div class="row">
                <div class="col-12">
                    <div class="page-header-content">
                        <h2 class="title" data-aos="fade-down" data-aos-duration="1000">Shopping Cart</h2>
                        <nav class="breadcrumb-area" data-aos="fade-down" data-aos-duration="1200">
                            <ul class="breadcrumb">
                                <li><a href="index.html">Home</a></li>
                                <li class="breadcrumb-sep">//</li>
                                <li>Giỏ hàng</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--== End Page Header Area Wrapper ==-->

    <!--== Start Blog Area Wrapper ==-->
    @if($cart)
    <section class="shopping-cart-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart-form table-responsive">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th class="product-remove">&nbsp;</th>
                                    <th class="product-thumb">&nbsp;</th>
                                    <th class="product-name">Sản phẩm</th>
                                    <th class="">Màu</th>
                                    <th class="product-price">Giá tiền</th>
                                    <th class="product-quantity">Số lượng</th>
                                    <th class="product-subtotal">Thành tiền</th>
                                </tr>
                            </thead>
                            <form action="{{ route('product.updateCart') }}" method="post">
                                @method('patch')
                                @csrf
                                <tbody>
                                    @php
                                        if ($totalPrice !== null) {
                                            $tongTien = $totalPrice;
                                        } else {
                                            $tongTien = 0;
                                        }
                                        @endphp
                                    @foreach($cart->cartDetail as $key => $value)
                                    <tr class="cart-product-item">
                                        <td class="product-remove">
                                            <button style="border: none; background: none;" type="button" data-bs-toggle="modal" data-bs-target="#modelDelete" data-cartdetail-id="{{ $value->id }}">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                        </td>
                                        <td class="product-thumb">
                                            <a href="#">
                                                <img src="{{ Storage::url($value->variant->image) }}" width="90" height="110" alt="Lỗi ảnh">
                                            </a>
                                        </td>
                                        <td class="product-name">
                                            <h4 class="title"><a href="#">{{ $value->variant->product->name }}</a></h4>
                                        </td>
                                        <td class="">
                                            <span class="price">{{ $value->variant->color }}</span>
                                        </td>
                                        @php
                                        $price_khuyen_mai = $value->variant->price_khuyen_mai;
                                        $price = $value->variant->price;
                                        @endphp
                                        @if($price_khuyen_mai > 0)
                                        <td class="product-price">
                                            <span class="price" style="color: red;">{{ number_format($price_khuyen_mai, 0, ',', '.') }}đ</span>
                                            <br>
                                            <span class="price" style="text-decoration: line-through; font-size: 13px; color: gray">{{ number_format($price, 0, ',', '.') }}đ</span>
                                        </td>
                                        @else
                                        <td class="product-price">
                                            <span class="price" style="color: red;">{{ number_format($price, 0, ',', '.') }}đ</span>
                                        </td>
                                        @endif
                                        <td class="product-quantity">
                                            <div class="">
                                                <input type="hidden" value="{{ $value->id }}" name="cartDetailId[]">
                                                <input type="number" class="quantity" title="Quantity" value="{{ $value->quantity }}" name="quantity[]" min="1">
                                            </div>
                                        </td>
                                        <td class="product-subtotal">
                                            @php
                                                $thanhTien = 0;
                                                if($price_khuyen_mai > 0){
                                                    $thanhTien = intval($price_khuyen_mai) * intval($value->quantity);
                                                }
                                                else{
                                                    $thanhTien = intval($price) * intval($value->quantity);
                                                }

                                                $tongTien += $thanhTien;
                                            @endphp

                                            <span class="price">{{ number_format($thanhTien, 0, ',', '.') }}đ</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr class="actions">
                                        <td class="border-0" colspan="7">
                                            <button type="submit" class="update-cart">Cập nhật</button>
                                            <button type="submit" class="clear-cart" disabled>Xóa giỏ hàng</button>
                                            <a href="" class="btn-theme btn-flat">Mua sắm</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </form>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row row-gutter-50">
                
                <div class="col-md-12 col-lg-4">
                    <div class="shipping-form-cart-totals">
                        <div class="section-title-cart">
                            <h5 class="title">Thông tin đơn hàng</h5>
                        </div>
                        <div class="cart-total-table">
                            <table class="table">
                                <tbody>
                                    <tr class="cart-subtotal">
                                        <td>
                                            <p class="value">Tổng tiền</p>
                                        </td>
                                        <td>
                                            <p class="price">{{ number_format($totalPrice, 0, ',', '.') }}đ</p>
                                        </td>
                                    </tr>
                                    <tr class="shipping">
                                        <td>
                                            <p class="value">Phí ship</p>
                                        </td>
                                        <td>
                                            <ul class="shipping-list">
                                                <!-- <li class="radio">
                                                    <input type="radio" name="shipping" id="radio1" checked>
                                                    <label for="radio1"><span></span> Flat Rate</label>
                                                </li> -->
                                                <li class="radio">
                                                    <input type="radio" name="shipping" id="radio2">
                                                    <label for="radio2"><span></span> Free Shipping</label>
                                                </li>
                                                <!-- <li class="radio">
                                                    <input type="radio" name="shipping" id="radio3">
                                                    <label for="radio3"><span></span> Local Pickup</label>
                                                </li> -->
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr class="order-total">
                                        <td>
                                            <p class="value">Cần thanh toán</p>
                                        </td>
                                        <td>
                                            <p class="price">{{ number_format($totalPrice, 0, ',', '.') }}đ</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <a class="btn-theme btn-flat" href="">Thanh toán</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @else

    <section class="shopping-cart-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart-form table-responsive">
                        <form action="#" method="post">
                            <table class="table text-center">
                                <thead>
                                </thead>
                                <tbody>
                                    <h3>Chưa có sản phẩm nào trong giỏ hàng</h3>
                                    <span>Hãy nhấn vào nút bên dưới để mua sản phẩm nhé!</span>
                                    <tr class="actions">
                                        <td class="border-0" colspan="6">
                                            <!-- <button type="submit" class="clear-cart"></button> -->
                                            <a href="" class="btn-theme btn-flat">Mua sắm</a>
                                        </td>
                                        <td class="border-0" style="margin-right: 0">
                                            <img src="https://fptshop.com.vn/img/empty_cart.png?w=1920&q=100" width="600px" height="500px" style="margin-left: 420px; margin-top: -100px">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
    @endif
    <!--== End Blog Area Wrapper ==-->
</main>

<!-- Modal -->
<div class="modal fade" id="modelDelete" tabindex="-1" aria-labelledby="modelDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelDeleteLabel">Thông báo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('product.deleteCart') }}" method="post">
                @method('delete')
                @csrf
                <input type="hidden" value="" id="inputCartDetailId" name="cartDetailId">
                <div class="modal-body">
                    <span class="text-danger">Bạn có muốn xóa không?</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Xác nhận xóa</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    var modelDelete = document.getElementById('modelDelete')
    modelDelete.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget
        var cartDetailId = button.getAttribute('data-cartdetail-id')
        console.log(cartDetailId);
        document.getElementById("inputCartDetailId").value = cartDetailId
    })
</script>
@endpush