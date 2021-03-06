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

    @yield('content')

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
