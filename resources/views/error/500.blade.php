<!--
=========================================================
* Soft UI Dashboard PRO - v1.0.7
=========================================================

* Product Page:  https://www.creative-tim.com/product/soft-ui-dashboard-pro
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

@include('admin.partials.head');

<body class="error-page">
  <!-- End Navbar -->
  <main class="main-content  mt-0">
    <div>
      <section class="min-vh-100 d-flex align-items-center">
        <div class="container">
          <div class="row mt-lg-0 mt-8">
            <div class="col-lg-5 my-auto">
              <h1 class="display-1 text-bolder text-gradient text-warning fadeIn1 fadeInBottom mt-5">Error 500</h1>
              <h2 class="fadeIn3 fadeInBottom opacity-8">Something went wrong</h2>
              <p class="lead opacity-6 fadeIn2 fadeInBottom">We suggest you to go to the homepage while we solve this issue.</p>
              <a href="{{route('dashboard')}}"  class="btn bg-gradient-warning mt-4 fadeIn2 fadeInBottom">Go to Homepage</a>
            </div>
            <div class="col-lg-7 my-auto">
              <img class="w-100 fadeIn1 fadeInBottom" src="{{asset('tadmin/assets/img/illustrations/error-500.png')}}" alt="500-error">
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>

  @include('admin.partials.footer')
  @include('admin.partials.scripts')
</body>

</html>
