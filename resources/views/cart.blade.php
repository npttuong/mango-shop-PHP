@extends('layout')

@section('js')
  <!-- Custom select input -->
  <script src="/js/increase-input-custom.js"></script>
  <script>
    $(document).ready(function() {
      $('.incremment-minus, .incremment-plus').each(function(i, element) {
        $(element).on('click', function(e) {
          const cartName = $(this).data('cart');
          const quantity = parseInt($(`input[name=quantity_${cartName}]`).val());
          console.log(cartName, quantity);
          $.ajax({
            url: '/update-cart',
            method: "GET",
            data: {
              cartName: cartName,
              quantity: quantity
            },
            success: function(response) {
              window.location.reload();
            }
          });
        });
      });
    });
  </script>
@endsection

@section('page-title')
  <title>Giỏ hàng</title>
@endsection

@section('content')
  <div class="row bg--white">
    <div class="col-12">
      <nav aria-label="breadcrumb" class="pt-4 pb-3 px-4">
        <ol class="breadcrumb fs-4">
          <li class="breadcrumb-item">
            <a href="/">Trang chủ</span></a>
          </li>
          <li class="breadcrumb-item">
            <a href="/shop">Mua sắm</span></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">
            <span>Giỏ hàng</span>
          </li>
        </ol>
      </nav>
    </div>
  </div>
  <div class="spacing-section-32"></div>

  <div class="table-responsive">
    @if (session('cart'))
      <table style="width: 100%" class="table table-hover align-middle my-table fs-4">
        <thead class="table-thead">
          <th>Sản phẩm</th>
          <th style="min-width: 80px">Đơn giá</th>
          <th style="min-width: 80px">Kích cỡ</th>
          <th style="min-width: 80px">Màu sắc</th>
          <th style="min-width: 120px">Số lượng</th>
          <th style="min-width: 150px">Thành tiền</th>
          <th>Xóa</th>
        </thead>

        <tbody>
          @foreach (session('cart') as $cartName => $detail)
            @php
              $product_id = explode('_', $cartName)[0];
              $colorName = $colors->find($detail['color'])->color;
            @endphp
            <tr>
              <td class="text-overflow">
                <img src="/img/{{ $detail['image'] }}" class="small-img me-2">
                <span>{{ $detail['name'] }}</span>
              </td>
              <td class="price">{{ $detail['price'] }}</td>
              <td data-cart="{{ $cartName }}">{{ $detail['size'] }}</td>
              <td data-cart="{{ $cartName }}" data-color="{{ $detail['color'] }}">{{ $colorName }}</td>
              <td>
                <div class="incremment-wrapper incremment--small">
                  <span class="incremment-minus" data-cart="{{ $cartName }}">-</span>
                  <span class="incremment-num">{{ $detail['quantity'] }}</span>
                  <span class="incremment-plus" data-cart="{{ $cartName }}">+</span>
                  <input type="number" class="quantity" name="quantity_{{ $cartName }}"
                    value="{{ $detail['quantity'] }}" min="1" step="1" hidden>
                  {{-- data-product-id="{{ $product_id }}" --}}
                </div>
              </td>
              <td class="price">{{ $detail['price'] * $detail['quantity'] }}</td>
              <td>
                <a href="/remove-cart/{{ $cartName }}" class="btn btn-danger">
                  <i class="fa-solid fa-xmark"></i>
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <div class="text-center">
        <h2 class="text-center">Chưa thêm sản phẩm vào giỏ hàng.</h2>
        <a href="/shop" class="link-info fs-3">Đi tới trang mua sắm</a>
      </div>
    @endif
  </div>
@endsection
