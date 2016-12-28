@extends('layouts.home')

@section('content')
    <section class="hero is-dark is-fullheight">
        <!-- Hero header: will stick at the top -->
        <div class="hero-head">
            {{--<header class="nav">--}}
                {{--<div class="container">--}}
                    {{--<div class="nav-left">--}}
                        {{--<a class="nav-item">--}}
                            {{--<img src="images/bulma-type-white.png" alt="Logo">--}}
                        {{--</a>--}}
                    {{--</div>--}}
                    {{--<span class="nav-toggle">--}}
                      {{--<span></span>--}}
                      {{--<span></span>--}}
                      {{--<span></span>--}}
                    {{--</span>--}}
                    {{--<div class="nav-right nav-menu">--}}
                        {{--<a class="nav-item is-active">--}}
                            {{--Home--}}
                        {{--</a>--}}
                        {{--<a class="nav-item">--}}
                            {{--Examples--}}
                        {{--</a>--}}
                        {{--<a class="nav-item">--}}
                            {{--Documentation--}}
                        {{--</a>--}}
                        {{--<span class="nav-item">--}}
            {{--<a class="button is-primary is-inverted">--}}
              {{--<span class="icon">--}}
                {{--<i class="fa fa-github"></i>--}}
              {{--</span>--}}
              {{--<span>Download</span>--}}
            {{--</a>--}}
          {{--</span>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</header>--}}
            @include('layouts.menu.nav')
        </div>

        <!-- Hero content: will be in the middle -->
        <div class="hero-body">
            <div class="container has-text-centered">
                <h1 class="title">
                    Title
                </h1>
                <h2 class="subtitle">
                    Subtitle
                </h2>
            </div>
        </div>

        <!-- Hero footer: will stick at the bottom -->
        <div class="hero-foot">
            <nav class="tabs">
                <div class="container">
                    {!! Menu::display('footer_pages', 'layouts.menu.items') !!}
                </div>
            </nav>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    var h2_tags = document.getElementsByTagName('h2');
    console.log(h2_tags);
</script>
@endpush