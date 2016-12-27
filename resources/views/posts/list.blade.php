@extends('layouts.main')


@section('content')
    <section class="hero is-medium is-primary is-bold">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Encounters
                </h1>

            </div>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="is-8">
                    {{ $posts->links() }}
                    @foreach ($posts as $post)
                            @include('posts.listing.articleblock')
                    @endforeach
                </div>
                <aside class="column is-4">


                </aside>
            </div>
        </div>
    </section>
@stop