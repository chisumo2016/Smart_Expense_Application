
<!doctype html>
<html lang="en">
@include('partials._head')
<body>

    @include("partials._nav")

        <div class="container">
            @include("partials._errors")

            @yield('content')




        </div> <!-- End of Container-->
    @include("partials._footer")
    @include('partials._script')

    @yield('script')


</body>
</html>