@extends('layout')

@section('js')
  <!-- Custom select input -->
  <script src="/js/increase-input-custom.js"></script>
@endsection

@section('page-title')
  <title>Chi tiết sản phẩm</title>
@endsection

@section('content')
  <div class="row bg--white">
    <div class="col-12">
      <nav aria-label="breadcrumb" class="pt-4 pb-3 px-4">
        <ol class="breadcrumb fs-4">
          <li class="breadcrumb-item">
            <a href="/">Trang chủ</span></a>
          </li>
          <li class="breadcrumb-item" aria-current="page">
            <a href="/shop">Mua sắm</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">
            <span>Chi tiết</span>
          </li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="spacing-section-32"></div>

  <div class="row">
    <div class="col-lg-5">
      <div id="detail__carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          @for ($i = 0; $i < $product->illustrations->count(); $i++)
            @if ($i == 0)
              <div class="carousel-item active">
                <img src="/img/{{ $product->illustrations[$i]->illustration_path }}" class="d-block w-100" alt="...">
              </div>
            @else
              <div class="carousel-item">
                <img src="/img/{{ $product->illustrations[$i]->illustration_path }}" class="d-block w-100" alt="...">
              </div>
            @endif
          @endfor
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#detail__carousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#detail__carousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
    <div class="col-lg-7 bg--white detail__info mt-lg-0 mt-sm-3">
      <form action="/add-cart/{{ $product->id }}" method="GET">
        <h2 class="detail__info-heading">{{ $product->product_name }}</h2>
        <ul class="detail_info-review">
          <li><i class="fa-solid fa-star"></i></li>
          <li><i class="fa-solid fa-star"></i></li>
          <li><i class="fa-solid fa-star"></i></li>
          <li><i class="fa-solid fa-star"></i></li>
          <li><i class="fa-solid fa-star"></i></li>
          <li class="detail_info-review-quantity">(99 Reviews)</li>
        </ul>
        <span class="detail__info-price">{{ $product->unit_price - $product->unit_price * $product->discount }}</span>
        @if ($product->discount > 0)
          <span class="detail__info-unit-price">{{ $product->unit_price }}</span>
        @endif
        <p class="detail__info-short-description mt-lg-3">
          {{ $product->product_short_des }}
        </p>
        <div class="d-flex mt-4">
          <span class="detail__info-lable">Sizes:</span>
          <div class="d-flex align-items-center flex-grow-1 flex-wrap">
            @foreach ($product->sizes as $item)
              <label class="container-radio">
                <input type="radio" name="sizes" value="{{ $item->size }}"
                  {{ $product->sizes[0]->size === $item->size ? 'checked' : '' }}>
                {{ $item->size }}
                <span class="checkmark-radio"></span>
              </label>
            @endforeach
          </div>
        </div>
        <div class="d-flex mt-4">
          <span class="detail__info-lable">Colors:</span>

          <div class="d-flex align-items-center flex-grow-1 flex-wrap">
            @foreach ($product->colors as $item)
              <label class="container-radio">
                <input type="radio" name="colors" value="{{ $item->color_code }}"
                  {{ $product->colors[0]->color_code === $item->color_code ? 'checked' : '' }}>
                {{ $item->color }}
                <span class="checkmark-radio"></span>
              </label>
            @endforeach
          </div>
        </div>
        <div class="mt-4 d-flex">
          <div class="incremment-wrapper me-5">
            <span class="incremment-minus">-</span>
            <span class="incremment-num">1</span>
            <span class="incremment-plus">+</span>
            <input type="number" name="quantity" value="1" min="1" step="1" hidden>
          </div>

          <button type="submit" class="detail__add-cart-btn">
            <i class="fa-solid fa-cart-shopping"></i>
            <span>Thêm vào giỏ hàng</span>
          </button>
        </div>
        <div class="mt-4 d-flex align-items-center">
          <span class="detail__info-lable">Share on:</span>
          <ul class="detail__social-list d-flex align-items-center">
            <li class="detail__social-item me-3">
              <i class="fa-brands fa-facebook"></i>
            </li>
            <li class="detail__social-item me-3">
              <i class="fa-brands fa-twitter"></i>
            </li>
            <li class="detail__social-item me-3">
              <i class="fa-brands fa-linkedin"></i>
            </li>
            <li class="detail__social-item me-3">
              <i class="fa-brands fa-pinterest"></i>
            </li>
          </ul>
        </div>
      </form>
    </div>
  </div>

  <div class="spacing-section-32"></div>

  <div class="row">
    <div class="col-12">
      <div class="bg--white detail__tabs">
        <ul class="nav nav-tabs" id="detailTabs" role="tablist">
          <li class="nav-item detail__tabs-item" role="presentation">
            <button class="nav-link text-color active" id="description-tab" data-bs-toggle="tab"
              data-bs-target="#description" type="button" role="tab" aria-controls="description"
              aria-selected="true">Mô tả</button>
          </li>
          <li class="nav-item detail__tabs-item" role="presentation">
            <button class="nav-link text-color" id="infomation-tab" data-bs-toggle="tab" data-bs-target="#infomation"
              type="button" role="tab" aria-controls="infomation" aria-selected="false">Thông tin</button>
          </li>
          <li class="nav-item detail__tabs-item" role="presentation">
            <button class="nav-link text-color" id="review-tab" data-bs-toggle="tab" data-bs-target="#review"
              type="button" role="tab" aria-controls="review" aria-selected="false">Đánh giá</button>
          </li>
        </ul>
        <div class="tab-content detail_tab-content mt-2" id="myTabContent">
          <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
            {{ $product->product_description }}
          </div>
          <div class="tab-pane fade" id="infomation" role="tabpanel" aria-labelledby="infomation-tab">
            {{ $product->product_info }}
          </div>
          <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">Lorem ipsum
            dolor sit amet consectetur, adipisicing elit. Dolore quisquam labore commodi quod itaque
            distinctio
            laudantium rerum vitae tempore inventore debitis, consequatur tenetur veritatis eum vero neque
            optio
            consequuntur repellat.</div>
        </div>
      </div>
    </div>
  </div>

  <div class="spacing-section-32"></div>

  <div class="row">
    <div class="col d-flex align-items-center">
      <h2 class="section-heading">
        Có thể bạn cũng thích
      </h2>
      <div class="line-through"></div>
    </div>
  </div>

  <div class="row mb-5">
    @foreach ($relatedProducts as $product)
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
@endsection
