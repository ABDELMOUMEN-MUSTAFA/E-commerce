<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Photo;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.admin.products.index', ['products' => Product::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.admin.products.create', ['categories' => Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();
        $product = Product::create($validated);
        $photo = new Photo;
        $photo->product_id = $product->id;
        $photo->source = 'storage/'.$request->photo->store('images/products/'.$product->id, 'public');
        $photo->is_primary = true;
        $photo->save();
        return redirect()->route('products.index')->with('message', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $revenue = '$'.$product->orders->map(function($order) { 
            return $order->pivot->quantity * $order->pivot->unit_price; 
        })->sum();

        return view('app.admin.products.show', compact('product', 'revenue'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('app.admin.products.edit', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();
        $product->name = $validated['name'];
        $product->price = $validated['price'];
        $product->quantity_in_stock = $validated['quantity_in_stock'];
        $product->type_product = $validated['type_product'];
        $product->description = $validated['description'];
        $product->category_id = $validated['category_id'];
        $product->save();
        return redirect()->route('products.index')->with('message', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('message', 'Product deleted successfully.');
    }

    public function toggleActive(Product $product)
    {
        $product->is_active = !$product->is_active;
        $product->save();
        if($product->is_active === true){
            $message = 'Product <strong>'.$product->name.'</strong> is now active.';
        }else{
            $message = 'Product <strong>'.$product->name.'</strong> is now inactive.';
        }

        return redirect()->route('products.index')->with('message', $message);
    }

    public function incrementStock(Product $product, Request $request)
    {
        $validated = $request->validate([
            'newStock' => 'required|integer|max:20000000|gt:0'
        ]);

        $product->quantity_in_stock = $product->quantity_in_stock + $validated['newStock'];
        $product->save();
        return redirect()->back()->with('message', '<strong>'.$validated['newStock'].' pieces</strong> Added to stock successfully.');
    }

    public function search(Request $request){
        $productName = $request->get('productName');
        $products = Product::select('id', 'name')->where('name', 'LIKE', '%'.strip_tags($productName).'%')->get();
        return response()->json($products);
    }
}
