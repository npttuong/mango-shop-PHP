@extends('layout')

@section('page-title')
  <title>Liên hệ</title>
@endsection

@section('content')
  <div class="container-sm">
    <div class="main">
      <section class="vh-100 bg-image">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
          <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
              <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                <div class="card form-contact" style="border-radius: 15px;">
                  <div class="card-body p-5">
                    <h2 class="text-uppercase text-center mb-4">LIÊN HỆ</h2>
                    <p>Nếu bạn có thắc mắc, xin hãy liên lạc với chúng tôi</p>

                    <div class="address">
                      <div class="box-icon"><i class="fa-solid fa-location-dot address-icon"></i></div>
                      <p><b>Địa chỉ:</b> Số 12A, Đường 3/2, Ninh Kiều, Cần Thơ</p>
                    </div>

                    <div class="email">
                      <div class="box-icon"><i class="fa-solid fa-envelope email-icon"></i>
                      </div>
                      <p><b>Email:</b> mangoshop@gmail.com</p>
                    </div>

                    <div class="phone">
                      <div class="box-icon"><i class="fa-solid fa-phone phone-icon"></i></div>
                      <p><b>Điện thoại:</b> +84 134 298 9237</p>
                    </div>



                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
@endsection
