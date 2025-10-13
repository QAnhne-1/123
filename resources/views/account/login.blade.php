@extends('layout.client.default')
@section('main')
{{-- start page header area wrapper --}}
<div class="page-header-area"
    data-bg-img="https://www.shutterstock.com/image-photo/panoramic-abstract-blue-background-product-260nw-2500946363.jpg">
    <div class="container pt--0 pb--0">
        <div class="row">
            <div class="col-12">
                <div class="page-header-content">
                    <h2 class="title" data-aos="fade-down" data-aos-duration="1000">Login</h2>
                    <nav class="breadcrumb-area" data-aos="fade-down" data-aos-duration="1200">
                        <ul class="breadcrumb">
                            <li><a href="index.html">Home</a></li>
                            <li class="breadcrumb-sep">//</li>
                            <li>Đăng nhập</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- End page header area wrapper --}}

{{-- Start my account area wrapper --}}
<section class="account-area">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 m-auto">
                <div class="section-title text-center">
                    <h2 class="title">Đăng nhập</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="login-form-content">
                    <form action="{{ route('postLogin') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="username">SĐT đăng nhập <span class="required">*</span></label>
                                    <input class="form-control" type="text" name="phone" value="{{ old('phone') }}">
                                    @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="password">Mật khẩu <span class="required">*</span></label>
                                    <input id="password" class="form-control" type="password" name="password">
                                    @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @if(session('messageError'))
                            <span class="text-danger">{{ session('messageError') }}</span>
                            @endif
                            <div class="col-12">
                                <div class="form-group">
                                    <!-- <a class="btn-login" href="account.html">Login</a> -->
                                    <button class="btn-login" type="submit">Đăng nhập</button> 
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group account-info-group mb--0">
                                    <!-- <div class="rememberme-account">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">Lưu lại</label>
                                        </div>
                                    </div> -->
                                    <a class="lost-password" href="{{ route('register') }}">Đăng ký tài khoản</a>
                                    <a class="lost-password" href="#/">Quên mật khẩu?</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--== End My Account Area Wrapper ==-->
</main>
@endsection