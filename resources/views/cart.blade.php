@extends('layout')

@section('js')
  <!-- Custom select input -->
  <script src="/js/increase-input-custom.js"></script>
  <script>
    $(document).ready(function() {
      $('.incremment-minus, .incremment-plus').each(function(i, element) {
        $(element).on('click', function(e) {
          const product_id = $(this).data('productId');
          const quantity = $(`input[name=quantity_${$(this).data('productId')}]`).val();
          $.ajax({
            url: '/update-cart',
            method: "GET",
            data: {
              id: product_id,
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
          @foreach (session('cart') as $product_id => $detail)
            <tr>
              <td class="text-overflow">
                <img src="/img/{{ $detail['image'] }}" class="small-img me-2">
                <span>{{ $detail['name'] }}</span>
              </td>
              <td class="price">{{ $detail['price'] }}</td>
              <td>S</td>
              <td>Đen</td>
              <td>
                <div class="incremment-wrapper incremment--small">
                  <span class="incremment-minus" data-product-id="{{ $product_id }}">-</span>
                  <span class="incremment-num">{{ $detail['quantity'] }}</span>
                  <span class="incremment-plus" data-product-id="{{ $product_id }}">+</span>
                  <input type="number" class="quantity" name="quantity_{{ $product_id }}"
                    data-product-id="{{ $product_id }}" value="{{ $detail['quantity'] }}" min="1" step="1"
                    hidden>
                </div>
              </td>
              <td class="price">{{ $detail['price'] * $detail['quantity'] }}</td>
              <td>
                <a href="/remove-cart/{{ $product_id }}" class="btn btn-danger">
                  <i class="fa-solid fa-xmark"></i>
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <h2 class="text-center">Chưa thêm sản phẩm vào giỏ hàng</h2>
    @endif
  </div>
@endsection
