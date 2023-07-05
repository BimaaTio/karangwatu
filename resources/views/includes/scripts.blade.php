<!-- Bootstrap core JavaScript-->
<script src="/sb/vendor/jquery/jquery.min.js"></script>
<script src="/sb/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="/sb/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="/sb/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="/sb/vendor/chart.js/Chart.min.js"></script>
<script src="/sb/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="/sb/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!-- Configure script -->
<script type="text/javascript">
  $(document).ready(function() {
    $('#kontenBerita').summernote();
    $('#listBerita').DataTable({
      responsive: true,
      "autoWidth": false
    });
    $('#listKategori').DataTable({
      responsive: true,
      "autoWidth": false
    });
  });

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
  }
</script>
@if(session()->has('success'))
<script>
  toastr.success("Nice! {{ session('success') }}");
</script>
@elseif(session()->has('error'))
<script>
  toastr.danger("Oops! {{ session('error') }}");
</script>
@endif