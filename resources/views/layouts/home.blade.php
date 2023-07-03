<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dusun Wayang Karangwatu</title>
  <!-- links-->
  @include('partials.home.link')
  <!-- /Links -->
</head>
<style>

</style>

<body id="beranda">
  <!-- Header -->
  @include('partials.home.header')
  <!-- /header -->

  @yield('content')

  <!-- Scrript -->
  @include('partials.home.script')
  <!-- /Script -->
</body>

</html>