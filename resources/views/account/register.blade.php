@extends('layout.client.default')
@section('main')
<main class="main-content">
    <!--== Start Page Header Area Wrapper ==-->
    <div class="page-header-area" data-bg-img="https://www.shutterstock.com/image-photo/panoramic-abstract-blue-background-product-260nw-2500946363.jpg">
      <div class="container pt--0 pb--0">
        <div class="row">
          <div class="col-12">
            <div class="page-header-content">
              <h2 class="title" data-aos="fade-down" data-aos-duration="1000">Đăng ký</h2>
              <nav class="breadcrumb-area" data-aos="fade-down" data-aos-duration="1200">
                <ul class="breadcrumb">
                  <li><a href="index.html">Home</a></li>
                  <li class="breadcrumb-sep">//</li>
                  <li>Đăng ký</li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--== End Page Header Area Wrapper ==-->

    <!--== Start My Account Area Wrapper ==-->
    <section class="account-area">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 m-auto">
            <div class="section-title text-center">
              <h2 class="title">Đăng ký</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="register-form-content">
              <form action="{{ route('postRegister') }}" method="post">
                @csrf
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="username">Họ và tên <span class="required">*</span></label>
                      <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                      @error('name')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label for="email">Email <span class="required">*</span></label>
                      <input class="form-control" type="email" name="email" value="{{ old('email') }}">
                      @error('email')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label for="">SĐT <span class="required">*</span></label>
                      <input class="form-control" type="text" name="phone" value="{{ old('phone') }}">
                      @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label for="password">Mật khẩu <span class="required">*</span></label>
                      <input id="password" class="form-control" type="password" name="password">
                      @error('password')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label for="password">Nhập lại mật khẩu <span class="required">*</span></label>
                      <input id="password" class="form-control" type="password" name="nhapLaiPassword">
                      @error('nhapLaiPassword')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label for="">Địa chỉ <span class="required">*</span></label>
                      <input class="form-control" type="text" name="address" value="{{ old('address') }}">
                      @error('address')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
          
                  <div class="col-12">
                    <div class="form-group mb--0">
                      <button class="btn-register" type="submit">Đăng ký</button>
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