@extends('layouts.main')


@section('content')
    <section class="hero is-medium is-primary is-bold">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    {{ $rating->name }}
                </h1>
                <p class="subtitle">
                    {{ $rating->description }}
                </p>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="columns">
                @php
                $posts = $rating->posts()->paginate();
                @endphp
                {{ $posts->links() }}
                @foreach ($posts as $post)
                    @foreach ($posts as $post)
                        @include('posts.listing.articleblock')
                    @endforeach
                @endforeach
                <aside class="column is-4">
                    <nav>
                        <ul>
                            @php
                            $ratings = App\Rating::all();
                            @endphp
                            @foreach(App\Rating::all() as $nav)
                                @if($nav->id !== $rating->id)
                                <li><a href="{{ route('ratings.show', ['slug' => $nav->slug]) }}">{{ $nav->name }}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </nav>

                </aside>
            </div>
        </div>
    </section>
@stop