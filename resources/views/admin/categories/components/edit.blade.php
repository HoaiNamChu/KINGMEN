<option value="{{ $item->id }}" @selected($item->id == $category->parent_id)>{{ $dash }}{{ $item->name }}</option>
@if($item->children->count())
    @php
        $dash .= '--';
    @endphp
    @foreach($item->children as $childrenItem)
        @include('admin.categories.components.edit', ['item'=>$childrenItem, 'dash' => $dash, 'category' => $category])
    @endforeach
@endif
