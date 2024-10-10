<option value="{{ $item->id }}">{{ $dash }}{{ $item->name }}</option>
@if($item->children)
    @php
        $dash .= '--';
    @endphp
    @foreach($item->children as $childrenItem)
        @include('components.admin.categories.create', ['item'=>$childrenItem, 'dash' => $dash])
    @endforeach
@endif
