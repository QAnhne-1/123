@extends('layout.client.default')
@push('styles')
<style>
  .btn-info {
    width: 80px;
    height: 30px;
    margin-right: 3px;
    font-size: clamp(5px, 2vw, 15px);
    /* Kích thước chữ sẽ thay đổi linh hoạt trong khoảng 10px đến 16px */
    white-space: nowrap;
    /* Ngăn chữ xuống dòng */
    text-align: center;
    /* Căn giữa chữ */
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #b3b3b3;
    color: white;
    border: none;
  }

  .btn-info:hover {
    background-color: #757575;
    color: white;
  }
</style>
@endpush
@section('main')
<main class="main-content">
  <!--== Start Page Header Area Wrapper ==-->
  <div class="page-header-area" data-bg-img="https://img.freepik.com/free-photo/laptop-office-plant-black-background-top-view_169016-34505.jpg">
    <div class="container pt--0 pb--0">
      <div class="row">
        <div class="col-12">
          <div class="page-header-content">
            <h2 class="title" data-aos="fade-down" data-aos-duration="1000">Product Details</h2>
            <nav class="breadcrumb-area" data-aos="fade-down" data-aos-duration="1200">
              <ul class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li class="breadcrumb-sep">//</li>
                <li>Product Details</li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--== End Page Header Area Wrapper ==-->

  <!--== Start Product Single Area Wrapper ==-->
  <section class="product-area product-single-area">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="product-single-item">
            <div class="row">
              <div class="col-xl-6">
                <!--== Start Product Thumbnail Area ==-->
                <div class="product-single-thumb">
                  <div class="swiper-container single-product-thumb single-product-thumb-slider">
                    <div class="swiper-wrapper">
                      <div class="swiper-slide">
                        <a class="lightbox-image" data-fancybox="gallery" href="{{ Storage::url($colorVariant->image) }}">
                          <img src="{{ Storage::url($colorVariant->image) }}" width="570" height="541" alt="Image-HasTech">
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-container single-product-nav single-product-nav-slider">
                    <div class="swiper-wrapper">
                      @foreach($product->variant as $variant)
                      <div class="swiper-slide">
                        <img src="{{ Storage::url($variant->image) }}" width="127" height="127" alt="Image-HasTech">
                      </div>
                      @endforeach
                    </div>
                  </div>
                </div>
                <!--== End Product Thumbnail Area ==-->
              </div>
              <div class="col-xl-6">
                <!--== Start Product Info Area ==-->
                <div class="product-single-info">
                  <h3 class="main-title">{{ $product->name }}</h3>
                  @php
                  $variant = $colorVariant;
                  @endphp
                  <div class="prices">
                    @if($variant->price_khuyen_mai > 0)
                    <div>
                      <span class="price">{{ number_format($variant->price_khuyen_mai, 0, ',', '.') }}đ</span>
                    </div>
                    <span class="price" style="font-size: 18px; text-decoration: line-through; color: grey; font-weight: 300; ">{{ number_format($variant->price, 0, ',', '.') }}đ</span>
                    <span class="price" style="font-size: 18px; color: red; font-weight: 300; ">{{ number_format(($product->variant->first()->price - $product->variant->first()->price_khuyen_mai) / $product->variant->first()->price * 100), 0, ',', '.' }}%</span>
                    @else
                    <span class="price">{{ number_format($variant->price, 0, ',', '.') }}đ</span>
                    @endif
                  </div>
                  <div class="rating-box-wrap">
                    <div class="rating-box">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                    </div>
                    <div class="review-status">
                      <a href="javascript:void(0)">(5 Customer Review)</a>
                    </div>
                  </div>
                  <p></p>

                  <!-- Color -->
                  <div class="product-color">
                    <h6 class="title">Màu sắc</h6>
                    @foreach($product->variant as $variant)
                    <form action="{{ route('product.detailProduct', ['id' => $product->id, 'variant_id' => $variant->id]) }}" method="post">
                      @csrf
                      <input type="hidden" name="variant_id" value="{{ $variant->id }}">
                      <button type="submit" class="btn btn-info" style="width:80px ; height:30px">{{ $variant->color }}</button>
                    </form>
                    @endforeach

                  </div>
                  <!-- Color -->

                  @if($colorVariant->status == 1)
                  <form action="{{ route('product.addToCart') }}" method="post">
                    @csrf
                    <input type="hidden" name="variant_id" value="{{ $colorVariant->id }}">
                    <div class="product-quick-action">
                      <div class="qty-wrap">
                        <div class="pro-qty">
                          <input type="text" title="Quantity" value="1" name="quantity">
                        </div>
                      </div>
                      <button class="btn-theme">Add to Cart</button>
                    </div>
                  </form>
                  @else
                  <span class="text-danger">Dừng bán</span>
                  @endif


                  <div class="product-wishlist-compare">
                    <a href="shop-wishlist.html"><i class="pe-7s-like"></i>Add to Wishlist</a>
                    <a href="shop-compare.html"><i class="pe-7s-shuffle"></i>Add to Compare</a>
                  </div>
                  <div class="product-info-footer">
                    <h6 class="code"><span>Code :</span>Ch-256xl</h6>
                    <div class="social-icons">
                      <span>Share</span>
                      <a href="#/"><i class="fa fa-facebook"></i></a>
                      <a href="#/"><i class="fa fa-dribbble"></i></a>
                      <a href="#/"><i class="fa fa-pinterest-p"></i></a>
                    </div>
                  </div>
                </div>
                <!--== End Product Info Area ==-->
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="product-review-tabs-content">
            <ul class="nav product-tab-nav" id="ReviewTab" role="tablist">
              <li role="presentation">
                <a class="active" id="information-tab" data-bs-toggle="pill" href="#information" role="tab" aria-controls="information" aria-selected="true">Information</a>
              </li>
              <li role="presentation">
                <a id="description-tab" data-bs-toggle="pill" href="#description" role="tab" aria-controls="description" aria-selected="false">Description</a>
              </li>
              <li role="presentation">
                <a id="reviews-tab" data-bs-toggle="pill" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Bình luận <span>(05)</span></a>
              </li>
            </ul>
            <div class="tab-content product-tab-content" id="ReviewTabContent">
              <div class="tab-pane fade show active" id="information" role="tabpanel" aria-labelledby="information-tab">
                <div class="product-information">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim adlo minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in tun tuni reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserun mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rel aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur.</p>
                </div>
              </div>
              <div class="tab-pane fade" id="description" role="tabpanel" aria-labelledby="description-tab">
                <div class="product-description">
                  <p>{{ $product->description }}</p>
                </div>
              </div>
              <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                <div class="product-review-content">
                  <div class="review-content-header">
                    <h3>Đánh giá của khách hàng</h3>
                    <div class="review-info">
                      <ul class="review-rating">
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star-o"></li>
                      </ul>
                      <span class="review-caption">Based on 5 reviews</span>
                      <span class="review-write-btn">Viết đánh giá</span>
                    </div>
                  </div>

                  <!--== Start Reviews Form Item ==-->
                  <div class="reviews-form-area">
                    <h4 class="title">Viết đánh giá</h4>
                    <div class="reviews-form-content">
                      <!-- Form bình luận -->
                      <form action="" method="post">
                        @csrf
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <input type="hidden" value="{{ $product->id }}" name="product_id">
                              <label for="for_comment">Nội dung</label>
                              <textarea id="for_comment" class="form-control" placeholder="Write your comments here" name="content"></textarea>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-submit-btn">
                              <button type="submit" class="btn-submit">Đăng bình luận</button>
                            </div>
                          </div>
                        </div>
                      </form>
                      <!-- Form bình luận -->
                    </div>
                  </div>
                  <!--== End Reviews Form Item ==-->

                  <div class="reviews-content-body">
                    <!--== Start Reviews Content Item ==-->
                    
                    <!--== End Reviews Content Item ==-->
                  </div>

                  <!--== Start Reviews Pagination Item ==-->
                  <div class="review-pagination">
                    <span class="pagination-pag">1</span>
                    <span class="pagination-pag">2</span>
                    <span class="pagination-next">Next »</span>
                  </div>
                  <!--== End Reviews Pagination Item ==-->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--== End Product Single Area Wrapper ==-->

  <!--== Start Product Area Wrapper ==-->
  <section class="product-area product-best-seller-area">
    <div class="container pt--0">
      <div class="row">
        <div class="col-12">
          <div class="section-title text-center">
            <h3 class="title">Related Products</h3>
            <div class="desc">
              <p>There are many variations of passages of Lorem Ipsum available</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="product-slider-wrap">
            <div class="swiper-container product-slider-col4-container">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <!--== Start Product Item ==-->
                  <div class="product-item">
                    <div class="inner-content">
                      <div class="product-thumb">
                        <a href="single-product.html">
                          <img src="assets/img/shop/1.webp" width="270" height="274" alt="Image-HasTech">
                        </a>
                        <div class="product-flag">
                          <ul>
                            <li class="discount">-10%</li>
                          </ul>
                        </div>
                        <div class="product-action">
                          <a class="btn-product-wishlist" href="shop-wishlist.html"><i class="fa fa-heart"></i></a>
                          <a class="btn-product-cart" href="shop-cart.html"><i class="fa fa-shopping-cart"></i></a>
                          <button type="button" class="btn-product-quick-view-open">
                            <i class="fa fa-arrows"></i>
                          </button>
                          <a class="btn-product-compare" href="shop-compare.html"><i class="fa fa-random"></i></a>
                        </div>
                        <a class="banner-link-overlay" href="shop.html"></a>
                      </div>
                      <div class="product-info">
                        <div class="category">
                          <ul>
                            <li><a href="shop.html">Men</a></li>
                            <li class="sep">/</li>
                            <li><a href="shop.html">Women</a></li>
                          </ul>
                        </div>
                        <h4 class="title"><a href="single-product.html">Modern Smart Shoes</a></h4>
                        <div class="prices">
                          <span class="price-old">$300</span>
                          <span class="sep">-</span>
                          <span class="price">$240.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--== End prPduct Item ==-->
                </div>
                <div class="swiper-slide">
                  <!--== Start Product Item ==-->
                  <div class="product-item">
                    <div class="inner-content">
                      <div class="product-thumb">
                        <a href="single-product.html">
                          <img src="assets/img/shop/7.webp" width="270" height="274" alt="Image-HasTech">
                        </a>
                        <div class="product-action">
                          <a class="btn-product-wishlist" href="shop-wishlist.html"><i class="fa fa-heart"></i></a>
                          <a class="btn-product-cart" href="shop-cart.html"><i class="fa fa-shopping-cart"></i></a>
                          <button type="button" class="btn-product-quick-view-open">
                            <i class="fa fa-arrows"></i>
                          </button>
                          <a class="btn-product-compare" href="shop-compare.html"><i class="fa fa-random"></i></a>
                        </div>
                        <a class="banner-link-overlay" href="shop.html"></a>
                      </div>
                      <div class="product-info">
                        <div class="category">
                          <ul>
                            <li><a href="shop.html">Men</a></li>
                            <li class="sep">/</li>
                            <li><a href="shop.html">Women</a></li>
                          </ul>
                        </div>
                        <h4 class="title"><a href="single-product.html">Quickiin Mens shoes</a></h4>
                        <div class="prices">
                          <span class="price">$240.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--== End prPduct Item ==-->
                </div>
                <div class="swiper-slide">
                  <!--== Start Product Item ==-->
                  <div class="product-item">
                    <div class="inner-content">
                      <div class="product-thumb">
                        <a href="single-product.html">
                          <img src="assets/img/shop/3.webp" width="270" height="274" alt="Image-HasTech">
                        </a>
                        <div class="product-flag">
                          <ul>
                            <li class="discount">-10%</li>
                          </ul>
                        </div>
                        <div class="product-action">
                          <a class="btn-product-wishlist" href="shop-wishlist.html"><i class="fa fa-heart"></i></a>
                          <a class="btn-product-cart" href="shop-cart.html"><i class="fa fa-shopping-cart"></i></a>
                          <button type="button" class="btn-product-quick-view-open">
                            <i class="fa fa-arrows"></i>
                          </button>
                          <a class="btn-product-compare" href="shop-compare.html"><i class="fa fa-random"></i></a>
                        </div>
                        <a class="banner-link-overlay" href="shop.html"></a>
                      </div>
                      <div class="product-info">
                        <div class="category">
                          <ul>
                            <li><a href="shop.html">Men</a></li>
                            <li class="sep">/</li>
                            <li><a href="shop.html">Women</a></li>
                          </ul>
                        </div>
                        <h4 class="title"><a href="single-product.html">Rexpo Womens shoes</a></h4>
                        <div class="prices">
                          <span class="price-old">$300</span>
                          <span class="sep">-</span>
                          <span class="price">$240.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--== End prPduct Item ==-->
                </div>
                <div class="swiper-slide">
                  <!--== Start Product Item ==-->
                  <div class="product-item">
                    <div class="inner-content">
                      <div class="product-thumb">
                        <a href="single-product.html">
                          <img src="assets/img/shop/4.webp" width="270" height="274" alt="Image-HasTech">
                        </a>
                        <div class="product-action">
                          <a class="btn-product-wishlist" href="shop-wishlist.html"><i class="fa fa-heart"></i></a>
                          <a class="btn-product-cart" href="shop-cart.html"><i class="fa fa-shopping-cart"></i></a>
                          <button type="button" class="btn-product-quick-view-open">
                            <i class="fa fa-arrows"></i>
                          </button>
                          <a class="btn-product-compare" href="shop-compare.html"><i class="fa fa-random"></i></a>
                        </div>
                        <a class="banner-link-overlay" href="shop.html"></a>
                      </div>
                      <div class="product-info">
                        <div class="category">
                          <ul>
                            <li><a href="shop.html">Men</a></li>
                            <li class="sep">/</li>
                            <li><a href="shop.html">Women</a></li>
                          </ul>
                        </div>
                        <h4 class="title"><a href="single-product.html">Leather Mens Slipper</a></h4>
                        <div class="prices">
                          <span class="price">$240.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--== End prPduct Item ==-->
                </div>
                <div class="swiper-slide">
                  <!--== Start Product Item ==-->
                  <div class="product-item">
                    <div class="inner-content">
                      <div class="product-thumb">
                        <a href="single-product.html">
                          <img src="assets/img/shop/5.webp" width="270" height="274" alt="Image-HasTech">
                        </a>
                        <div class="product-action">
                          <a class="btn-product-wishlist" href="shop-wishlist.html"><i class="fa fa-heart"></i></a>
                          <a class="btn-product-cart" href="shop-cart.html"><i class="fa fa-shopping-cart"></i></a>
                          <button type="button" class="btn-product-quick-view-open">
                            <i class="fa fa-arrows"></i>
                          </button>
                          <a class="btn-product-compare" href="shop-compare.html"><i class="fa fa-random"></i></a>
                        </div>
                        <a class="banner-link-overlay" href="shop.html"></a>
                      </div>
                      <div class="product-info">
                        <div class="category">
                          <ul>
                            <li><a href="shop.html">Men</a></li>
                            <li class="sep">/</li>
                            <li><a href="shop.html">Women</a></li>
                          </ul>
                        </div>
                        <h4 class="title"><a href="single-product.html">Primitive Mens shoes</a></h4>
                        <div class="prices">
                          <span class="price-old">$300</span>
                          <span class="sep">-</span>
                          <span class="price">$240.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--== End prPduct Item ==-->
                </div>
                <div class="swiper-slide">
                  <!--== Start Product Item ==-->
                  <div class="product-item">
                    <div class="inner-content">
                      <div class="product-thumb">
                        <a href="single-product.html">
                          <img src="assets/img/shop/6.webp" width="270" height="274" alt="Image-HasTech">
                        </a>
                        <div class="product-flag">
                          <ul>
                            <li class="discount">-10%</li>
                          </ul>
                        </div>
                        <div class="product-action">
                          <a class="btn-product-wishlist" href="shop-wishlist.html"><i class="fa fa-heart"></i></a>
                          <a class="btn-product-cart" href="shop-cart.html"><i class="fa fa-shopping-cart"></i></a>
                          <button type="button" class="btn-product-quick-view-open">
                            <i class="fa fa-arrows"></i>
                          </button>
                          <a class="btn-product-compare" href="shop-compare.html"><i class="fa fa-random"></i></a>
                        </div>
                        <a class="banner-link-overlay" href="shop.html"></a>
                      </div>
                      <div class="product-info">
                        <div class="category">
                          <ul>
                            <li><a href="shop.html">Men</a></li>
                            <li class="sep">/</li>
                            <li><a href="shop.html">Women</a></li>
                          </ul>
                        </div>
                        <h4 class="title"><a href="single-product.html">Simple Fabric Shoe</a></h4>
                        <div class="prices">
                          <span class="price-old">$300</span>
                          <span class="sep">-</span>
                          <span class="price">$240.00</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--== End prPduct Item ==-->
                </div>
              </div>
            </div>
            <!--== Add Swiper Arrows ==-->
            <div class="product-swiper-btn-wrap">
              <div class="product-swiper-btn-prev">
                <i class="fa fa-arrow-left"></i>
              </div>
              <div class="product-swiper-btn-next">
                <i class="fa fa-arrow-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--== End Product Area Wrapper ==-->
</main>
@endsection