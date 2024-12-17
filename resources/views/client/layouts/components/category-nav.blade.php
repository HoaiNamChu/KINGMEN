<li class="{{ $item->children ? 'has-submenu' : ' ' }}"><a href=""><span>{{ $item->name }}</span></a>
    @if($item->children)
        <ul class="submenu-nav">
            @foreach($item->children as $itemChildren)
                @include('client.layouts.components.category-nav', ['item' => $itemChildren])
            @endforeach
        </ul>
    @endif
</li>
