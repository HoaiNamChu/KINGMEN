<li class="{{ $item->children->count() ? 'has-submenu' : '' }}"><a href=""><span>{{ $item->name }}</span></a>
    @if($item->children->count())
        <ul class="submenu-nav">
            @foreach($item->children as $itemChild)
                @include('client.layouts.components.main-nav-category', ['item' => $itemChild])
            @endforeach
        </ul>
    @endif
</li>
