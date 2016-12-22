@foreach ($items as $item)
    <a class="nav-item" href="{{ $item->url }}" target="{{$item->target}}">
        {{ $item->title }}
    </a>
@endforeach