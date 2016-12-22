@extends('layouts.main')

@section('content')
    <section class="hero is-medium is-success is-bold">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    {{ $title or Voyager::setting('title') }}
                </h1>
                <h2 class="subtitle">
                    {{ $body or Voyager::setting('description') }}
                </h2>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="tile is-ancestor">
            @foreach($posts->all() as $post)
                @if($loop->index === 0)
                    <div class="tile is-vertical is-8">
                        <div class="tile">
                            <div class="tile is-parent is-vertical">
                                @endif
                                @if(in_array($loop->index, [0,1]))
                                    @include('tile.article-box')
                                @endif
                                @if($loop->index === 1)
                            </div>{{-- tile is-parent is-vertical--}}
                            @endif
                            @if($loop->index === 2)
                                <div class="tile is-parent">
                                    @include('tile.article-box')
                                </div>
                        </div> {{-- tile --}}
                        @endif
                        @if($loop->index === 3)
                            <div class="tile is-parent">
                                @include('tile.article-box')
                            </div>
                    </div> {{-- tile is-vertical is-8 --}}
                @endif
                @if($loop->index === 4)
                    <div class="tile is-parent">
                        @include('tile.article-box')
                    </div>
                @endif
            @endforeach
        </div>
    </section>
@endsection

@push('scripts')
<script>
    var h2_tags = document.getElementsByTagName('h2');
    console.log(h2_tags);
</script>
@endpush