<!DOCTYPE html>
<html>
<head>

    @stack('meta')

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
    <script>
                window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>

</head>
<body>
<div class="container-fluid">
    @include('layouts.menu.nav')

    @yield('content')

    <footer class="footer">
        <div class="container">
            <div class="content has-text-centered">

            </div>
        </div>
    </footer>
</div>
<script>

    document.getElementById("nav-toggle").addEventListener("click", toggleNav);
    function toggleNav() {
        var nav = document.getElementById("nav-menu");
        var className = nav.getAttribute("class");
        if (className == "nav-right nav-menu") {
            nav.className = "nav-right nav-menu is-active";
        } else {
            nav.className = "nav-right nav-menu";
        }
    }

</script>
@stack('scripts')
</body>

</html>
