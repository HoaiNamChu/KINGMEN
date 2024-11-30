<li class="{{ $item->children->count() ? 'has-submenu' : ' ' }}"><a href=""><span>{{ $item->name }}</span></a>
    @if($item->children->count())
        <ul class="submenu-nav">
            @foreach($item->children as $itemChildren)
                @include('client.layouts.components.category-nav', ['item' => $itemChildren])
            @endforeach
        </ul>
    @endif
</li>
