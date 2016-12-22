@extends('layouts.main')


@section('content')
    <section class="hero is-medium is-success is-bold">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    {{ $post->title }}
                </h1>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="columns">
                <article class="column is-8">
                    {!! $post->body !!}
                </article>
                <aside class="column is-4">
                    @if($post->category)
                        <h3><a href="{{ route('getCategory', ['slug' => $post->category->slug]) }}">{{ $post->category->name }}</a></h3>
                        @php
                            $categoryPosts = $post->category->posts->sortBy('created_at');
                        @endphp
                        <ul>
                        @foreach($categoryPosts as $catPost)
                            @if($catPost->id !== $post->id)
                                <li><a href="{{ route('getPost', ['slug' => $catPost->slug]) }}">{{ $catPost->name }}</a></li>
                            @endif
                        @endforeach
                        </ul>

                    @endif

                    @if($post->tags)
                    <h4>Tags:</h4>
                        @foreach($post->tags as $tag)
                            <a href="{{ $tag->slug }}" class="tag is-success">{{ $tag->name }}</a>
                        @endforeach

                        @endif
                </aside>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    .hero.is-medium.is-success.is-bold {
        background-image: url("{{storage_path($post->image)}}");
    }
</style>
@endpush