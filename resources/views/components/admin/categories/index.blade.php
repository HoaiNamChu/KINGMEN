<tr>
    <td>
        <div class="form-check">
            <input type="checkbox" value="{{ $item->id }}" class="form-check-input"
                   id="{{ $item->id }}">
            <label class="form-check-label" for="{{ $item->id }}"></label>
        </div>
    </td>
    <td>
        <div class="d-flex align-items-center gap-2">
            <div
                    class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                <img src="{{ \Illuminate\Support\Facades\Storage::url($item->image) }}"
                     alt="" class="avatar-md">
            </div>
            <p class="text-dark fw-medium fs-15 mb-0">{{ $dash }}{{ $item->name }}</p>
        </div>

    </td>
    <td>{{ $item->id }}</td>
    <td>
        @if($item->parent)
            {{ $item->parent->name }}
        @endif
    </td>
    <td>{{ $item->products->count() }}</td>
    <td>
        @if($item->is_active)
            <span class="badge bg-success rounded-pill me-1">Active</span>
        @else
            <span class="badge bg-danger rounded-pill me-1">In Active</span>
        @endif
    </td>
    <td>{{ $item->created_at }}</td>
    <td>
        <div class="d-flex gap-2">
            <a href="#!" class="btn btn-light btn-sm">
                <iconify-icon icon="solar:eye-broken"
                              class="align-middle fs-18"></iconify-icon>
            </a>
            <a href="{{ route('admin.categories.edit', $item) }}"
               class="btn btn-soft-primary btn-sm">
                <iconify-icon icon="solar:pen-2-broken"
                              class="align-middle fs-18"></iconify-icon>
            </a>
            <form action="{{ route('admin.categories.destroy', $item) }}"
                  method="post">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure?')"
                        class="btn btn-soft-danger btn-sm">
                    <iconify-icon icon="solar:trash-bin-minimalistic-2-broken"
                                  class="align-middle fs-18"></iconify-icon>
                </button>
            </form>
        </div>
    </td>
</tr>
@if($item->children)
    @php
        $dash .= '--';
    @endphp
    @foreach($item->children as $childrenItem)
        @include('components.admin.categories.index', ['item' => $childrenItem, 'dash' => $dash])
    @endforeach
@endif
