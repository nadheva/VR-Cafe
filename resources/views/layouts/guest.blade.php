<!DOCTYPE html>
<html lang="en">

@include('guest.partials.head')
<!--Start of Tawk.to Script-->
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
  <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/62522e927b967b117989aa51/1g08gbr9t';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
</body>

</html>
