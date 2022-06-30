<!DOCTYPE html>
<html lang="en">

@include('admin.partials.head')
{{-- @include('noty::message')
@notifyCss --}}
{{-- @include('notify::messages') --}}
<body class="g-sidenav-show  bg-gray-100">
    @include('admin.partials.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        @include('admin.partials.navbar')
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            {{-- @include('admin.partials.flash-message') --}}
            @include('sweetalert::alert')
            {{ $slot }}

            @include('admin.partials.footer')

        </div>
    </main>
    @include('admin.partials.scripts')

</body>

</html>
