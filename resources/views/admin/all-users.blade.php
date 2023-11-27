@extends('admin.layout-admin')

@section('content')
  <h2 class="my-5 page-heading">Danh sách người dùng</h2>
  @if (session()->has('deleteSuccess'))
    <div class="alert alert-success" role="alert">
      {{ session()->get('deleteSuccess') }}
    </div>
  @endif
  <div class="table-responsive">
    <table class="table table-striped table-hover table-lg">
      <thead>
        <th>Tên người dùng</th>
        <th>Email</th>
        <th>Số điện thoại</th>
        <th>Tỉnh thành</th>
        <th>Quyền sử dụng</th>
        <th style="with: 5%;"></th>
        <th style="with: 5%;"></th>
      </thead>
      <tbody>
        @foreach ($users as $user)
          <tr>
            <td>{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone_number }}</td>
            <td>{{ $user->city }}</td>
            <td>{{ $user->role_name }}</td>
            <td>
              <a href="/admin/update-user/{{ $user->username }}" class="btn btn-primary">
                Sửa
              </a>
            </td>
            <td>
              <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteUserModal"
                data-bs-whatever="{{ $user->username }}">
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
      {{ $users->links() }}
    </div>
  </div>
  <div class="modal fade fs-3" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title fs-3" id="deleteUserModalLabel">Thông báo</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Người dùng sau khi xóa không thể phục hồi. Bạn có thực sự muốn xóa?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-lg" data-bs-dismiss="modal">Hủy</button>
          <button type="button" class="btn btn-danger btn-lg" id="deleteUserBtn">Xóa</button>
        </div>
      </div>
    </div>
  </div>

  <form method="post" name="frmDeleteUser">
    @csrf
    @method('delete')
  </form>
@endsection

@section('js')
  <script>
    const deleteUserModal = document.getElementById('deleteUserModal');
    const delUserBtn = document.getElementById('deleteUserBtn');
    const frmDeleteUser = document.forms['frmDeleteUser'];
    if (deleteUserModal) {
      deleteUserModal.addEventListener('show.bs.modal', event => {
        // Button that triggered the modal
        const button = event.relatedTarget;
        // Extract info from data-bs-* attributes
        const username = button.getAttribute('data-bs-whatever');

        frmDeleteUser.setAttribute('action', '/admin/delete-user/' + username);
      })
    }

    delUserBtn.addEventListener('click', e => {
      frmDeleteUser.submit();
    });
  </script>
@endsection
