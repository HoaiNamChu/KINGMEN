<option value="{{ $item->id }}">{{ $dash }}{{ $item->name }}</option>
@if($item->children->count())
    @php
        $dash .= '--';
    @endphp
    @foreach($item->children as $childrenItem)
        @include('admin.categories.components.create', ['item'=>$childrenItem, 'dash' => $dash])
    @endforeach
@endif
