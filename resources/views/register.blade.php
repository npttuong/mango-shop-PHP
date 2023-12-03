@extends('layout')

@section('page-title')
<title>Đăng ký</title>
@endsection

@section('content')
<div class="register">
    <section class="bg-image" style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
        <div class="mask d-flex align-items-center gradient-custom-3 register-background">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">TẠO TÀI KHOẢN MỚI</h2>

                                <form action="{{route('registerUser')}}" method="post">
                                    @if(Session::has('success'))
                                    <div class="alert alert-success">{{Session::get('success')}}</div>
                                    @endif
                                    @if(Session::has('fail'))
                                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                                    @endif

                                    @csrf

                                    <div class="form-outline mb-4">
                                        <input type="text" id="form3Example1cg" class="form-control form-control-lg form-textinput" name="username" value="{{old('username')}}" />
                                        <label class="form-label" for="form3Example1cg">Username</label><br>
                                        <span class="text-danger">@error('username') {{$message}} @enderror</span>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="text" id="form3Example3cg" class="form-control form-control-lg form-textinput" name="email" value="{{old('email')}}" />
                                        <label class="form-label" for="form3Example3cg">Email</label><br>
                                        <span class="text-danger">@error('email') {{$message}} @enderror</span>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="text" id="form3Example2cg" class="form-control form-control-lg form-textinput" name="phone_number" value="{{old('phone_number')}}" />
                                        <label class="form-label" for="form3Example2cg">Số điện thoại</label><br>
                                        <span class="text-danger">@error('phone_number') {{$message}} @enderror</span>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="text" id="form3Example1cdg" class="form-control form-control-lg form-textinput" name="city" value="{{old('city')}}" />
                                        <label class="form-label" for="form3Example1cdg">Tỉnh thành phố</label><br>
                                        <span class="text-danger">@error('city') {{$message}} @enderror</span>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="password" id="form3Example4cg" class="form-control form-control-lg form-textinput" name="password" onchange="check_pass()" />
                                        <label class="form-label" for="form3Example4cg">Mật khẩu</label><br>
                                        <span class="text-danger">@error('password') {{$message}} @enderror</span>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="password" id="form3Example4cdg" class="form-control form-control-lg form-textinput" name="confirm_password" onchange="check_pass()" />
                                        <label class="form-label" for="form3Example4cdg">Xác nhận mật khẩu</label><br>
                                        <span class="text-danger">@error('confirm_password') {{$message}} @enderror</span>
                                    </div>

                                    <div class="form-check-label">
                                        Bằng việc đăng ký, bạn đồng ý với Mango Shop về <a href="#!" class="text-body"><u>Điều khoản dịch vụ</u></a>
                                    </div><br>

                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-success btn-block gradient-custom-4 text-body btn-register" id="register">Đăng ký</button>
                                    </div>

                                    <p class="text-center text-muted mt-5 mb-0 loginhere">Đã có tài khoản? <a href="login" class="fw-bold text-body"><u>Đăng nhập</u></a></p>

                                </form>

                                <!-- Javascript -->
                                <script>
                                    // Kiểm tra mật khẩu và xác nhận mật khẩu có trùng khớp hay không
                                    function check_pass() {
                                        const password = document.querySelector('input[name=password]');
                                        const confirm_password = document.querySelector('input[name=confirm_password]');
                                        if (confirm_password.value === password.value) {
                                            confirm_password.setCustomValidity('');
                                        } else {
                                            confirm_password.setCustomValidity('Mật khẩu xác nhận không trùng khớp');
                                        }
                                    }

                                    // Reload lại trang khi nhấn nút back button của browser
                                    window.addEventListener("pageshow", function (event){
                                        var historyTraversal = event.persisted ||
                                                        ( typeof window.performance != "undefined" && window.performance.navigation.type === 2);
                                        if (historyTraversal){
                                            // Handle page restore.
                                            window.location.reload();
                                        }
                                    });
                                </script>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection