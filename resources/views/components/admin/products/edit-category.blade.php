<div class="form-check mb-2" style="margin-left: {{ $marginLeft }}px ">
    <input class="form-check-input" name="category_id[]" @checked(in_array($category->id, $product->categories->pluck('id')->toArray())) value="{{ $category->id }}" type="checkbox"
           id="{{ $category->id }}">
    <label class="form-check-label" for="{{ $category->id }}">
        {{ $category->name }}
    </label>
</div>
@if($category->children->count())
    @php
        $marginLeft += 15;
    @endphp
    @foreach($category->children as $childItem)
        @include('components.admin.products.edit-category',['category'=>$childItem, 'marginLeft' => $marginLeft, 'product' => $product])
    @endforeach
@endif
