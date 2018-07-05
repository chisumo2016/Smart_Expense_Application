<!doctype html>
<html lang="en">
@include('partials._head')
<body>

    @include("partials._nav")

        <div class="container">
            @include("partials._errors")

            @yield('content')



            @include("partials._footer")
        </div> <!-- End of Container-->
    @yield('script')
</body>
</html>