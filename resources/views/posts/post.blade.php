@extends('layouts.main')


@section('content')
    <section class="hero is-medium is-dark is-bold">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    {{ $post->title }}
                </h1>
                <p class="subtitle">{{ $post->excerpt }}</p>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="columns">
                <article class="column is-8">
                    {!! $post->body !!}
                </article>

                <aside class="menu">
                    @if($post->category)
                        <p class="menu-label">
                            Category
                        </p>
                        <ul class="menu-list">

                            @include('layouts.menu.blog_item', ['route' => 'categories.show', 'item' => $post->category])
                        </ul>
                    @endif
                    @if($post->tags)
                        <p class="menu-label">
                            Tags
                        </p>
                        <ul class="menu-list">
                            @foreach($post->tags->all() as $tag)
                                @include('layouts.menu.blog_item', ['route' => 'tags.show', 'item' => $tag])
                                @php
                                    // Sort the created at and then see if they
                                    $posts = $tag->posts->sortByDesc('created_at')->reject(function($value, $key) use($post){
                                        return $value->status !== 'PUBLISHED' || $post->id === $value->id;
                                    });
                                    // if the size is greater than 3
                                    if($posts->count() > 3){
                                        $posts = $posts->splice(3);
                                    }
                                @endphp
                                @if($posts->count() > 1)
                                    <li>
                                        <ul>
                                            @foreach($posts->all() as $item)
                                                @include('layouts.menu.blog_item', ['route' => 'blog.show'])
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif


                            @endforeach
                        </ul>
                    @endif
                    @php
                        $featured = App\Post::where('featured', 1)->orderBy('created_at', 'desc')->take(4)->get();
                        $featured = $tag->posts->sortByDesc('created_at')->reject(function($value, $key) use($post){
                                        return $value->status !== 'PUBLISHED' || $post->id === $value->id;
                                    });

                    @endphp
                    @if($featured->count())
                        <p class="menu-label">
                            Featured Posts
                        </p>
                        <ul class="menu-list">
                            @foreach($featured->all() as $featuredPost)
                                @include('layouts.menu.blog_item', ['route' => 'blog.show', 'item' => $featuredPost])
                            @endforeach
                        </ul>
                    @endif
                </aside>

            </div>
        </div>
    </section>
@endsection

@push('meta')
<title>{{ $post->seo_title or $post->title }} </title>
<meta name="description" content="{{ $post->meta_description }}">
<meta name="keywords" content="{{$post->meta_keywords}}t">
@endpush

@push('styles')
<style>
    .hero.is-medium.is-success.is-bold {
        background-image: url("{{storage_path($post->image)}}");
    }
</style>
@endpush