<article class="column media">
    <div class="media-content">
        <div class="content">
            <h3 class="title is-3">
                <a class="is-success" href="{{ route('blog.show', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
            </h3>
            <p class="title is-4">{{ $post->created_at }}</p>
            <p class="Content">
                {{ $post->excerpt }}
            </p>
        </div>
    </div>
</article>