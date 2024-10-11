<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\Util\Str;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.attributes.';

    public function index()
    {
        $attributes = Attribute::query()->with('attributeValues')->latest()->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataAttribute = [
            'name' => request('name'),
            'description' => request('description'),
            'is_active' => request('is_active'),
        ];
        if (request('slug')) {
            $dataAttribute['slug'] = \Illuminate\Support\Str::slug(request('slug'));
        } else {
            $dataAttribute['slug'] = \Illuminate\Support\Str::slug(request('name'));
        }

        $attributeValue = explode(',', request('attribute_value'));

        if ($attributeValue) {
            foreach (array_filter($attributeValue) as $value) {
                $dataAttributeValue[] = [
                    'name' => $value,
                    'slug' => \Illuminate\Support\Str::slug($value),
                    'description' => null,
                    'is_active' => 1,
                ];
            }
        }
        try {
            $attribute = Attribute::query()->create($dataAttribute);
            foreach ($dataAttributeValue as $value) {
                AttributeValue::query()->create([
                    'attribute_id' => $attribute->id,
                    'name' => $value['name'],
                    'slug' => $value['slug'],
                    'description' => $value['description'],
                    'is_active' => $value['is_active'],
                ]);
            }
            return redirect()->route('admin.attributes.index')->with('success', 'Add Attribute Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $attribute = Attribute::query()->with('attributeValues')->findOrFail($id);
        return view(self::PATH_VIEW . __FUNCTION__, compact('attribute'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attribute $attribute)
    {
        $dataAttribute = [
            'name' => request('name'),
            'description' => request('description'),
            'is_active' => request('is_active'),
        ];
        if (request('slug')) {
            $dataAttribute['slug'] = \Illuminate\Support\Str::slug(request('slug'));
        } else {
            $dataAttribute['slug'] = \Illuminate\Support\Str::slug(request('name'));
        }
        try {
            $attribute->attributeValues()->whereNot('id',request('attribute_value_id'))->delete();
            $attribute->update($dataAttribute);
            return redirect()->route('admin.attributes.edit', $attribute)->with('success', 'Update Attribute Successfully');
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attribute $attribute)
    {
        try {
            $attribute->attributeValues()->delete();
            $attribute->delete();
            return redirect()->route('admin.attributes.index')->with('success', 'Delete Attribute Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
