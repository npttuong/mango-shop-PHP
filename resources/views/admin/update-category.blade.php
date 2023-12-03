@extends('admin.layout-admin')

@section('content')
  <h2 class="mb-5 page-heading">Cập nhật loại sản phẩm mới</h2>
  @if (session()->has('createSuccess'))
    <div class="alert alert-success" role="alert">
      {{ session()->get('createSuccess') }}
    </div>
  @endif

  @if (session()->has('createFailed'))
    <div class="alert alert-danger" role="alert">
      {{ session()->get('createFailed') }}
    </div>
  @endif


  <form class="row g-3 fs-4" action="/admin/create-category" method="post" enctype="application/x-www-form-urlencoded"
    novalidate>
    @csrf
    <div class="col-12">
      <label for="inputCategoryName4" class="form-label">Tên loại sản phẩm:</label>
      <input type="text" class="form-control form-control-lg" id="inputCategoryName4" maxlength="128"
        name="category_name" required value="{{ $category->category_name }}">
      @if ($errors->has('category_name'))
        <div class="text--errors">
          {{ $errors->first('category_name') }}
        </div>
      @endif
    </div>
    <div class="col-12 d-flex justify-content-center">
      <button type="submit" class="btn btn-primary btn-lg">Tạo loại sản phẩm</button>
    </div>
  </form>
@endsection

@section('js')
@endsection
