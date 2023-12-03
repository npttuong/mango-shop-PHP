<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
  <!-- Font Roboto -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <!-- Reset css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
  <!-- Bootstrap5 CSS-->
  <link rel="stylesheet" href="/css/bootstrap-lib/bootstrap.min.css">
  <!-- Fontawesome -->
  <link rel="stylesheet" href="/font/fontawesome-free-6.4.0-web/css/all.min.css">
  <!-- Animate lib-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <!-- toastr-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <!-- File css -->
  <link rel="stylesheet" href="/css/style.css">
  @yield('page-title')
</head>

<body onunload="">
  <div class="app bg--gray">
    <header class="header">
      <!-- Start TopNav -->
      <div class="container-sm">
        <nav class="topnav">
          <ul class="d-none d-md-flex topnav__list">
            <li class="topnav__item topnav__item-info">
              <a class="topnav__item-info-link" href="#">
                <span id="ABOUT_US" class="multilang">Về chúng tôi</span>
              </a>
            </li>
            <li class="topnav__item topnav__item-info">
              <a class="topnav__item-info-link" href="#">
                <span id="HELPS" class="multilang">Trợ giúp</span>
              </a>
            </li>
            <li class="topnav__item topnav__item-info">
              <a class="topnav__item-info-link" href="#">
                FAQs
              </a>
            </li>
          </ul>

          <ul class="topnav__list">
            <li class="topnav__item-tool">
              <div class="languages">
                <div id="language-current">
                  <img class="languages-flags" src="/img/vietnam.png" alt="Flag">
                  <span class="languages-name">
                    <span id="CURRRENT_LANG" class="multilang">Tiếng Việt</span>
                  </span>
                </div>

                <!-- Languages box -->
                <ul class="languages-list">
                  <li class="languages-list-item">
                    <div data-lang="vi-VN" class="languages-list-link">
                      <img class="languages-flags" src="/img/vietnam.png" alt="Flag">
                      <span class="languages-name">Tiếng Việt</span>
                    </div>
                  </li>
                  <li class="languages-list-item">
                    <div data-lang="en-US" class="languages-list-link">
                      <img class="languages-flags" src="/img/united-kingdom.png" alt="Flag">
                      <span class="languages-name">English</span>
                    </div>
                  </li>
                </ul>
              </div>
            </li>
            <li class="topnav__item-tool">
              @if (Auth::check())
                <div class="topnav__user">
                  <img class="topnav__user-avatar" src="/img/{{ Auth::user()->avatar }}" alt="Avatar">
                  <span class="topnav__user-name">{{ Auth::user()->username }}</span>

                  <ul class="topnav__user-tools">
                    <li class="topnav__user-tools-items">
                      <a href="/user-profile" class="topnav__user-tools-link">Hồ sơ của tôi</a>
                    </li>
                    <li class="topnav__user-tools-items">
                      <a href="/logout" class="topnav__user-tools-link">Đăng xuất</a>
                    </li>
                  </ul>
                </div>
              @else
                <div class="topnav__item-tool-sign-up">
                  <a class="topnav__item-info-link" href="/register">
                    <span id="SIGN_UP" class="multilang">Đăng ký</span>
                  </a>
                </div>
                <div class="topnav__item-tool-sign-in">
                  <a class="topnav__item-info-link" href="/login">
                    <span id="SIGN_IN" class="multilang">Đăng nhập</span>
                  </a>
                </div>
              @endif
            </li>
          </ul>
        </nav>
      </div>
      <!-- End TopNav -->

      <!-- Start Header Search -->
      <div class="bg--white">
        <div class="container-sm">
          <div class="header-search">
            <div class="row">
              <div class="col-md-4 col-lg-4 d-none d-lg-flex">
                <a href="/" class="header-search__logo">
                  <span class="logo-first-part">man</span>
                  <span class="logo-second-part">go.</span>
                </a>
              </div>

              <div class="col-12 col-md-12 col-lg-4 header-search__box-wrapper">
                <form class="header-search__box" action="/shop" method="get" name="frm-search">
                  <input class="header-search__box-input" type="search"
                    @if (!empty(request('words'))) value="{{ request('words') }}" @else placeholder="Nhập sản phẩm cần tìm..." @endif
                    name="words" onkeydown="checkKey();">
                  <div class="header-search__box-btn" onclick="document.forms['frm-search'].submit()">
                    <i class="fa-solid fa-magnifying-glass"></i>
                  </div>
                </form>
              </div>

              <div class="col col-lg-4 d-none d-lg-flex justify-content-end align-items-center">
                <div class="header-search__customer-service">
                  <h3>
                    <span id="CUSTOMER_SERVICE" class="multilang">Dịch vụ chăm sóc khách hàng</span>
                  </h3>
                  <h2>+84 134 298 9237</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Header Search -->

      <div class="container-fluid bg--primary">
        <div class="container-sm">
          <div class="row">
            <div class="col-lg-3 d-none d-lg-flex category">
              <div>
                <i class="fa-solid fa-bars"></i>
                <span id="CATEGORIES" class="multilang">Danh mục</span>
              </div>

              <div>
                <i class="fa-solid fa-chevron-down"></i>
              </div>

              <ul class="category-list">
                @foreach ($categories as $category)
                  <li class="category-item">
                    <a href="/shop?type={{ $category->id }}" class="category-item-link">
                      {{ $category->category_name }}
                    </a>
                  </li>
                @endforeach
              </ul>
            </div>
            <div class="col col-lg-7">
              <nav class="navbar navbar-expand-lg">
                <a href="/" class="navbar-brand d-lg-none">
                  <span class="logo-first-part logo-first-part--mobile-tablet">man</span>
                  <span class="logo-second-part logo-second-part--mobile-tablet">go.</span>
                </a>
                <button class="navbar-toggler collapsed d-flex d-lg-none ms-auto flex-column justify-content-around"
                  type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                  aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="toggler-icon top-bar"></span>
                  <span class="toggler-icon middle-bar"></span>
                  <span class="toggler-icon bottom-bar"></span>
                </button>
                <div class="collapse navbar-collapse mt-lg-3" id="navbarSupportedContent">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item my__nav-item">
                      <a class="nav-link my__nav-link" aria-current="page" href="/">
                        {{-- my-active --}}
                        <span id="HOME" class="multilang">Trang chủ</span>
                      </a>
                    </li>
                    <li class="nav-item my__nav-item">
                      <a class="nav-link my__nav-link" href="/shop">
                        <span id="SHOP" class="multilang">Mua sắm</span>
                      </a>
                    </li>

                    <li class="nav-item my__nav-item dropdown">
                      <a class="nav-link my__nav-link .dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false" id="navBarDropdown">
                        <div class="navbar__pages">
                          <span id="PAGES" class="multilang">Trang khác</span>
                          <div class="d-flex align-items-center">
                            <i class="fa-solid fa-chevron-down"></i>
                          </div>
                        </div>
                      </a>
                      <ul class="dropdown-menu header__dropdown-menu mt-lg-4" aria-labelledby="navBarDropdown">
                        <li>
                          <a class="dropdown-item" href="/cart">
                            <span id="SHOPPING_CART" class="multilang">Giỏ hàng</span>
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="/checkout">
                            <span id="CHECK_OUT" class="multilang">Thanh toán</span>
                          </a>
                        </li>

                      </ul>
                    </li>

                    <li class="nav-item my__nav-item">
                      <a class="nav-link my__nav-link" href="/contact">
                        <span id="CONTACT" class="multilang">Liên hệ</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </nav>
            </div>

            <div class="col-lg-2 navbar__icon-wrapper d-none d-lg-flex">
              <div class="navbar__icon">
                <i class="fa-solid fa-heart"></i>
                <span class="navbar__icon-quantity">0</span>
              </div>
              <div class="navbar__icon">
                <i class="fa-solid fa-cart-shopping"></i>
                <span class="navbar__icon-quantity">{{ count((array) session('cart')) }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- End TopNav -->

    <main class="py-5">
      <div class="container-sm">
        {{-- Views output --}}
        @yield('content')
      </div>
    </main>


    <footer>
      <div class="footer">
        <div class="container-sm">
          <div class="row">
            <div class="col col-md-12 col-lg-4">
              <div class="footer_get-in-touch px-3 pe-lg-4">
                <h2 class="footer-heading my-5">
                  <span id="CONTACT" class="multilang">Liên hệ</span>
                </h2>
                <p class="mb-5">
                  <span id="CONTACT_THANKS" class="multilang">Hãy liên hệ ngay với chúng tôi khi có
                    bất kì thắc mắc nào cần giải đáp
                    theo địa chỉ liên hệ bên dưới. Chúng tôi vô cùng trân trọng
                    , xin cảm ơn quý khách.</span>
                </p>

                <div class="footer_get-in-touch-address">
                  <div class="footer-contact-icon">
                    <i class="fa-solid fa-location-dot"></i>
                  </div>
                  <span>
                    <span id="CONTACT_ADDRESS" class="multilang">Số 12A, Đường 3/2, Ninh Kiều, Cần
                      Thơ</span>
                  </span>
                </div>
                <div class="footer_get-in-touch-address">
                  <div class="footer-contact-icon">
                    <i class="fa-solid fa-envelope"></i>
                  </div>
                  <span>
                    mangoshop@gmail.com
                  </span>
                </div>

                <div class="footer_get-in-touch-address">
                  <div class="footer-contact-icon">
                    <i class="fa-solid fa-phone"></i>
                  </div>
                  <span>
                    +84 134 298 9237
                  </span>
                </div>
              </div>

            </div>
            <div class="col-12 col-md-12 col-lg-8">
              <div class="row">
                <div class="col-12 col-md-4">
                  <div class="footer__quickshop px-3">
                    <h2 class="footer-heading my-5">
                      <span id="QUICK_SHOP" class="multilang">Mua sắm</span>
                    </h2>
                    <ul class="footer-list">
                      <li class="footer-item">
                        <a href="/" class="footer-link">
                          <div class="pe-3">
                            <i class="fa-solid fa-chevron-right"></i>
                          </div>
                          <span id="HOME" class="multilang">Trang chủ</span>
                        </a>
                      </li>

                      <li class="footer-item">
                        <a href="/shop" class="footer-link">
                          <div class="pe-3">
                            <i class="fa-solid fa-chevron-right"></i>
                          </div>
                          <span id="SHOP" class="multilang">Mua sắm</span>
                        </a>
                      </li>

                      <li class="footer-item">
                        <a href="/cart" class="footer-link">
                          <div class="pe-3">
                            <i class="fa-solid fa-chevron-right"></i>
                          </div>
                          <span id="SHOPPING_CART" class="multilang">Giỏ hàng</span>
                        </a>
                      </li>

                      <li class="footer-item">
                        <a href="/checkout" class="footer-link">
                          <div class="pe-3">
                            <i class="fa-solid fa-chevron-right"></i>
                          </div>
                          <span id="CHECK_OUT" class="multilang">Thanh toán</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col-12 col-md-4">
                  <div class="footer__get-help px-3">
                    <h2 class="footer-heading my-5">
                      <span id="GET_HELPS" class="multilang">Trợ giúp</span>
                    </h2>
                    <ul class="footer-list">
                      <li class="footer-item">
                        <a href="#" class="footer-link">
                          <div class="pe-3">
                            <i class="fa-solid fa-chevron-right"></i>
                          </div>
                          FAQs
                        </a>
                      </li>

                      <li class="footer-item">
                        <a href="#" class="footer-link">
                          <div class="pe-3">
                            <i class="fa-solid fa-chevron-right"></i>
                          </div>
                          <span id="ORDER" class="multilang">Đặt hàng</span>
                        </a>
                      </li>

                      <li class="footer-item">
                        <a href="#" class="footer-link">
                          <div class="pe-3">
                            <i class="fa-solid fa-chevron-right"></i>
                          </div>
                          <span id="ACCOUNT" class="multilang">Tài khoản</span>
                        </a>
                      </li>

                      <li class="footer-item">
                        <a href="#" class="footer-link">
                          <div class="pe-3">
                            <i class="fa-solid fa-chevron-right"></i>
                          </div>
                          <span id="PRIVACY_POLICY" class="multilang">Chính sách bảo
                            mật</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col-12 col-md-4">
                  <div class="footer__social px-3">
                    <div class="footer-heading my-5">
                      <span id="FOLLOW_US" class="multilang">Theo dõi</span>
                    </div>

                    <div class="footer__social-list">
                      <div class="footer__social-item p-4">
                        <i class="fa-brands fa-twitter"></i>
                      </div>
                      <div class="footer__social-item p-4">
                        <i class="fa-brands fa-facebook-f"></i>
                      </div>
                      <div class="footer__social-item p-4">
                        <i class="fa-brands fa-linkedin-in"></i>
                      </div>
                      <div class="footer__social-item p-4">
                        <i class="fa-brands fa-instagram"></i>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <hr>
        <div class="container-sm">
          <div class="footer__copyright text-center">
            &copy; Copyright <a href="/">Mango Shop</a>.
            <span>Được thiết kế bởi nhóm Tường Huy.</span>
          </div>
        </div>

        <div id="back-top-btn" title="Back to top">
          <a href="#" class="back-top-link">
            <i class="fa-solid fa-circle-up"></i>
          </a>
        </div>
      </div>
    </footer>
  </div>

  <!-- JQuery -->
  <script src="/js/js-lib/jquery-3.6.4.min.js"></script>
  <!-- Boostrap js -->
  <script src="/js/js-lib/bootstrap.bundle.min.js"></script>
  <!-- Toast notification -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  @yield('js')
  <!-- Main script -->
  <script src="/js/main.js"></script>
  @include('components.toastr')
  <!-- Code của Nguyễn Châu Phúc Huy -->
  <!-- Javascript -->
  <script>
    // Reload lại trang khi nhấn nút back button của browser
    window.addEventListener("pageshow", function(event) {
      var historyTraversal = event.persisted ||
        (typeof window.performance != "undefined" && window.performance.navigation.type === 2);
      if (historyTraversal) {
        // Handle page restore.
        window.location.reload();
      }
    });
  </script>
  <!-- Kết thúc -->
</body>

</html>
