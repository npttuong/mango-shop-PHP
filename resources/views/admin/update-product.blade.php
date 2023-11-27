@extends('admin.layout-admin')

@section('content')
  <h2 class="mb-5 page-heading">Cập nhật sản phẩm</h2>
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


  <form class="row g-3 fs-4" action="/admin/update-product/{{ $product->id }}" method="post" enctype="multipart/form-data"
    novalidate>
    @csrf
    @method('put')
    <div class="col-md-6">
      <label for="inputProductName4" class="form-label">Tên sản phẩm:</label>
      <input type="text" class="form-control form-control-lg" id="inputProductName4" maxlength="256"
        name="product_name" value="{{ $product->product_name }}" required>
      @if ($errors->has('product_name'))
        <div class="text--errors">
          {{ $errors->first('product_name') }}
        </div>
      @endif
    </div>
    <div class="col-6">
      <label for="categorySelectInput" class="form-label">Loại sản phẩm:</label>
      <select class="form-select form-select-lg" id="categorySelectInput" name="category_id">
        @foreach ($categories as $category)
          <option value="{{ $category->id }}" @if ($product->category_id == $category->id) selected @endif>
            {{ $category->category_name }}
          </option>
        @endforeach
      </select>
      @if ($errors->has('category_id'))
        <div class="text--errors">
          {{ $errors->first('category_id') }}
        </div>
      @endif
    </div>
    <div class="col-md-6">
      <label for="inputProductPrice4" class="form-label">Giá sản phẩm:</label>
      <input type="number" class="form-control form-control-lg" id="inputProductPrice4" min="1000" max="999999999"
        step="1000" name="unit_price" value="{{ $product->unit_price }}">
      @if ($errors->has('unit_price'))
        <div class="text--errors">
          {{ $errors->first('unit_price') }}
        </div>
      @endif
    </div>
    <div class="col-md-6">
      <label for="inputProductDiscount4" class="form-label">Phần trăm khuyến mãi:</label>
      <input type="number" class="form-control form-control-lg" id="inputProductDiscount4" min="0" max="1"
        step="0.05" name="discount" value="{{ $product->discount }}">
    </div>
    <div class="col-md-6" id="quantitySizeField">
      @php
        $i = 1;
      @endphp
      @foreach ($product->sizes as $itemA)
        <div class="row mb-3 sizeProductItem">
          <div class="col-6">
            <label class="form-label">Số lượng:</label>
            <input type="number" class="form-control form-control-lg" min="1" max="9999"
              name="sizeProduct_{{ $i }}[]" required value="{{ $itemA->pivot->quantity }}">
            @if (session()->has('messageSize'))
              <div class="text--errors">
                {{ session()->get('messageSize') }}
              </div>
            @endif
          </div>

          <div class="col-6">
            <label for="sizeSelectInput" class="form-label">Kích cỡ:</label>
            <select required class="form-select form-select-lg" id="sizeSelectInput"
              name="sizeProduct_{{ $i }}[]">
              @foreach ($sizes as $itemB)
                <option value="{{ $itemB->size }}" @if ($itemA->size == $itemB->size) selected @endif>
                  {{ $itemB->size }}
                </option>
              @endforeach
            </select>
          </div>
        </div>
        @php
          $i++;
        @endphp
      @endforeach
    </div>

    <div class="col-md-6" id="quantityColorField">
      @php
        $i = 1;
      @endphp
      @foreach ($product->colors as $itemA)
        <div class="row mb-3 colorProductItem">
          <div class="col-6">
            <label class="form-label">Số lượng:</label>
            <input type="number" class="form-control form-control-lg" min="1" max="9999"
              name="colorProduct_{{ $i }}[]" required value="{{ $itemA->pivot->quantity }}">
            @if (session()->has('messageColor'))
              <div class="text--errors">
                {{ session()->get('messageColor') }}
              </div>
            @endif
          </div>

          <div class="col-6 ">
            <label for="colorSelectInput" class="form-label">Màu:</label>
            <select class="form-select form-select-lg" id="colorSelectInput" name="colorProduct_{{ $i }}[]"
              required>
              @foreach ($colors as $itemB)
                <option value="{{ $itemB->color_code }}" @if ($itemA->color_code == $itemB->color_code) selected @endif>
                  {{ $itemB->color }}
                </option>
              @endforeach
            </select>
          </div>
        </div>
        @php
          $i++;
        @endphp
      @endforeach
    </div>
    <div class="col-md-4">
      <label for="formFile" class="form-label">Cập nhật hình ảnh sản phẩm:</label>
      <input class="form-control form-control-lg" type="file" id="formFile" name="illustrations[]" multiple>
      @if ($errors->has('illustrations'))
        <div class="text--errors">
          {{ $errors->first('illustrations') }}
        </div>
        @error('illustrations.*')
          <span class="text-danger">{{ $message }}</span>
        @enderror
      @endif
    </div>
    <div class="col-md-8">
      <label for="inputShortDescription" class="form-label">Mô tả ngắn về sản phẩm:</label>
      <input type="text" class="form-control form-control-lg" id="inputShortDescription" name="product_short_des"
        value="{{ $product->product_short_des }}">
      @if ($errors->has('product_short_des'))
        <div class="text--errors">
          {{ $errors->first('product_short_des') }}
        </div>
      @endif
    </div>
    <div class="col-12 border border-secondary p-3">
      @if (count($illustrations) == 0)
        <h3>Sản phẩm không có hình ảnh minh họa</h3>
      @else
        <h3>Hình ảnh của sản phẩm:</h3>
        @foreach ($illustrations as $illustration)
          <div class="d-inline-block update-product__img-wrapper">
            <img src="/img/{{ $illustration->illustration_path }}" style="width:200px; height:200px;">
            <div class="update-product__img-close-btn"
              onclick="deleteIllustration('{{ $illustration->illustration_path }}');">
              <i class="fa-solid fa-xmark"></i>
            </div>
          </div>
        @endforeach
      @endif
    </div>

    <div class="col-6">
      <label for="productInfoTextarea" class="form-label">Thông tin sản phẩm:</label>
      <textarea class="form-control form-control-lg" id="productInfoTextarea" rows="10" name="product_info">{{ $product->product_info }}</textarea>
    </div>
    <div class="col-6">
      <label for="productDescriptionTextarea" class="form-label">Mô tả sản phẩm:</label>
      <textarea class="form-control form-control-lg" id="productDescriptionTextarea" rows="10"
        name="product_description">{{ $product->product_description }}</textarea>
    </div>
    <div class="col-12 d-flex justify-content-center my-3">
      <button type="button" class="btn btn-primary btn-lg me-5" id="addSizeProductBtn">Thêm số lượng cho kích cỡ khác
        khác</button>
      <button type="button" class="btn btn-primary btn-lg" id="addColorProductBtn">Thêm số lượng cho màu khác</button>
    </div>
    <div class="col-12 d-flex justify-content-center">
      <button type="submit" class="btn btn-primary btn-lg">Cập nhật sản phẩm</button>
    </div>
  </form>

  <form method="post" name="frmDeleteIllustration">
    @csrf
    @method('DELETE')
  </form>
@endsection

@section('js')
  <script src="/js/create-product.js"></script>
  <script src="/js/update-product.js"></script>
@endsection
