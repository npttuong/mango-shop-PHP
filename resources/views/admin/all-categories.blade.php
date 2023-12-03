@extends('admin.layout-admin')

@section('content')
  <h2 class="my-5 page-heading">Danh sách các loại sản phẩm</h2>
  @if (session()->has('deleteSuccess'))
    <div class="alert alert-success" role="alert">
      {{ session()->get('deleteSuccess') }}
    </div>
  @endif
  <div class="table-responsive">
    <table class="table table-striped table-hover table-lg">
      <thead>
        <th>ID</th>
        <th style="width: 80%">Tên loại sản phẩm</th>
        <th></th>
        <th></th>
      </thead>
      <tbody>
        @foreach ($categories as $category)
          <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->category_name }}</td>
            <td>
              <a href="/admin/update-category/{{ $category->id }}" class="btn btn-primary">
                Sửa
              </a>
            </td>
            <td>
              <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal"
                data-bs-whatever="{{ $category->id }}">
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
      {{ $categories->links() }}
    </div>
  </div>
  <div class="modal fade fs-3" id="deleteCategoryModal" tabindex="-1" aria-labelledby="deleteCategoryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title fs-3" id="deleteCategoryModalLabel">Thông báo</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Tất cả sản phẩm thuộc loại này sẽ bị xóa. Bạn có thực sự muốn xóa?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-lg" data-bs-dismiss="modal">Hủy</button>
          <button type="button" class="btn btn-danger btn-lg" id="deleteCategoryBtn">Xóa</button>
        </div>
      </div>
    </div>
  </div>

  <form method="post" name="frmDeleteCategory">
    @csrf
    @method('delete')
  </form>
@endsection

@section('js')
  <script>
    const deleteCategoryModal = document.getElementById('deleteCategoryModal');
    const delCategoryBtn = document.getElementById('deleteCategoryBtn');
    const frmDeleteCategory = document.forms['frmDeleteCategory'];
    if (deleteCategoryModal) {
      deleteCategoryModal.addEventListener('show.bs.modal', event => {
        // Button that triggered the modal
        const button = event.relatedTarget;
        // Extract info from data-bs-* attributes
        const category_id = button.getAttribute('data-bs-whatever');

        frmDeleteCategory.setAttribute('action', '/admin/delete-category/' + category_id);
      })
    }

    delCategoryBtn.addEventListener('click', e => {
      frmDeleteCategory.submit();
    });
  </script>
@endsection
