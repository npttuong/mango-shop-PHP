<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
    <!-- Font Roboto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Reset css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <!-- Bootstrap5 CSS-->
    <link rel="stylesheet" href="/css/bootstrap-lib/bootstrap.min.css">
    <!-- JQuery -->
    <script defer src="/js/js-lib/jquery-3.6.4.min.js"></script>
    <!-- Boostrap js -->
    <script defer src="/js/js-lib/bootstrap.bundle.min.js"></script>
    <!-- JSON for main page -->
    <!-- Fontawesome -->
    <link rel="stylesheet" href="/font/fontawesome-free-6.4.0-web/css/all.min.css">
    <!-- File css -->
    <!-- Code của Nguyễn Châu Phúc Huy -->
    <link rel="stylesheet" href="/css/style.css?v=<?php echo time(); ?>">
    <!-- Kết thúc -->
    <link rel="stylesheet" href="/css/style.css">
    <title>Adminitrator Page</title>
</head>

<body onunload="">
    <header class="bg--primary fs-4 py-3">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <!-- <div class="topnav__user text--white d-lg-none">
          <img class="topnav__user-avatar" src="/img/no-avatar.jpg" alt="Avatar">
          <span class="topnav__user-name">Tên tạm</span>
          <ul class="topnav__user-tools">
            <li class="topnav__user-tools-items">
              <a href="/admin/profile/admin" class="topnav__user-tools-link">Hồ sơ của tôi</a>
            </li>
            <li class="topnav__user-tools-items">
              <a href="/logout" class="topnav__user-tools-link">Đăng xuất</a>
            </li>
          </ul>
        </div> -->

                <button class="navbar-toggler collapsed d-flex d-lg-none ms-auto flex-column justify-content-around"
                    type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="toggler-icon top-bar"></span>
                    <span class="toggler-icon middle-bar"></span>
                    <span class="toggler-icon bottom-bar"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item my__nav-item dropdown">
                            <a class="nav-link my__nav-link .dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false" id="productDropdown">
                                <div class="d-flex align-items-center">
                                    <span>Sản phẩm</span>
                                    <i class="fa-solid fa-chevron-down ms-2"></i>
                                </div>
                            </a>
                            <ul class="dropdown-menu header__dropdown-menu mt-lg-4" aria-labelledby="productDropdown">
                                <li>
                                    <a class="dropdown-item" href="/admin/products">
                                        <span>Tất cả sản phẩm</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/admin/create-product">
                                        <span>Thêm sản phẩm</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item my__nav-item dropdown">
                            <a class="nav-link my__nav-link .dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false" id="categoryDropdown">
                                <div class="d-flex align-items-center">
                                    <span>Loại sản phẩm</span>
                                    <i class="fa-solid fa-chevron-down ms-2"></i>
                                </div>
                            </a>
                            <ul class="dropdown-menu header__dropdown-menu mt-lg-4" aria-labelledby="categoryDropdown">
                                <li>
                                    <a class="dropdown-item" href="/admin/categories">
                                        <span>Tất cả các loại</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/admin/create-category">
                                        <span>Thêm loại sản phẩm</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item my__nav-item dropdown">
                            <a class="nav-link my__nav-link .dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false" id="userDropdown">
                                <div class="d-flex align-items-center">
                                    <span>Người dùng</span>
                                    <i class="fa-solid fa-chevron-down ms-2"></i>
                                </div>
                            </a>
                            <ul class="dropdown-menu header__dropdown-menu mt-lg-4" aria-labelledby="userDropdown">
                                <li>
                                    <a class="dropdown-item" href="/admin/users">
                                        <span>Tất cả người dùng</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/admin/create-user">
                                        <span>Thêm người dùng</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="topnav__user text--white d-lg-block d-none">
                    <img class="topnav__user-avatar me-2" src="/img/no-avatar.jpg" alt="Avatar">
                    <!-- <span class="topnav__user-name">Tên tạm</span>

                    <ul class="topnav__user-tools">
                        <li class="topnav__user-tools-items">
                            <a href="/admin/profile/admin" class="topnav__user-tools-link">Hồ sơ của tôi</a>
                        </li>
                        <li class="topnav__user-tools-items">
                            <a href="/logout" class="topnav__user-tools-link">Đăng xuất</a>
                        </li>
                    </ul> -->


                    <!-- Code của Nguyễn Châu Phúc Huy -->
                    <span class="topnav__user-name">{{ Auth::user()->username }}</span>

                    <ul class="topnav__user-tools">
                        <li class="topnav__user-tools-items">
                            <a href="/admin/admin-profile" class="topnav__user-tools-link">Hồ sơ của tôi</a>
                        </li>
                        <li class="topnav__user-tools-items">
                            <a href="/logout" class="topnav__user-tools-link">Đăng xuất</a>
                        </li>
                    </ul>

                    <!-- Kết thúc -->
                </div>
            </nav>
        </div>
    </header>

    <main class="container my-5 body__min-height">
        {{-- HTML OUTPUT --}}
        @yield('content')
    </main>

    <footer>
        <div class="footer">
            <div class="footer__copyright text-center">
                &copy; Copyright <a href="/">Mango Shop</a>.
                <span>Được thiết kế bởi nhóm Tường Huy.</span>
            </div>
        </div>
    </footer>

    @yield('js')
</body>

</html>