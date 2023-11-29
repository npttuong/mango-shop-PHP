@extends('admin.layout-admin')

@section('content')
  <h2 class="my-5 page-heading">Danh sách các sản phẩm</h2>
  @if (session()->has('deleteSuccess'))
    <div class="alert alert-success" role="alert">
      {{ session()->get('deleteSuccess') }}
    </div>
  @endif
  <div class="table-responsive fs-4">
    <table class="table table-striped table-hover table-lg">
      <thead>
        <th style="width: 5%">ID</th>
        <th style="width: 40%">Tên sản phẩm</th>
        <th style="width: 15%">Loại sản phẩm</th>
        <th style="width: 10%">Giá</th>
        <th style="width: 10%">Khuyến mãi</th>
        <th style="width: 5%"></th>
        <th style="width: 5%"></th>
      </thead>
      <tbody>
        @foreach ($products as $product)
          <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->product_name }}</td>
            <td>{{ $product->category->category_name }}</td>
            <td>{{ $product->unit_price }}</td>
            <td>{{ $product->discount }}</td>
            <td>
              <a href="/admin/update-product/{{ $product->id }}" class="btn btn-primary">
                Sửa
              </a>
            </td>
            <td>
              <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteProductModal"
                data-bs-whatever="{{ $product->id }}">
                Xóa
              </button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="d-flex justify-content-center my-4">
    <div>
      {{ $products->links() }}
    </div>
  </div>
  <div class="modal fade fs-3" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title fs-3" id="deleteProductModalLabel">Thông báo</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Sản phẩm sau khi xóa không thể phục hồi. Bạn có thực sự muốn xóa?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-lg" data-bs-dismiss="modal">Hủy</button>
          <button type="button" class="btn btn-danger btn-lg" id="deleteProductBtn">Xóa</button>
        </div>
      </div>
    </div>
  </div>

  <form method="post" name="frmDeleteProduct">
    @csrf
    @method('delete')
  </form>
@endsection

@section('js')
  <script>
    const deleteProductModal = document.getElementById('deleteProductModal');
    const delProductBtn = document.getElementById('deleteProductBtn');
    const frmDeleteProduct = document.forms['frmDeleteProduct'];
    if (deleteProductModal) {
      deleteProductModal.addEventListener('show.bs.modal', event => {
        // Button that triggered the modal
        const button = event.relatedTarget;
        // Extract info from data-bs-* attributes
        const product_id = button.getAttribute('data-bs-whatever');

        frmDeleteProduct.setAttribute('action', '/admin/delete-product/' + product_id);
      })
    }

    delProductBtn.addEventListener('click', e => {
      frmDeleteProduct.submit();
    })
  </script>
@endsection
