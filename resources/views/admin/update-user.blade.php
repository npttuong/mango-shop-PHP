@extends('admin.layout-admin')

@section('content')
  <h2 class="mb-5 page-heading">Cập nhật thông tin người dùng</h2>
  @if (session()->has('updateSuccess'))
    <div class="alert alert-success" role="alert">
      {{ session()->get('updateSuccess') }}
    </div>
  @endif

  @if (session()->has('updateFailed'))
    <div class="alert alert-danger" role="alert">
      {{ session()->get('updateFailed') }}
    </div>
  @endif


  <form class="row g-3 fs-4" action="/admin/update-user/{{ $user->username }}" method="post" enctype="multipart/form-data"
    novalidate>
    @method('PUT')
    @csrf
    <div class="col-md-3 d-flex flex-column align-items-center">
      <img class="update-user__avatar" src="/img/{{ $user->avatar }}" alt="">

      <h3 class="text-center mt-4 user__box-name">
        {{ $user->username }}
      </h3>
    </div>
    <div class="col-md-7">
      <div class="col-12">
        <label for="inputUserName4" class="form-label">Tên người dùng:</label>
        <input type="text" class="form-control form-control-lg" id="inputUserName4" maxlength="128" name="username"
          required value="{{ $user->username ?? old('username') }}">
        @if (session()->has('usernameMsg'))
          <div class="text--errors">
            {{ session()->get('usernameMsg') }}
          </div>
        @endif

        @if ($errors->has('username'))
          <div class="text--errors">
            {{ $errors->first('username') }}
          </div>
        @endif
      </div>
      <div class="col-12">
        <label for="inputUserEmail4" class="form-label">Email:</label>
        <input type="email" class="form-control form-control-lg" id="inputUserEmail4" maxlength="128" name="email"
          required value="{{ $user->email ?? old('email') }}">
        @if ($errors->has('email'))
          <div class="text--errors">
            {{ $errors->first('email') }}
          </div>
        @endif
      </div>
      <div class="col-12">
        <label for="inputUserAvatar4" class="form-label">Cập nhật ảnh đại diện</label>
        <input type="file" class="form-control form-control-lg" id="inputUserAvatar4" name="avatar">
        @if (session()->has('avatarMsg'))
          <div class="text--errors">
            {{ session()->get('avatarMsg') }}
          </div>
        @endif
      </div>

      <div class="col-12">
        <label for="inputUserPhoneNumber4" class="form-label">Số điện thoại:</label>
        <input type="tel" class="form-control form-control-lg" id="inputUserPhoneNumber4" maxlength="128"
          name="phone_number" required value="{{ $user->phone_number ?? old('phone_number') }}">
        @if ($errors->has('phone_number'))
          <div class="text--errors">
            {{ $errors->first('phone_number') }}
          </div>
        @endif
      </div>
      <div class="col-12">
        <label for="inputCityEmail4" class="form-label">Tỉnh thành:</label>
        <input type="text" class="form-control form-control-lg" id="inputCityEmail4" maxlength="128" name="city"
          required value="{{ $user->city ?? old('city') }}">
        @if ($errors->has('city'))
          <div class="text--errors">
            {{ $errors->first('city') }}
          </div>
        @endif
      </div>
      <div class="col-12">
        <label for="userSelectInput" class="form-label">Quyền sử dụng:</label>
        <select class="form-select form-select-lg" id="userSelectInput" name="role_name">
          @foreach ($roles as $role)
            <option value="{{ $role }}" @if (strcmp($user->role_name, $role) === 0) selected @endif>
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
      <div class="col-12 d-flex justify-content-center mt-4">
        <button type="submit" class="btn btn-primary btn-lg">Cập nhật người dùng</button>
      </div>
    </div>
    {{-- <div class="col-md-6">
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
    </div> --}}
    {{-- <div class="col-md-6">
      <label for="inputUserRePwd4" class="form-label">Xác nhận mật khẩu:</label>
      <input type="password" class="form-control form-control-lg" id="inputUserRePwd4" maxlength="128"
        name="confirm_password" required>
      {{-- value="{{ old('confirm_password') }}" --}}
    {{-- @if (session()->has('confirm_passwordMsg'))
        <div class="text--errors">
          {{ session()->get('confirm_passwordMsg') }}
        </div>
      @endif
      @if ($errors->has('confirm_password'))
        <div class="text--errors">
          {{ $errors->first('confirm_password') }}
        </div>
      @endif
    </div> --}}
  </form>
@endsection

@section('js')
@endsection
