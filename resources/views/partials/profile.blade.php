  <!-- Code của Nguyễn Châu Phúc Huy -->
  <!-- Thông báo lỗi nếu user nhập đường link truy cập vào trang admin -->
  @if (session('error'))
  <div class="alert alert-danger" role="alert">
    {{ session('error') }}
  </div>
  @endif
  <!-- Kết thúc -->
  <h2 class="mb-5 page-heading">Trang cá nhân</h2>
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


  <div class="row fs-3">
    <div class="col-md-3 d-flex flex-column align-items-center">
      <img class="update-user__avatar" src="/img/{{ $user->avatar }}" alt="">

      <h3 class="text-center mt-4 user__box-name">
        {{ $user->username }}
      </h3>
    </div>
    <div class="col-md-7">
      <div class="col-12">
        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $user->email }}">
          </div>
        </div>
      </div>

      <div class="col-12">
        <div class="mb-3 row">
          <label for="staticPhoneNumber" class="col-sm-2 col-form-label">Số điện thoại:</label>
          <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticPhoneNumber" value="{{ $user->phone_number }}">
          </div>
        </div>
      </div>
      <div class="col-12">
        <div class="mb-3 row">
          <label for="staticCity" class="col-sm-2 col-form-label">Tỉnh thành:</label>
          <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="staticCity" value="{{ $user->city }}">
          </div>
        </div>
      </div>
      <div class="col-12 d-flex justify-content-center mt-4">
        @if ($user->role_name === 'admin')
        <a href="/admin/update-user/{{ $user->username }}" class="btn btn-primary btn-lg">Cập nhật thông tin</a>
        @else
        <a href="/update-user/{{ $user->username }}" class="btn btn-warning btn-lg">
          Cập nhật thông tin
        </a>
        @endif
      </div>
    </div>
  </div>