@extends('layout')

@section('content')
<main>
    <div>
        <div class="mt-5">
            @if($errors->any())
            <div class="col-12"></div>
            @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{$error}}</div>
            @endforeach
        </div>
        @endif

        @if(session()->has('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
        @endif

        @if(session()->has('success'))
        <div class="alert alert-success">{{session('success')}}</div>
        @endif
    </div>
    <p class="reset_password_alert">Hãy nhập đầy đủ thông tin bên dưới để khôi phục lại tài khoản của bạn.</p>
    <form action="{{route('reset.password.post')}}" method="post">
        @csrf
        <input type="text" name="token" hidden value="{{$token}}">
        <div class="form-outline mb-4 reset_password_form"><br>
            <b><label class="form-label" for="form3Example3cg">Email</label></b><br>
            <input type="text" id="form3Example3cg" class="form-control form-control-lg form-textinput reset_password_emailinput" name="email" value="" />
        </div>
        <div class="form-outline mb-4 reset_password_form"><br>
            <b><label class="form-label" for="form3Example3cg">Nhập mật khẩu mới</label></b><br>
            <input type="password" id="form3Example3ce" class="form-control form-control-lg form-textinput reset_password_emailinput" name="password" value="" onchange="check_pass()"/>
        </div>
        <div class="form-outline mb-4 reset_password_form"><br>
            <b><label class="form-label" for="form3Example3cg">Xác nhận mật khẩu mới</label></b><br>
            <input type="password" id="form3Example3cf" class="form-control form-control-lg form-textinput reset_password_emailinput" name="confirm_password" value="" onchange="check_pass()"/>
        </div>

        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-success btn-block gradient-custom-4 text-body btn-login" name="dangnhap" value="Đăng nhập">Đăng
                nhập</button>
        </div>

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
    </script>
    </div>
</main>
@endsection