@php
use Illuminate\Support\Str;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Dusun Wayang Karangwatu - Dashboard</title>

  <!-- Custom fonts for this template-->
  @include('includes.links')

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    @include('partials.sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        @include('partials.topbar')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          @yield('content')
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

      @include('partials.footer')

      @include('partials.modal')

      @include('includes.scripts')

      <!-- Page level custom scripts -->
</body>

</html>