
<!doctype html>
<html lang="en">

@include('partials._head')

<body style="background-color: #272b2f !important; color: #d9534f !important;">

{{--@include("partials._nav") wrong--}}

<div class="container">
  <div class="row">
      @yield('authcontent')
  </div>
</div> <!-- End of Container-->

@include('partials._script')

@yield('script')
</body>
</html>