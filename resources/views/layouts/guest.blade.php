<!DOCTYPE html>
<html lang="en">

@include('guest.partials.head')

<body>

  <!-- ======= Header ======= -->
  @include('guest.partials.navbar')

  <!-- ======= Hero Section ======= -->
  @yield('carousel')

  <main id="main">

   {{$slot}}

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  @include('guest.partials.footer')

  @include('guest.partials.scripts')

</body>

</html>