<article class="tile is-child box">
    <a href="{{ $post->slug }}"> @include('posts.title')</a>
    @include('posts.excerpt')
    <a href="{{  route('getPost', ['slug' => $post->slug]) }}" class="button is-primary is-active">Read More</a>
</article>

