@extends('layouts.main')


@section('content')
    <section class="hero is-medium is-primary is-bold">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    {{ $category->name }}
                </h1>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="columns">
                @php
                    $posts = $category->posts()->paginate();

                @endphp
                {{ $posts->links() }}
                @foreach ($posts as $post)
                    @include('posts.listing.articleblock')
                @endforeach
                <aside class="column is-4">
                    <h5 class="title is-3">More Categories</h5>
                    <nav>
                        @foreach(App\Category::all() as $nav)
                            @if($nav->id !== $category->id)
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