@extends('layout')



@section('page-title')
  <title>Mango Shop</title>
@endsection

@section('content')
  <div class="row">
    <div class="col-lg-8">
      <div id="main-carousel" class="carousel slide carousel-fade" data-bs-ride="true">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#main-carousel" data-bs-slide-to="0" class="active" aria-current="true"
            aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#main-carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#main-carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item carousel-img active" style="background-image: url('/img/carousel-1.jpg');">
            <div class="white-overlay"></div>

            <div class="position-center">
              <h2 class="carousel-item__inner-heading animate__animated animate__fadeInDown">
                <span id="MEN_FASHION" class="multilang">Thời trang nam</span>
              </h2>
              <p class="carousel-item__inner-des animate__animated animate__bounceIn">
                <span id="MEN_FASHION_SLOGAN" class="multilang">Sự khác biệt giữa phong
                  cách và
                  thời trang đó chính là chất lượng.</span>
              </p>
              <a href="/shop"
                class="carousel-item__inner-btn carousel-item__inner-btn--white animate__animated animate__fadeInUp">
                <span id="SHOP_NOW" class="multilang">Mua ngay</span>
              </a>
            </div>
          </div>
          <div class="carousel-item carousel-img .bg-img-carousel2" style="background-image: url('/img/carousel-2.jpg');">
            <div class="white-overlay"></div>
            <div class="position-center">
              <h2 class="carousel-item__inner-heading animate__animated animate__fadeInDown">
                <span id="WOMEN_FASHION" class="multilang">Thời trang nữ</span>
              </h2>

              <p class="carousel-item__inner-des animate__animated animate__bounceIn">
                <span id="WOMEN_FASHION_SLOGAN" class="multilang">Để không ai có thể
                  thay thế, bạn phải luôn luôn khác biệt.</span>
              </p>
              <a href="/shop"
                class="carousel-item__inner-btn carousel-item__inner-btn--white animate__animated animate__fadeInUp">
                <span id="SHOP_NOW" class="multilang">Mua ngay</span>
              </a>
            </div>
          </div>

          <div class="carousel-item carousel-img" style="background-image: url('/img/carousel-3.jpg');">
            <div class="white-overlay"></div>
            <div class="position-center">
              <h2
                class=" carousel-item__inner-heading animate__animated
                                    animate__fadeInDown">
                <span id="KIDS_FASHION" class="multilang">Thời trang trẻ em</span>
              </h2>

              <p class="carousel-item__inner-des animate__animated animate__bounceIn">
                <span id="KIDS_FASHION_SLOGAN" class="multilang">Phong cách chính là thứ
                  thể hiện cá tính một cách tự do và can đảm.</span>
              </p>
              <a href="/shop"
                class="carousel-item__inner-btn carousel-item__inner-btn--white animate__animated animate__fadeInUp">
                <span id="SHOP_NOW" class="multilang">Mua ngay</span>
              </a>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#main-carousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#main-carousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="row my-4 mt-lg-0">
        <div class="col-12">
          <div class="discount" style="background-image: url('/img/offer-1.jpg');">
            <div class="white-overlay"></div>
            <div class="position-center">
              <h4 class="discount-percent">
                <span id="SALE" class="multilang">Giảm giá 20%</span>
              </h4>
              <h3 class="discount-heading">
                <span id="SPECIAL_OFFER" class="multilang">Khuyến mãi đặc biệt</span>
              </h3>
              <a href="/shop" class="carousel-item__inner-btn">
                <span id="SHOP_NOW" class="multilang">Mua ngay</span>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="discount" style="background-image: url('/img/offer-2.jpg');">
            <div class="white-overlay"></div>
            <div class="position-center">
              <h4 class="discount-percent">
                <span id="SALE" class="multilang">Giảm giá 20%</span>
              </h4>
              <h3 class="discount-heading">
                <span id="SPECIAL_OFFER" class="multilang">Khuyến mãi đặc biệt</span>
              </h3>
              <a href="/shop" class="carousel-item__inner-btn">
                <span id="SHOP_NOW" class="multilang">Mua ngay</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="spacing-section-100"></div>
  <div class="row">
    <div class="col-md-6 col-lg-3 mt-4 mt-lg-0">
      <div class="benefit-card">
        <div class="benefit-card__icon">
          <i class="fa-solid fa-check"></i>
        </div>

        <div class="benefit-card__text">
          <span id="QUALITY_PRODUCTS" class="multilang">Sản phẩm chất lượng</span>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3 mt-4 mt-lg-0">
      <div class="benefit-card">
        <div class="benefit-card__icon">
          <i class="fa-solid fa-truck-fast"></i>
        </div>

        <div class="benefit-card__text">
          <span id="FREE_SHIPPING" class="multilang">Miễn phí vận chuyển</span>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3 mt-4 mt-lg-0">
      <div class="benefit-card">
        <div class="benefit-card__icon">
          <i class="fa-solid fa-arrow-right-arrow-left"></i>
        </div>

        <div class="benefit-card__text">
          <span id="DAY_RETURN" class="multilang">14 ngày đổi trả</span>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3 mt-4 mt-lg-0">
      <div class="benefit-card">
        <div class="benefit-card__icon">
          <i class="fa-solid fa-phone-volume"></i>
        </div>

        <div class="benefit-card__text">
          <span id="SUPPORT_24H" class="multilang">Hỗ trợ 24/7</span>
        </div>
      </div>
    </div>
  </div>
  <div class="spacing-section-100"></div>

  <div class="row">
    <div class="col d-flex align-items-center">
      <h2 class="section-heading">
        <span id="CATEGORIES" class="multilang">Danh mục</span>
      </h2>
      <div class="line-through"></div>
    </div>
  </div>
  <div class="row">
    @foreach ($categories as $category)
      <div class="col-sm-6 col-md-4 col-lg-3 mt-4 mt-lg-4">
        <a href="/shop?type={{ $category->id }}" class="category-card">
          <div class="category-card__img">
            <img src="/img/category-{{ $category->id }}.jpg" alt="">
          </div>

          <div class="category-card__text">
            <h4 class="category-card__text-heading">
              {{ $category->category_name }}
            </h4>
            <p class="category-card__text-quatity">
              100 <span id="PRODUCT" class="multilang">sản phẩm</span>
            </p>
          </div>
        </a>
      </div>
    @endforeach
  </div>

  <div class="spacing-section-100"></div>
  <div class="row">

    <div class="col-lg-6">
      <div class="discount mb-5" style="background-image: url('/img/offer-1.jpg');">
        <div class="white-overlay"></div>
        <div class="position-center">
          <h4 class="discount-percent">
            <span id="SALE" class="multilang">Giảm giá 20%</span>
          </h4>
          <h3 class="discount-heading">
            <span id="SPECIAL_OFFER" class="multilang">Khuyến mãi đặc biệt</span>
          </h3>
          <a href="/shop" class="carousel-item__inner-btn">
            <span id="SHOP_NOW" class="multilang">Mua ngay</span>
          </a>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="discount" style="background-image: url('/img/offer-2.jpg');">
        <div class="white-overlay"></div>
        <div class="position-center">
          <h4 class="discount-percent">
            <span id="SALE" class="multilang">Giảm giá 20%</span>
          </h4>
          <h3 class="discount-heading">
            <span id="SPECIAL_OFFER" class="multilang">Khuyến mãi đặc biệt</span>
          </h3>
          <a href="/shop" class="carousel-item__inner-btn">
            <span id="SHOP_NOW" class="multilang">Mua ngay</span>
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="spacing-section-100"></div>

  <div class="row">
    <div class="col d-flex align-items-center">
      <h2 class="section-heading">
        <span id="HOT_PRODUCTS" class="multilang">Sản phẩm bán chạy</span>
      </h2>
      <div class="line-through"></div>
    </div>
  </div>

  <div class="row">
    @foreach ($topProducts as $product)
      <div class="col-sm-6 col-md-4 col-lg-3 mt-4">
        <div id="{{ $product->id }}" class="product-card" data-product-id="{{ $product->id }}">
          <div class="product-card__img">
            <img src="/img/{{ $product->illustrations[0]->illustration_path }}" alt="">
          </div>

          <div class="product-card__text">
            <h4 class="product-card__text-name">
              {{ $product->product_name }}
            </h4>
            <div class="product-card__text-price">
              <span class="product-card__text-current-price">
                {{ $product->unit_price - $product->unit_price * $product->discount }}
              </span>
              {{-- <span class="product-card__text-old-price">{{ $product->unit_price }}Đ</span> --}}
            </div>
            <div class="product-card__text-star">
              <ul>
                <li><i class="fa-solid fa-star"></i></li>
                <li><i class="fa-solid fa-star"></i></li>
                <li><i class="fa-solid fa-star"></i></li>
                <li><i class="fa-solid fa-star"></i></li>
                <li><i class="fa-solid fa-star"></i></li>
                <li class="product-card__text-star-quantity">(99)</li>
              </ul>
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <a type="button" href="/add-cart/{{ $product->id }}" class="product-card__btn">
              Thêm vào giỏ hàng
            </a>
          </div>
        </div>
      </div>
    @endforeach

  </div>

  <div class="spacing-section-100"></div>

  <div class="row">
    <div class="col-sm-6 col-md-4 col-lg-3 mb-5">
      <div class="company-item">
        <img src="/img/vendor-1.jpg" alt="">
      </div>
    </div>
    <div class="col-sm-6 col-md-4 col-lg-3 mb-5">
      <div class="company-item">
        <img src="/img/vendor-2.jpg" alt="">
      </div>
    </div>

    <div class="col-sm-6 col-md-4 col-lg-3 mb-5">
      <div class="company-item">
        <img src="/img/vendor-3.jpg" alt="">
      </div>
    </div>

    <div class="col-sm-6 col-md-4 col-lg-3 mb-5">
      <div class="company-item">
        <img src="/img/vendor-4.jpg" alt="">
      </div>
    </div>
  </div>

  <div class="spacing-section-100"></div>
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
@endsection
