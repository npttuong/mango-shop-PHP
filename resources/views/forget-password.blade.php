@extends('layout')

@section('content')
  <main>
    <div>
      <div class="mt-5">
        @if ($errors->any())
          <div class="col-12"></div>
          @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
          @endforeach
      </div>
      @endif

      @if (session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
      @endif

      @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif
    </div>
    <p class="reset_password_alert">Chúng tôi sẽ gửi đường dẫn đến email của bạn, hãy sử dụng đường dẫn đó để khôi phục mật
      khẩu.</p>
    <form action="{{ route('forget.password.post') }}" method="post">
      @csrf
      <div class="form-outline mb-4 reset_password_form"><br>
        <b><label class="form-label" for="form3Example3cg">Email</label></b><br>
        <input type="text" id="form3Example3cg"
          class="form-control form-control-lg form-textinput reset_password_emailinput" name="email" value="" />
      </div>

      <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-success btn-block gradient-custom-4 text-body btn-login"
          name="resetpassword" value="">Thay đổi mật khẩu</button>
      </div>

    </form>
    </div>
  </main>
@endsection
