@extends('admin.layout-admin')

@section('content')
  <h2 class="mb-5 page-heading">Thêm người dùng mới</h2>
  @if (session()->has('createSuccess'))
    <div class="alert alert-success" role="alert">
      {{ session()->get('createSuccess') }}
    </div>
  @endif

  @if (session()->has('createFailed'))
    <div class="alert alert-danger" role="alert">
      {{ session()->get('createFailed') }}
    </div>
  @endif


  <form class="row g-3 fs-4" action="/admin/create-user" method="post" enctype="multipart/form-data" novalidate>
    @csrf
    <div class="col-md-6">
      <label for="inputUserName4" class="form-label">Tên người dùng:</label>
      <input type="text" class="form-control form-control-lg" id="inputUserName4" maxlength="128" name="username"
        required value="{{ old('username') }}">
      @if ($errors->has('username'))
        <div class="text--errors">
          {{ $errors->first('username') }}
        </div>
      @endif
    </div>
    <div class="col-md-6">
      <label for="inputUserEmail4" class="form-label">Email:</label>
      <input type="email" class="form-control form-control-lg" id="inputUserEmail4" maxlength="128" name="email"
        required value="{{ old('email') }}">
      @if ($errors->has('email'))
        <div class="text--errors">
          {{ $errors->first('email') }}
        </div>
      @endif
    </div>
    <div class="col-md-6">
      <label for="inputUserPwd4" class="form-label">Mật khẩu:</label>
      <input type="password" class="form-control form-control-lg" id="inputUserPwd4" maxlength="128" name="password"
        required {{ old('password') }}>
      @if (session()->has('passwordMsg'))
        <div class="text--errors">
          {{ session()->get('passwordMsg') }}
        </div>
      @endif
      @if ($errors->has('password'))
        <div class="text--errors">
          {{ $errors->first('password') }}
        </div>
      @endif
    </div>
    <div class="col-md-6">
      <label for="inputUserRePwd4" class="form-label">Xác nhận mật khẩu:</label>
      <input type="password" class="form-control form-control-lg" id="inputUserRePwd4" maxlength="128"
        name="confirm_password" required>
      {{-- value="{{ old('confirm_password') }}" --}}
      @if (session()->has('confirm_passwordMsg'))
        <div class="text--errors">
          {{ session()->get('confirm_passwordMsg') }}
        </div>
      @endif
      @if ($errors->has('confirm_password'))
        <div class="text--errors">
          {{ $errors->first('confirm_password') }}
        </div>
      @endif
    </div>


    <div class="col-md-6">
      <label for="inputUserAvatar4" class="form-label">Ảnh đại diện</label>
      <input type="file" class="form-control form-control-lg" id="inputUserAvatar4" name="avatar">
      @if (session()->has('avatarMsg'))
        <div class="text--errors">
          {{ session()->get('avatarMsg') }}
        </div>
      @endif
    </div>
    <div class="col-md-6">
      <label for="inputUserPhoneNumber4" class="form-label">Số điện thoại:</label>
      <input type="tel" class="form-control form-control-lg" id="inputUserPhoneNumber4" maxlength="128"
        name="phone_number" required value="{{ old('phone_number') }}">
      @if ($errors->has('phone_number'))
        <div class="text--errors">
          {{ $errors->first('phone_number') }}
        </div>
      @endif
    </div>
    <div class="col-md-6">
      <label for="inputCityEmail4" class="form-label">Tỉnh thành:</label>
      <input type="text" class="form-control form-control-lg" id="inputCityEmail4" maxlength="128" name="city"
        required value="{{ old('city') }}">
      @if ($errors->has('city'))
        <div class="text--errors">
          {{ $errors->first('city') }}
        </div>
      @endif
    </div>
    <div class="col-md-6">
      <label for="userSelectInput" class="form-label">Quyền sử dụng:</label>
      <select class="form-select form-select-lg" id="userSelectInput" name="role_name">
        @foreach ($roles as $role)
          <option value="{{ $role }}" @if (old('role_name') == $role) selected @endif>
            {{ $role }}
          </option>
        @endforeach
      </select>
      @if ($errors->has('role_name'))
        <div class="text--errors">
          {{ $errors->first('role_name') }}
        </div>
      @endif
    </div>
    <div class="col-12 d-flex justify-content-center">
      <button type="submit" class="btn btn-primary btn-lg">Tạo người dùng</button>
    </div>
  </form>
@endsection

@section('js')
@endsection
