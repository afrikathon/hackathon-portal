<div class="wrapper">

    @include('layouts.navbars.auth')

    <div class="main-panel" style="width: 100%">
        @include('layouts.navbars.navs.auth')
        @yield('content')
        @include('layouts.footer')
    </div>
</div>
