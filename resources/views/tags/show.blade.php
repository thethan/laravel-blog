@extends('layouts.main')


@section('content')
    <section class="hero is-medium is-dark is-bold">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    {{ $tag->name }}
                </h1>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="columns">
                @php
                    $posts = $tag->posts()->paginate();
                @endphp
                <div class="column is-8">
                    {{ $posts->links() }}
                    @foreach ($posts as $post)

                        @include('posts.listing.articleblock')

                    @endforeach
                </div>
                <aside class="column is-4">
                    <h5 class="title is-3">More Tags</h5>
                    <nav>
                        @foreach(App\Tag::all() as $nav)
                            @if($nav->id !== $tag->id)
                                <a href="{{ route('tags.show', ['slug' =>$nav->slug]) }}"
                                   class="tag is-primary">{{ $nav->name }}</a>
                            @endif
                        @endforeach
                    </nav>

                </aside>
            </div>
        </div>
    </section>
@stop