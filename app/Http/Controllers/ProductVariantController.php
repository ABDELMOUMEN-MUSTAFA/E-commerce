<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use App\Http\Requests\StoreProductVariantRequest;
use App\Http\Requests\UpdateProductVariantRequest;
use App\Models\Product;
use App\Models\Size;
use App\Models\Color;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    public function create(Product $product)
    {
        $sizes = Size::all();
        $colors = Color::all();

        return view('app.products.productVariants.create', compact('product', 'sizes', 'colors'));
    }

    public function store(StoreProductVariantRequest $request, Product $product)
    {
        $validated = $request->validated();
        $validated['product_id'] = $product->id;
        $productVariant = ProductVariant::create($validated);
        $productVariant->sizes()->sync($validated['sizes']);
        return redirect()->route('products.show', $product->id)->with('message', 'The variant '.$validated['name'].' created successfuly.');
    }

    public function edit(ProductVariant $productVariant)
    {
        $sizes = Size::all();
        $colors = Color::all();

        return view('app.products.productVariants.edit', compact('productVariant', 'sizes', 'colors'));
    }

    public function update(UpdateProductVariantRequest $request, ProductVariant $productVariant)
    {
        $validated = $request->validated();
        ProductVariant::where('id', $productVariant->id)->update([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'color_id' => $validated['color_id']
        ]);
        
        $productVariant->sizes()->sync($validated['sizes']);
        return redirect()->route('products.show', $productVariant->product_id)->with('message', 'The variant '.$validated['name'].' updated successfuly.');
    }

    public function destroy(ProductVariant $productVariant)
    {
        $productVariant->delete();
        return redirect()->back()->with('message', 'The Variant <strong>'.$productVariant->name.'</strong> deleted successfully.');
    }
}
