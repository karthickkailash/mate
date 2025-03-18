<!DOCTYPE html>
<html lang="en">


<div class="main-wrapper">
    @includeIf('nav')
    <!-- Header-area start -->
    @includeIf('home')
    <!-- Header-area end -->
    @includeIf('footer')
    @yield('content')
</div>

</html>
