@extends('layout')

@section('js')
  <!-- Detail script -->
  <script defer src="/js/input-select.js"></script>
@endsection

@section('page-title')
  <title>Mua sắm</title>
@endsection

@section('content')
  <div class="row bg--white">
    <div class="col-12">
      <nav aria-label="breadcrumb" class="pt-4 pb-3 px-4">
        <ol class="breadcrumb fs-4">
          <li class="breadcrumb-item">
            <a href="/">Trang chủ</span></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Mua sắm</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="spacing-section-32"></div>

  <form action="/shop" method="get">
    <input type="text" name="type" value="{{ request('type') }}" hidden>
    <input type="text" name="words" value="{{ request('words') }}" hidden>
    <div class="row">
      <div class="col-sm-12 col-lg-3">
        <button type="submit" class="btn btn-warning btn-lg">Lọc</button>
        <div class="row">
          <div class="col-12 d-flex align-items-center">
            <h3 class="filter-heading">
              Lọc theo màu sắc
            </h3>
            <span class="line-through"></span>
          </div>
          <ul class="col-12 filter-box-list">
            @foreach ($quantityColors as $key => $value)
              <li class="filter-box-item">
                <label class="custom-checkbox-container">{{ $value[0] }}
                  <input type="checkbox" name="c_{{ $key }}" value="{{ $key }}"
                    @if (in_array($key, $reqColor)) checked @endif>
                  <span class="checkmark"></span>
                </label>
                <div class="filter-box-quantity">{{ $value[1] }}</div>
              </li>
            @endforeach
          </ul>
        </div>

        <div class="row">
          <div class="col-12 d-flex align-items-center">
            <h3 class="filter-heading">
              Lọc theo kích cỡ
            </h3>
            <span class="line-through"></span>
          </div>
          <ul class="col-12 filter-box-list">
            @foreach ($quantitySizes as $key => $value)
              <li class="filter-box-item">
                <label class="custom-checkbox-container">{{ $key }}
                  <input type="checkbox" name="s_{{ $key }}" value="{{ $key }}"
                    @if (in_array($key, $reqSize)) checked @endif>
                  <span class="checkmark"></span>
                </label>
                <div class="filter-box-quantity">{{ $value }}</div>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
      <div class="col-sm-12 col-lg-9">
        <div id="product-shop-field" class="row mt-5">
          <div class="col-12 d-flex justify-content-end">
            <div class="me-3">
              <div class="custom-select" style="width:140px;">
                <select name="priceBySort">
                  <option value="asc">Sắp xếp theo</option>
                  <option value="asc" @if (request('priceBySort') == 'asc') selected @endif>Giá thấp đến cao</option>
                  <option value="desc" @if (request('priceBySort') == 'desc') selected @endif>Giá cao đến thấp</option>
                </select>
              </div>
            </div>
            <div>
              <div class="custom-select" style="width:140px;">
                <select name="perPage">
                  <option value="0">Hiển thị sản phẩm</option>
                  <option value="10">10</option>
                  <option value="20">20</option>
                  <option value="30">30</option>
                </select>
              </div>
            </div>
          </div>
          @if ($products->count() > 0)
            @foreach ($products as $product)
              <div class="col-6 col-md-4 col-lg-3 mt-4 product-card-wrapper">
                <a id="{{ $product->id }}" href="/detail/{{ $product->id }}" class="product-card"n>
                  <div class="product-card__img">
                    <img src="/img/{{ $product->illustrations[0]->illustration_path }}">
                  </div>

                  <div class="product-card__text">
                    <h4 class="product-card__text-name">
                      {{ $product->product_name }}
                    </h4>
                    <div class="product-card__text-price">
                      @if ($product->discount > 0)
                        <span class="product-card__text-current-price">
                          {{ $product->unit_price - $product->unit_price * $product->discount }} Đ
                        </span>
                        <span class="product-card__text-old-price">{{ $product->unit_price }}Đ</span>
                      @else
                        <span class="product-card__text-current-price">
                          {{ $product->unit_price }}Đ
                        </span>
                      @endif

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
                    <button type="button" class="product-card__btn" onclick="addCart('{{ $product->id }}')">
                      <span id="ADD_CART" class="multilang">Thêm vào giỏ hàng</span>
                    </button>
                  </div>
                </a>
              </div>
            @endforeach
          @else
            <h2 class="text-center mt-5">Không tìm thấy sản phẩm</h2>
          @endif
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-sm-12 col-lg-3"></div>
      <div class="col-sm-12 col-lg-9">
        <div class="col-12 d-flex justify-content-center">
          {{ $products->links() }}
        </div>
      </div>
    </div>
  </form>
@endsection
