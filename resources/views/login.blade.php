@extends('layout')

@section('page-title')
<title>Đăng nhập</title>
@endsection

@section('content')
<div class="login">
    <section class="vh-100 bg-image" style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card form-login" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">ĐĂNG NHẬP</h2>
                                <!-- Thông báo lỗi nếu user nhập đường link truy cập vào trang admin -->
                                @if (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                                @endif

                                <form action="{{route('loginUser')}}" method="post">
                                    @csrf
                                    @if(Session::has('success'))
                                    <div class="alert alert-success">{{Session::get('success')}}</div>
                                    @endif
                                    @if(Session::has('fail'))
                                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                                    @endif
                                    <div class="form-outline mb-4">
                                        <input type="text" id="form3Example3cg" class="form-control form-control-lg form-textinput" name="email" value="{{old('email')}}" />
                                        <label class="form-label" for="form3Example3cg">Email</label><br>
                                        <span class="text-danger">@error('email') {{$message}} @enderror</span>
                                    </div>

                                    <div class="form-outline mb-3">
                                        <input type="password" id="form3Example4cg" class="form-control form-control-lg form-textinput" name="password" />
                                        <label class="form-label" for="form3Example4cg">Mật khẩu</label><br>
                                        <span class="text-danger">@error('password') {{$message}} @enderror</span>
                                    </div>

                                    <div class="autologin">
                                        <input type="checkbox" class="checkbox_autologin" name="remember" value="remember">
                                        <label for="">Ghi nhớ tài khoản?</label>

                                    </div>

                                    <div class="forgetpassword">
                                        <a href="{{route('forget.password')}}">Quên mật khẩu</a>
                                    </div>

                                    <br><br>

                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-success btn-block gradient-custom-4 text-body btn-login" name="dangnhap" value="Đăng nhập">Đăng
                                            nhập</button>
                                    </div>

                                    <p class="text-center text-muted mb-0 registerhere">Chưa có tài khoản? <a href="register" class="fw-bold text-body"><u>Đăng
                                                ký</u></a></p>

                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection