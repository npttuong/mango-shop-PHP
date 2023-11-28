<script>
  toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  };
  @if (session()->has('success'))
    toastr.success('{{ session()->get('success') }}', 'Thành công');
  @endif
  @if (session()->has('error'))
    toastr.error('{{ session()->get('error') }}', 'Thất bại');
  @endif
</script>
