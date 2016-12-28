<li>
    <a href="{{ route($route, ['slug' => $item->slug]) }}">{{ $item->title or $item->name }}</a>
</li>